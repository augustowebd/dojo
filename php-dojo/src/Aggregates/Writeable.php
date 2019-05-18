<?php

namespace Dojo\Aggregates;

interface Writeable extends Aggregable
{
    /**
     * @param array $data
     * @return void
     */
    public function writer(array $data);
}
