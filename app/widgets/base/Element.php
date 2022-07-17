<?php

namespace App\widgets\base;

/**
 * Classe responsável por criar um componente de elemento HTML
 */
class Element
{

    /***Propriedade que armazena o nome da TAG @var string */
    protected string $tagName;

    /***Propriedade que armazena as propriedades da TAG @var array */
    protected array $properties = [];

    /***Propriedade que armaza TAG's filhas ou conteúdo dentro do elemento  @var array */
    protected array $children;

    /**
     * Construtor da classe que instância uma TAG HTML
     * @param string $tagName
     */
    public function __construct(string $tagName)
    {
        $this->tagName = $tagName;
    }

    /**
     * Set o nome e valor das propriedades HTML
     * @param string $property nome da Propriedade
     * @param mixed $value Valor da propriedade
     * @return void
     */
    public function __set(string $property, mixed $value): void
    {
        $this->properties[$property] = $value;
    }

    /**
     * Retorna o valor da propriedade HTML
     * @param string $property nome da propriedade a ser retornada
     * @return mixed|string|null
     */
    public function __get(string $property): mixed
    {
        return isset($this->properties[$property]) ? $this->properties[$property] : null;
    }

    /**
     * Método responsável por converter o elemento em string
     * @return string
     */
    public function __toString(): string
    {
        ob_start();
        $this->show();
        return ob_get_clean();
    }

    /**
     * Método responsável por definir
     * TAGS ou conteúdos que estarão dentro do elemento HTML
     * @param mixed $child Conteúdo ou TAG filha
     * @return void
     */
    public function add(mixed $child): void
    {
        $this->children[] = $child;
    }

    /**
     * Método responsável por exibir a tag de abertura na tela
     * @return void
     */
    private function open(): void
    {
        echo "<{$this->tagName}";
        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                if (is_scalar($value)) {
                    echo " {$property}=\"{$value}\"";
                }
            }
        }
        echo '>';

    }

    /**
     * Método responsável por exibir a tag de fechamento na tela
     * @return void
     */
    private function close(): void
    {
        echo "\n</{$this->tagName}>\n";
    }

    /**
     * Método responsável por exibir a TAG, juntamente com seu conteúdo.
     * @return void
     */
    public function show(): void
    {
        $this->open();
        echo "\n";

        if ($this->children) {
            foreach ($this->children as $child) {
                if (is_object($child)) {
                    $child->show();
                } elseif ((is_string($child)) || (is_numeric($child))) {
                    echo $child;
                }
            }
        }
        $this->close();
    }
}