<?php

namespace App\controller;

use App\controller\page\Page;
use App\widgets\container\Panel;

class ExemploPanelControll extends Page
{
    public function __construct()
    {
        $panel = new Panel('Título do painel');
        $panel->style = 'margin: 20px';
        $panel->add('Conteúdo Conteúdo Conteúdo Conteúdo');
        $panel->addFooter('Rodapé brabo');
        $panel->show();
    }
}