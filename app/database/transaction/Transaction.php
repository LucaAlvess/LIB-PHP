<?php

namespace App\database\transaction;

use App\database\connect\Connect;
use App\logger\Logger;
use PDO;
use Exception;

/**
 * Classe responsável por gerenciar a transação com a base de dados
 */
class Transaction
{
    /**Propriedade que armazena a instância de PDO com transação @var PDO|null */
    private static PDO|null $conn;
    /**Propriedade que armazena a instâcia da classe Logger(filhas) @var Logger|null */
    private static Logger|null $logger;

    /**
     * Método responśavel por iniciar a transação com a conexão
     * @param string $fileName Nome do arquivo de configurção .ini
     * @return void
     * @throws Exception
     */
    public static function open(string $fileName): void
    {
        self::$conn = Connect::getConnection($fileName);
        self::$conn->beginTransaction();
        self::$logger = null;
    }

    /**
     * Método responsável por finalizar a transação em caso de sucesso
     * @return void
     */
    public static function close(): void
    {
        if (self::$conn) {
            self::$conn->commit();
            self::$conn = null;
        }
    }

    /**
     * Método responsável por retornar a instância de conexão com transação
     * @return PDO
     */
    public static function get(): PDO
    {
        return self::$conn;
    }

    /**
     * Método responsável por desfazer a transação com a base de dados em caso de falha
     * @return void
     */
    public static function rollback(): void
    {
        if (self::$conn) {
            self::$conn->rollback();
            self::$conn = null;
        }
    }

    /**
     * Método responsável por setar a instância de log(filha)
     * @param Logger $logger Intância da classe de LOG
     * @return void
     */
    public static function setLogger(Logger $logger): void
    {
        self::$logger = $logger;
    }

    /**
     * Método responsável por adicionar a mensagem e escrever no arquivo de log
     * @param string $message
     * @return void
     */
    public static function log(string $message): void
    {
        if (self::$logger) {
            self::$logger->write($message);
        }
    }

    /**
     *
     */
    private function __construct()
    {
    }
}