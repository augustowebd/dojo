<?php

namespace App\Parsers;

use Dojo\Aggregates\Parseable;

use App\Parsers\Notificacao;

class Infracao implements Parseable
{
    /**
     * converte os dados em um agregado
     *
     * Para usuários, o array esperado deve ser:
     *  [
     *      'infracao': integer,
     *      'tx_infracao': string,
     *      'vl_infracao': string,
     *      'dt_infracao': string,
     *      'id_infrator': integer
     *      'notificacao': Array<Notificacao>
     * ]
     */
    public function parse(array $data): array
    {
        $infracoes = [];

        foreach ($data as $infracao) {
            $infracoes[] = [
                'infracao'  => $infracao['infracao'],
                'infrator'  => $infracao['id_infrator'],
                'descricao' => $infracao['tx_infracao'],
                'valor'     => $infracao['vl_infracao'],
                'data'      => $infracao['dt_infracao'],
                'notificacao' => (new Notificacao())->parse($infracao['notificacao']),
            ];
        }

        return $infracoes;
    }
}
