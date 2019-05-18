<?php

namespace App\Parsers;

use Dojo\Aggregates\Parseable;

class Usuario implements Parseable
{
    /**
     * converte os dados em um agregado
     *
     * Para usuários, o array esperado deve ser:
     *  [
     *      'usuario': integer,
     *      'tx_nome': string,
     *      'tx_email': string,
     *      'endereco': Array<Endereco>,
     *      'infracao': Array<Infracao>
     * ]
     */
    public function parse(array $data): array
    {
        if (! count($data)) {
            return [];
        }

        return [
            'usuario' => $data['usuario'],
            'nome'    => $data['tx_nome'],
            'email'   => $data['tx_email'],
            'endereco' => (new Endereco())->parse($data['endereco']),
            'infracao' => (new Infracao())->parse($data['infracao']),
        ];
    }
}
