<?php

namespace App\Entities;

class Endereco extends Entity
{
    # no mundo real, tudo vai private com seus respectivos getters/setters.
    # mas como diria Jaiminho (Chaves): é para evitar a fadiga.
    public $id;
    public $id_dono;
    public $tx_endereco;

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
