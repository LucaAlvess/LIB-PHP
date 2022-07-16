<?php

namespace App\database;

use App\database\Criteria;
use App\database\transaction\Transaction;
use Exception;

/**
 * Classe responsável por dar uma ordenação para a consulta
 */
class Repository
{

    /**Propriedade que armazena o nome da entidade filha de record @var string */
    private string $activeRecord;

    /**
     * Método construtor da classe
     * @param string $class nome em string da entidade
     */
    public function __construct(string $class)
    {
        $class = NAMESPACE_DATABASE . $class;
        $this->activeRecord = $class;
    }

    /**
     * Método responsável por carregar os critérios para uma consulta na base de dados
     * @param Criteria $criteria instância da classe Criteria
     * @param string $column nome da coluna a ser verificada
     * @return array|void
     * @throws Exception
     */
    public function load(Criteria $criteria, string $column = '*')
    {
        $sql = "SELECT {$column} FROM " . constant($this->activeRecord . '::TABLENAME');
        if ($criteria) {
            $expression = $criteria->dump();
            if ($expression) {
                $sql .= ' WHERE ' . $expression;
            }
            $order = $criteria->getProperty('ORDER');
            $limit = $criteria->getProperty('LIMIT');
            $offset = $criteria->getProperty('offset');
            if ($order) {
                $sql .= ' ORDER BY ' . $order;
            }
            if ($limit) {
                $sql .= ' LIMIT ' . $limit;
            }
            if ($offset) {
                $sql .= ' OFFSET ' . $offset;
            }
        }

        if ($conn = Transaction::get()) {
            Transaction::log($sql);
            $result = $conn->query($sql);

            if ($result) {
                $results = [];
                while ($row = $result->fetchObject($this->activeRecord)) {
                    $results[] = $row;
                }
                return $results;
            }
        } else {
            throw new Exception('Não há transação ativa!');
        }
    }

    /**
     * Método responsável por definir critérios para deleter dados da base de dados
     * @param Criteria $criteria instância da classe Criteria
     * @return false|int
     * @throws Exception
     */
    public function delete(Criteria $criteria)
    {
        $sql = "DELETE FROM " . constant($this->activeRecord . '::TABLENAME');

        if ($criteria) {
            $expression = $criteria->dump();
            if ($expression) {
                $sql .= ' WHERE ' . $expression;
            }
        }

        if ($conn = Transaction::get()) {
            Transaction::log($sql);
            return $conn->exec($sql);
        } else {
            throw new Exception('Não há transação ativa!');
        }
    }

    /**
     * Método responsável por definir critérios para consultar a quantidade de ocorrências daquele(s) critérios
     * na base de dados
     * @param Criteria $criteria instância da classe Criteria
     * @return mixed|void
     * @throws Exception
     */
    public function count(Criteria $criteria = null)
    {
        $sql = "SELECT count(*) FROM " . constant($this->activeRecord . '::TABLENAME');

        if ($criteria) {
            $expression = $criteria->dump();
            if ($expression) {
                $sql .= ' WHERE ' . $expression;
            }
        }

        if ($conn = Transaction::get()) {
            Transaction::log($sql);
            $result = $conn->query($sql);
            if ($result) {
                $row = $result->fetch();
                return $row[0];
            }
        } else {
            throw new Exception('Não há transação ativa!');
        }
    }
}