#!/usr/bin/env php
<?php

use Elasticsearch\ClientBuilder;

# carrega autoload para deps
$rootDir = dirname(__DIR__);

require_once ($rootDir . '/vendor/autoload.php');

/*
 * dojo-redis é o nomde do container criado
 * por estar na mesma rede que o postgres,
 * pode ser usado como DNS
 */
try {
    # abre conexao com o redis
    $redis = new \Redis();

    $redisConfig = require_once ($rootDir . '/config/redis.php');

    $isSuccess = $redis->connect(
        $redisConfig['host'],
        $redisConfig['port']
    );

    if (! $isSuccess) {
        throw new Exception('[REDIS][CONNECT]: Falha da conexão com redis');
    }

} catch (Exception $e) {
    # @TODO: implementar estratégia de log
    ;
    print_r( $e );

    # necessário para avisar a um possível encadeamento de processo
    # que houve um erro nessa parte do processo e que, por tanto,
    # deve-se interromper o processo
    exit(1);
}

/*
 * estabelece conexão com o ES
 */
try {
    $esConfig = require_once ($rootDir . '/config/elasticSearch.php');
    $esClient = ClientBuilder::create()->setHosts([ $esConfig ])->build();

} catch (Exception $e) {
    # @TODO: idem para explicado no catch anterior

    exit(1);
}

try {
    $pgConfig = require_once($rootDir . '/config/postgres.php');
    $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s'
        , $pgConfig['host']
        , $pgConfig['port']
        , $pgConfig['dbname']
    );

    $pgClient = new PDO($dsn, $pgConfig['user'], $pgConfig['password']);

} catch (Exception $e) {

    print_r( $e->getMessage() );

    #TODO: idme para o explicado no cacth anterior
    exit(1);
}

/*
 * lista da tabelas que terão seu conteúdo convertidos em agregado
 */
$queues = [
    'usuario'=> [
        'service' => App\Services\Usuario::class,
        'getter'  => App\Getters\Usuario::class,
        'parser'  => App\Parsers\Usuario::class,
        'writer'  => App\Writers\Usuario::class,
    ]

    // 'infracao'    => Dojo\Aggregates\Infracao::class,
    // 'endereco'    => Dojo\Aggregates\Endereco::class,
    // 'notificacao' => Dojo\Aggregates\Notificacao::class,
];

# coloca o desenfileirado para funcionar
(require_once 'runner.php')(function () use($redis, $queues, $pgClient, $esClient) {

    foreach ($queues as $queue => $worker) {
        $getter = new $worker['getter']($pgClient);
        $parser = new $worker['parser']();
        $writer = new $worker['writer']($esClient);
        $service = new $worker['service']($getter, $parser, $writer);

        # recupera todas as mensages da fila informada: {id: int, action: string}
        while ( ($content = $redis->lPop($queue)) ) {
            $params = json_decode($content);
            $service->id($params->id)
                    ->action($params->action)
                    ->run();
        }

        # aqui, todas as mensagens da fila $queue foram recuperadas,
        # processadas e enviadas ao ES

        # ...e o 'the end';)
    }

    echo '.:';

}, 1000);
