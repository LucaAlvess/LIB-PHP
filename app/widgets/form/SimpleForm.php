<?php

namespace App\widgets\form;

/**
 *
 */
class SimpleForm
{

    /**
     * @var string
     */
    private string $formName;
    /**
     * @var string
     */
    private string $action;
    /**
     * @var array
     */
    private array $fields;
    /**
     * @var string
     */
    private string $title;

    /**
     * @param string $formName
     */
    public function __construct(string $formName)
    {
        $this->formName = $formName;
        $this->fields = [];
        $this->title = '';
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param string $label
     * @param string $name
     * @param string $type
     * @param string $value
     * @param string $class
     * @return void
     */
    public function addField(string $label, string $name, string $type, string $value, string $class = '')
    {
        $this->fields[] = [
            'label' => $label,
            'name' => $name,
            'type' => $type,
            'value' => $value,
            'class' => $class
        ];
    }

    /**
     * @param string $action
     * @return void
     */
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * @return void
     */
    public function show()
    {
        echo "<div class=''>\n";
        echo "<div class=''>{$this->title}\n";
        echo "<div>\n";
        echo "<form method='post' action='{$this->action}' class=''>\n";
        if ($this->fields) {
            foreach ($this->fields as $field) {
                echo "<div class=''>";
                echo "<label class=''>{$field['label']}</label>\n";
                echo "<div class=''>\n";
                echo "<input type='{$field['type']}' name='{$field['name']}' value='{$field['value']}' class='{$field['class']}'>\n";
                echo "</div>\n";
                echo "</div>\n";
            }
        }
        echo "<div>\n";
        echo "<input type='submit' value='Enviar'>\n";
        echo "</div>\n";
        echo "</form>\n";
        echo "</div>\n";
        echo "</div>\n";
    }
}