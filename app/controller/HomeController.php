<?php

namespace App\controller;

use App\controller\page\Page;
use App\controller\page\View;
use App\controller\TemplateController;

/**
 * Classe de exemplo de controlador para a home
 */
class HomeController extends Page
{
    /**
     * Exemplo de retorno do conteúdo do template
     */
    public function __construct()
    {
        $content = View::render('home');

        echo TemplateController::getTemplate('Página Inicial', $content);
    }
}