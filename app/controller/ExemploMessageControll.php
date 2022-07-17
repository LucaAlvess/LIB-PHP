<?php

namespace App\controller;

use App\controller\page\Page;
use App\widgets\base\Element;
use App\widgets\dialog\Message;

class ExemploMessageControll extends Page
{
    public function __construct()
    {
        new Message('info', 'Mensagem informativa?');
    }
}