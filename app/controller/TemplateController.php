<?php

namespace App\controller;

use App\controller\page\View;

/**
 * Classe filha de View responsável por criar o template padrão para as páginas
 */
class TemplateController extends View
{
    /**
     * Método responśavel por capturar o conteúdo do header do template
     * @return string
     */
    private static function getHeader(): string
    {
        return View::render('page/header');
    }

    /**
     * Método responśavel por capturar o conteúdo do footer do template
     * @return string
     */
    private static function getFooter(): string
    {
        return View::render('page/footer');
    }

    /**
     * Método getTemplate() reponsável por definir o template com o conteúdo desejado
     * @param string $title Título da página
     * @param string $content Conteúdo da página
     * @return string
     */
    public static function getTemplate(string $title,string $content): string
    {
        return View::render('page/page', [
            'TITLE' => $title,
            'HEADER' => self::getHeader(),
            'CONTENT' => $content,
            'FOOTER' => self::getFooter()
        ]);
    }

}