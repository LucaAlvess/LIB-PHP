<?php

namespace App\widgets\dialog;

use App\widgets\base\Element;
use App\controller\Action;

/**
 *Classe responśavel por criar os botões de ação
 */
class Question
{
    /**
     * Construtor da classe que cria os botões de ação
     * @param string $message
     * @param Action $actionYes
     * @param Action|null $actionNo
     */
    public function __construct(string $message, Action $actionYes, Action $actionNo = null)
    {
        $div = new Element('div');
        $div->class = 'alert question';

        $urlYes = $actionYes->serialize();

        $linkYes = new Element('a');
        $linkYes->href = $urlYes;
        $linkYes->class = 'btn';
        $linkYes->style = 'float:right;';
        $linkYes->add('Sim');

        $message .=  $linkYes;
        if($actionNo){
            $urlNo = $actionNo->serialize();

            $linkNo = new Element('a');
            $linkNo->href = $urlNo;
            $linkNo->class = 'btn';
            $linkNo->style = 'float:right;';
            $linkNo->add('Não');

            $message .= $linkNo;
        }

        $div->add($message);
        $div->show();
    }
}