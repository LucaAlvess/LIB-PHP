<?php

namespace App\controller;

use App\controller\page\Page;
use App\controller\Action;

class ExemploActionControll extends Page
{
    public function __construct()
    {
        $action = new Action([$this, 'executaAcao']);
        $action->setParameter('codigo', 4);
        $action->setParameter('nome', 'teste');

        print $action->serialize();
    }

    public function executaAcao()
    {
    }

}