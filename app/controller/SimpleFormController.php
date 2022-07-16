<?php

namespace App\controller;

use App\controller\page\Page;
use App\widgets\form\SimpleForm;

class SimpleFormController extends Page
{
    public function __construct()
    {
        $form = new SimpleForm('my form');
        $form->setTitle('Título Form');
        $form->addField('Nome', 'name', 'text', 'Maria');
        $form->addField('Endereço', 'endereco', 'text', 'Rua tal');
        $form->addField('Telefone', 'telefone', 'text', '(21) 996899995');
        $form->setAction(URL_PREFIX.'index.php?class=SimpleFormController&method=onGravar');
        $form->show();
    }

    public function onGravar($param)
    {
        echo '<pre>';
        var_dump($param);
        echo '</pre>';
    }
}