<?php

namespace App\controller\page;

/**
 * Classe pai com o método comum para os controladores
 */
class Page
{
    /**
     * Método responsável por executar o método da requisição
     * @return void
     */
    public function show()
    {
        if ($_GET) {
            $method = $_GET['method'] ?? null;
            if (method_exists($this, $method)) {
                call_user_func([$this, $method], $_REQUEST);
            }
        }
    }
}