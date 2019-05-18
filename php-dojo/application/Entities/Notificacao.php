<?php

namespace App\Entities;

class Notificacao extends Entity
{
    # no mundo real, tudo vai private com seus respectivos getters/setters.
    # mas como diria Jaiminho (Chaves): é para evitar a fadiga.
    public $id;
    public $id_endereco;
    public $id_notificacao;
    public $dt_notificacao;
    public $is_notificou;

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
