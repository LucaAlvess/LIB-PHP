<?php

namespace App\controller;

use App\controller\page\Page;
use App\widgets\base\Element;

class ExemploElementControll extends Page
{
public function __construct()
{
    $div = new Element('div');
    $div->class = 'container';
    $div->style = 'text-align:center;';
    $div->style .= 'font-size:25px;';
    $div->style .= 'font-weight:bold;';

    $p = new Element('p');
    $p->class = 'principal';
    $p->style = 'color:red;';
    $p->add('Isto é um parágrafo!');

    $div->add($p);
    $div->show();
}
}