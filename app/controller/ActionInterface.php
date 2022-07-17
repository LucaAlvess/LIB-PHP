<?php

namespace App\controller;

interface ActionInterface
{
    public function setParameter($param, $value);

    public function serialize();
}