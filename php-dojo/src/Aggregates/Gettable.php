<?php

namespace Dojo\Aggregates;

interface Gettable extends Aggregable
{
    /**
     * retorna os dados da entidade identificada por 'id',
     */
    public function get(int $id): array;
}
