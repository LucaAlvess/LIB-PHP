<?php

namespace App\database;

/**
 * Classe responsável por criar/definir filtros de consulta
 */
class Criteria
{

    /**propriedade que armazena os valores dos filtros para a monstagem da query @var array */
    private array $filters;

    /**Propriedade que armazena os valores para critperios de consultas da query @var array */
    private $properties;

    /**
     * Construtor da classe que inicia a propriedade $filters
     */
    public function __construct()
    {
        $this->filters = [];
        $this->properties = [];
    }

    /**
     * Método responsável por adicionar os filtros para a construção da query
     * @param string $variable nome da coluna da tabela a ser consultada
     * @param string $compare operador de comparação
     * @param mixed $value valor a ser comparado
     * @param string $logicOperator operador lógico
     * @return void
     */
    public function add(string $variable, string $compare, mixed $value, string $logicOperator = 'AND'): void
    {
        if (empty($this->filters)) {
            $logicOperator = null;
        }
        $this->filters[] = [$variable, $compare, $this->transform($value), $logicOperator];
    }

    /**
     * Método responsável por montar a query string
     * @return string
     */
    public function dump()
    {
        if (isset($this->filters) && count($this->filters) > 0) {
            $result = '';
            foreach ($this->filters as $filter) {
                $result .= "{$filter[3]} {$filter[0]} {$filter[1]} {$filter[2]} ";
            }

            $result = trim($result);
            return "({$result})";
        }
    }

    /**
     * Método responsável por tratar os valores recebidos e retorná-los
     * @param mixed $value
     * @return mixed
     */
    private function transform(mixed $value): mixed
    {
        if (is_array($value)) {
            foreach ($value as $x) {
                if (is_integer($x)) {
                    $foo[] = $x;
                } elseif (is_string($x)) {
                    $foo[] = "'$x'";
                }
            }
            $result = '(' . implode(', ', $foo) . ')';
        } elseif (is_string($value)) {
            $result = "'$value'";
        } elseif (is_null($value)) {
            $result = 'NULL';
        } elseif (is_bool($value)) {
            $result = $value ? 'TRUE' : 'FALSE';
        } else {
            $result = $value;
        }
        return $result;
    }

    /**
     * Método responsável por setar na propriedade $properties os valores para adicionar critérios na query
     * @param string $propertyName
     * @param mixed $value
     * @return void
     */
    public function setProperty(string $property,mixed $value): void
    {
        $this->properties[$property] = $value;
    }

    /**
     * Método responsável pro retornar os valores dos critérios
     * @param string $propertyName
     * @return mixed
     */
    public function getProperty(string $property)
    {
        if (isset($this->properties[$property])) {
            return $this->properties[$property];
        }
    }
}
