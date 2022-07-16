<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\services\ProdutoRestServer;

print ProdutoRestServer::run($_REQUEST);