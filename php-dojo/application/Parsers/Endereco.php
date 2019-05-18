<?php

namespace App\Parsers;

use Dojo\Aggregates\Parseable;

class Endereco implements Parseable
{
    /**
     * @param array $data[
     *      'endereco': integer,
     *      'id_dono': integer,
     *      'tx_endereco': string,
     * ]
     */
    public function parse(array $data): array
    {
        $enderecos = [];

        foreach ($data as $endereco) {
            $enderecos[] = [
                'dono'      => $endereco['id_dono'],
                'endereco'  => $endereco['endereco'],
                'logradouro'=> $endereco['tx_endereco'],
            ];
        }

        return $enderecos;
    }
}
