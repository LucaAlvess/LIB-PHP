<?php

namespace App\widgets\container;

use App\widgets\base\Element;

class Panel extends Element
{

    private $body;
    private $footer;

    public function __construct(string $panelTitle = null)
    {
        parent::__construct('div');
        $this->class = '';

        if ($panelTitle) {
            $head = new Element('div');
            $head->class = '';
            $head->style = 'border:1px solid;';

            $title = new Element('div');
            $title->class = '';

            $label = new Element('h4');
            $label->add($panelTitle);

            $head->add($title);
            $title->add($label);
            parent::add($head);
        }
        $this->body = new Element('div');
        $this->body->class = '';
        $this->body->style = 'border:1px solid green;';
        parent::add($this->body);

        $this->footer = new Element('div');
        $this->footer->class = '';
        $this->footer->style = 'border:1px solid blue;';
    }

    public function add($content): void
    {
        $this->body->add($content);
    }

    public function addFooter($footer)
    {
        $this->footer->add($footer);
        parent::add($this->footer);
    }
}