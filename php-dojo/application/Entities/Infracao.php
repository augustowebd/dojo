<?php

namespace App\Entities;

class Usuario extends Entity
{
    # no mundo real, tudo vai private com seus respectivos getters/setters.
    # mas como diria Jaiminho (Chaves): é para evitar a fadiga.
    public $id;
    public $tx_infracao;
    public $vl_infracao;
    public $dt_infracao;
    public $id_infrator;

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
