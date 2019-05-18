<?php

namespace App\Services;
use App\Getters\Usuario as Getter;
use App\Parsers\Usuario as Parser;
use App\Writers\Usuario as Writer;


abstract class Service
{
    protected $getter;
    protected $parser;
    protected $writer;

    protected $id;
    protected $action;

    public function __construct
    (
        Getter $getter,
        Parser $parser,
        Writer $writer
    ) {
        $this->getter = $getter;
        $this->parser = $parser;
        $this->writer  = $writer;
    }

    public function id(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function action(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /*
     * executa todos os passos necessários para:
     *  - recuperar os dados : getter
     *  - processá-los       : parser
     *  - gravá-los no ES    : writer
     * */
    public abstract function run();
}
