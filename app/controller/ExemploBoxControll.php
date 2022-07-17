<?php

namespace App\controller;

use App\controller\page\Page;
use App\widgets\container\Hbox;
use App\widgets\container\Panel;

class ExemploBoxControll extends Page
{
    public function __construct()
    {
        $panel1 = new Panel('Painel 1');
        $panel1->style = 'margin:10px;';
        $panel1->add('Painel 1');

        $panel2 = new Panel('Painel 2');
        $panel2->style = 'margin:10px;';
        $panel2->add('Painel 2');

        $box = new Hbox;
        $box->add($panel1);
        $box->add($panel2);

        $box->show();
    }
}