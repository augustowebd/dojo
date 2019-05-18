<?php

namespace Dojo\Aggregates;

interface Parseable extends Aggregable
{
    /**
     * converte os dados em um agregado
     *
     * @param array $result dados que serão convertedidos em agregado
     * @return array        representacao, em array, do agregado final
     */
    public function parse(array $data): array;
}
