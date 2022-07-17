<?php

namespace App\widgets\form;

/**
 * Classe responsável por criar um componente simples de formulaŕio
 */
class SimpleForm
{

    /***Propriedade que armazena o nome do formulário @var string */
    private string $formName;
    /**Propriedade que armazena a ação do formulário @var string */
    private string $action;
    /***Propriedade que armazena os valores dos atributos do input @var array */
    private array $fields;
    /***Propriedade que armazena o título do formulário @var string */
    private string $title;

    /**
     * Construtor da classe
     * @param string $formName
     */
    public function __construct(string $formName)
    {
        $this->formName = $formName;
        $this->fields = [];
        $this->title = '';
    }

    /**
     * Método responsável por setar o valor do título do formulário
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Método responsável por armazenar os valores dos atributos do input
     * @param string $label Nome da label para cada input
     * @param string $name nome da variável global do formulário
     * @param string $type valor do tipo do input
     * @param string $value Valor do input
     * @param string $class nome da classe do input
     * @return void
     */
    public function addField(string $label, string $name, string $type, string $value, string $class = ''): void
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
     * Método responsável por setar a ação do formulário
     * @param string $action
     * @return void
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * Método responsável por montar o componente com os valores definidos para os inputs
     * @return void
     */
    public function show(): void
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