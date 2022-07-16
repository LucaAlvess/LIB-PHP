<?php

namespace App\controller\page;

/**
 * Classe responsável por gerenciar o conteúdo das views
 */
class View
{

    /**
     * Método responsável por capturar o conteúdo de um arquivo
     * @param string $viewName nome do arquivo de view, caso page geral, adicione o nome da pasta antes do nome
     * @param string $extension extensão do arquivo
     * @return string Retorna o conteúdo do arquivo
     */
    private static function getContentView(string $viewName, string $extension = 'html'): string
    {
        $file = __DIR__ . "/../../../resources/view/{$viewName}.{$extension}";
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável por adicionar o conteúdo das variáveis no arquivo da view
     * @param string $viewName nome do arquivo de view, caso page geral, adicione o nome da pasta antes do nome
     * @param array $vars Variáveis a serem substituídas no arquivo
     * @return string Retorna o conteúdo da view renderizado com as variáveis setadas
     */
    public static function render(string $viewName, array $vars = []): string
    {
        $content = self::getContentView($viewName);
        $keys = array_keys($vars);

        $keys = array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);

        return str_replace($keys, array_values($vars), $content);
    }

}