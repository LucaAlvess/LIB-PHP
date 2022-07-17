<?php

namespace App\controller;

/**
 * Classe responsável por definir a ação
 */
class Action implements ActionInterface
{

    /***Propriedade que armazena um callback com a classe e método a ser chamado para ação @var callable */
    private $action;
    /*** @var */
    private $param;

    /***
     * COnstrutor da classe que armazena o callback
     * @param callable $action um array com [classe, método]
     */
    public function __construct(callable $action)
    {
        $this->action = $action;
    }

    /**
     * Método responsável por armazenar os parâmetros para o link da ação
     * @param $param
     * @param $value
     * @return void
     */
    public function setParameter($param, $value)
    {
        $this->param[$param] = $value;
    }

    /**
     * Método responsável por monstar a query de ação para o browser
     * @return string|void
     */
    public function serialize()
    {
        if (is_array($this->action)) {
            $class = is_object($this->action[0]) ? get_class($this->action[0]) : $this->action[0];
            $class = explode('\\', $class);
            $class = end($class);

            $url['class'] = $class;
            $url['method'] = $this->action[1];

            if ($this->param) {
                $url = array_merge($url, $this->param);
            }
            return '?' . http_build_query($url);
        }
    }
}