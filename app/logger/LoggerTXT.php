<?php

namespace App\logger;

use App\logger\Logger;

/**
 * Classe responsável por criar o arquivo de log e escrevê-lo em formato .txt
 */
class LoggerTXT extends Logger
{

    /**
     * Método responsável por escrever a mensagem no arquivo de log
     * @param string $message Mensagem que log a ser registrada
     * @return void
     */
    function write(string $message): void
    {
        $text = date('Y-m-d H:i:s') . " - TIPO=´{$this->type}´ - " . $message . PHP_EOL;
        $handler = fopen($this->fileName, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}