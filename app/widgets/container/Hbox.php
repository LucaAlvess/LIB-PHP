<?php

namespace App\widgets\container;

use App\widgets\base\Element;

class Hbox extends Element
{
    public function __construct()
    {
        parent::__construct('div');
    }

    public function add($child): void
    {
        $wrapper = new Element('div');
        $wrapper->style = 'display:inline-block;';
        $wrapper->add($child);

        parent::add($wrapper);
    }
}