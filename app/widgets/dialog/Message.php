<?php

namespace App\widgets\dialog;

use App\widgets\base\Element;

/**
 *Classe reponsável por montar as boxes de mensagem
 */
class Message
{
    /**
     * Construtor da classe que monta a box de mensagem
     * @param string $type Tipo da mensagem
     * @param string $message mensagem
     */
    public function __construct(string $type, string $message)
    {
        $container = new Element('div');
        $container->class = 'container';
        $div = new Element('div');
        $div->style = 'text-align:center;';
        $div->style .= 'background-color: gray;';
        $div->style .= 'padding: 5px;';
        $div->style .= 'color: #fff;';
        if($type == 'info'){
            $div->class = 'alert info';
        }elseif ($type == 'error'){
            $div->class = 'alert danger';
        }
        $div->add($message);
        $container->add($div);
        $container->show();
    }
}