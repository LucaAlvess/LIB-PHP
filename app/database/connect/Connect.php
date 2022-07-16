<?php

namespace App\database\connect;

use Exception;
use PDO;

/**
 * Classe responsável por estabelecer a conxeão com a base de dados
 */
class Connect
{
    /**Propriedade que armazaena a instãncia de PDO @var PDO $instance */
    private static PDO $instance;

    /**
     * Método reponsável por criar a conexão com a base de dados a partir dos dodos de configuração do arquivo de configuração
     * @param string $fileName Nome do arquivo .ini de configurações
     * @return PDO
     * @throws Exception
     */
    public static function getConnection(string $fileName): PDO
    {
        if (file_exists(__DIR__ . "/../../config/{$fileName}.ini")) {
            $settings = parse_ini_file(__DIR__ . "/../../config/{$fileName}.ini");
        } else {
            throw new Exception("Arquivo {$fileName} não encontrado...");
        }

        $drive = $settings['drive'] ?? null;
        $host = $settings['host'] ?? null;
        $port = $settings['port'] ?? null;
        $dbname = $settings['dbname'] ?? null;
        $user = $settings['user'] ?? null;
        $pass = $settings['pass'] ?? null;

        switch ($drive) {
            case 'mysql':
                $port = $settings['port'] ? $settings['port'] : '3306';
                self::$instance = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $pass);
                break;
        }

        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$instance;
    }

    /**
     * Método construtor declarado como privado para impedir a instância da classe
     */
    private function __construct()
    {
    }

    /**
     * Método clone declarado como privado para impedir clone dos objetos da classe
     * @return void
     */
    private function __clone(): void
    {

    }
}