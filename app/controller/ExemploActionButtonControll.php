<?php

namespace App\controller;

use App\controller\page\Page;
use App\controller\Action;
use App\widgets\base\Element;

class ExemploActionButtonControll extends Page
{
    public function __construct()
    {
        $button = new Element('a');
        $button->add('Ação');
        $button->class = 'btn action';

        $action = new Action([$this, 'executaAcao']);
        $action->setParameter('codigo', 4);
        $action->setParameter('nome', 'teste');

        $button->href = $action->serialize();
        $button->show();
    }

    public function executaAcao($param)
    {
        echo '<pre>';
        var_dump($param);
        echo '</pre>';
    }
}