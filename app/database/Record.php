<?php

namespace App\database;

use App\database\transaction\Transaction;
use PDO;
use Exception;
use PDOStatement;

/**
 * SuperClass que contém os métodos de persistência comuns a todas as clases de negócio
 */
abstract class Record
{
    /**Propriedade que armazenza um array com os atributos das classes de negócio @var array $data */
    private array $data;

    /**
     * Construtor da classe. Opcionalmente faz uma consulta a partir do id e armazena na propriedade da classe
     * @param int|null $id id a ser pesquisado na base de dados
     * @throws Exception
     */
    public function __construct(int $id = null)
    {
        if ($id) {
            $object = $this->load($id);
            if ($object) {
                $this->fromArray($object->toArray());
            }
        }
    }

    /**
     * Método responspável por buscar os dados na base de dados a partir do id
     * @param int|string $id id a ser pesquisado
     * @param string $column filtro de qual colunar será retornada
     * @return
     * @throws Exception
     */
    public function load(int|string $id, string $column = '*')
    {
        $sql = "SELECT {$column} FROM {$this->getEntity()} WHERE id= :id";

        if ($conn = Transaction::get()) {
            Transaction::log($sql);
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bindValue(':id', $id);
                $stmt->execute();
                return $stmt->fetchObject(get_class($this));
            }
        } else {
            throw new Exception('Não há uma transação ativa!');
        }
    }

    /**
     * Método responsável por inserir(sem id) ou atualizar(com id) os dados do banco de dados a partir do id
     * @return PDOStatement|bool
     * @throws Exception
     */
    public function store(): PDOStatement|bool
    {
        if (empty($this->data['id']) || (!$this->load($this->data['id']))) {
            $sql = "INSERT INTO {$this->getEntity()} (" . implode(', ', array_keys($this->data)) . ')' .
                ' VALUES (' . implode(', ', $this->prepared($this->data)) . ')';
        } else {
            $set = [];
            foreach ($this->data as $column => $value) {
                $set[] = "$column = :$column";
            }
            $sql = "UPDATE {$this->getEntity()} SET " . implode(', ', $set) . ' WHERE id= :id';

        }
        if ($conn = Transaction::get()) {

            Transaction::log($sql);
            $stmt = $conn->prepare($sql);

            foreach ($this->data as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }
            return $stmt->execute();
        } else {
            throw new Exception('Não há uma transação ativa!');
        }
    }

    /**
     * Método responsável por deletar dados da base de dados a partir do id
     * @param int|string|null $id
     * @return
     * @throws Exception
     */
    public function delete(int|string $id = null)
    {

        $id = $id ?? $this->data['id'];

        $sql = "DELETE FROM {$this->getEntity()} WHERE id=:id";

        if ($conn = Transaction::get()) {
            Transaction::log($sql);
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } else {
            throw new Exception('Não há uma transação ativa!');
        }
    }

    /**
     * Método responsável por preparar os valores a serem inseridos com STMT
     * @param array $arr array com as chaves a serem preparadas
     * @return array
     */
    private function prepared(array $arr): array
    {
        $arrMap = array_map(function ($item) {
            return ":{$item}";
        }, array_keys($arr));

        return array_values($arrMap);
    }

    /**
     * Método responsável por armazenar os dados em formato array
     * @param array $data [array] com os dados
     * @return void
     */
    public function fromArray(array $data): void
    {
        $this->data = $data;
    }

    /**
     * Método responsável por retornar o array com os dados da propriedade
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * Método responável por ler e retornar o nome(constante) da entidade da classe filha
     * @return string
     */
    private function getEntity(): string
    {
        $class = get_class($this);
        return constant("{$class}::TABLENAME");
    }

    /**
     * Método mágico que define os atributos
     * @param string $prop nome da propriedade
     * @param mixed $value valor da propriedade
     * @return void
     */
    public function __set(string $prop, mixed $value): void
    {
        if ($value === null) {
            unset($this->data[$prop]);
        }
        $this->data[$prop] = $value;
    }

    /**
     * Método mágico que retorna o valor dos atributos
     * @param string $prop nome da propriedade
     */
    public function __get(string $prop)
    {
        if (isset($this->data[$prop])) {
            return $this->data[$prop];
        }
    }

    /**
     * Método mágico que retorna o valor do atributo após ser verificada sua existência
     * @param string $prop nome da propriedae
     * @return bool
     */
    public function __isset(string $prop): bool
    {
        return isset($this->data[$prop]);
    }

    /**
     * Método mágico que exclui o atributo 'id' do clone do objeto
     * @return void
     */
    public function __clone(): void
    {
        unset($this->data['id']);
    }
}