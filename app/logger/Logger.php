<?php

namespace App\logger;

/**
 *
 */
abstract class Logger
{
    /**Propriedade que armazena o nome do arquivo de log @var string */
    protected string $fileName;

    /**Propriedade que armazena informação do tipo da mensagem de log @var string */
    protected string $type;


    /**
     * Método responsável por definir o nome do arquivo e adicionar uma quebra de linha para cada novo log
     * @param string $fileName
     * @param string $type tipo de mensagem de log
     */
    public function __construct(string $fileName,string $type = 'Genérico')
    {
        $this->fileName = $fileName;
        $this->type = $type;
    }

    /**
     * Método abstrado que obriga as classes filhas implementá-lo
     * @param string $message
     * @return void
     */
    abstract function write(string $message): void;
}