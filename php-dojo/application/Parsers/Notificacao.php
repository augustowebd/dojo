<?php

namespace App\Parsers;

use Dojo\Aggregates\Parseable;

use App\Parsers\Endereco;

class Notificacao implements Parseable
{
    /**
     * converte os dados em um agregado
     *
     * Para usuários, o array esperado deve ser:
     *  [
     *      'notificacao': integer,
     *      'id_infracao': integer,
     *      'dt_notificacao': string,
     *      'is_notificou': boolean
     *      'endereco': Array<Endereco>
     *  ]
     */
    public function parse(array $data): array
    {
        $notificacoes = [];

        foreach ($data as $notificacao) {
            $notificacoes[] = [
                'notificacao' => $notificacao['notificacao'],
                'infracao'    => $notificacao['id_infracao'],
                'data'        => $notificacao['dt_notificacao'],
                'notificou'   => $notificacao['is_notificou'],
                'endereco'    => (new Endereco())->parse(array($notificacao['endereco'])),
            ];
        }

        return $notificacoes;
    }
}
