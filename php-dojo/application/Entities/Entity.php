<?php

namespace App\Entities;

abstract class Entity
{
    public abstract function toArray(): array;
}
