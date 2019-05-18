#!/usr/bin/env php
<?php
# @script: redis-enqueue.sh
# @author: J. Augusto <augustowebd@gmail.com>
#

# carrega autoload para deps
$rootDir = dirname(__DIR__);

require_once ($rootDir . '/vendor/autoload.php');

# recupera os argumentos informados pelo banco
# table:id:crud_operation
list($queue, $id, $action) = explode(':', $argv[1]);

# abre conexao com o redis
$redis = new Redis();

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
        # retorna à trigger uma falha
        exit(1);
    }

} catch (Exception $e) {
    # @TODO: implementar estratégia de log
    ;

    # necessário para avisar a um possível encadeamento de processo
    # que houve um erro nessa parte do processo e que, por tanto,
    # deve-se interromper o processo
    exit(1);
}

# enfilheira a mensagem no redis
$status = $redis->rPush($queue, sprintf('{"id": %d, "action": "%s"}'
        , $id
        , $action
    )
);

if (false === $status) {
    # retorna a trigger um erro por não conseguir
    # gravar na fila
    exit(1);
}

# avisa à trigger que tudo foi conforme o planejado
exit(0);
