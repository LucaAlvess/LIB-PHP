<?php

namespace App\database;

use App\database\Record;

/**
 * Classe filha representando uma tabela da base de dados
 */
class User extends Record
{
    /** Constante que armazena o nome da tabela*/
    const TABLENAME = 'user';
}