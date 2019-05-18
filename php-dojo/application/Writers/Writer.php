<?php

namespace App\Writers;

use Dojo\Aggregates\Writeable;
use Elasticsearch\ClientBuilder;

abstract class Writer implements Writeable
{
    protected $es;

    public function __construct($driver)
    {
        $this->es = $driver;
    }
}
