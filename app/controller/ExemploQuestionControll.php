<?php

namespace App\controller;

use App\controller\page\Page;
use App\controller\Action;
use App\widgets\dialog\Question;

class ExemploQuestionControll extends Page
{
    public function __construct()
    {
        $action1 = new Action([$this, 'onConfirma']);
        $action2 = new Action([$this, 'onNega']);
        new Question('Você deseja confirmar?', $action1, $action2);
    }

    public function onConfirma()
    {
        print 'Confirmou a ação!';
    }

    public function onNega()
    {
        print 'Negou a ação!';
    }
}