<?php

namespace App\Entities;

class Usuario extends Entity
{
    # no mundo real, tudo vai private com seus respectivos getters/setters.
    # mas como diria Jaiminho (Chaves): é para evitar a fadiga.
    public $id;
    public $tx_nome;
    public $tx_email;

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
