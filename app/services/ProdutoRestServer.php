<?php

namespace App\services;

use Exception;

/**
 * Classe reponsável por retornar os dados da base de dados em fomato json
 */
class ProdutoRestServer
{
    /**
     * Método responsável por capturar os dados vindos da base de dados e retornar como json
     * @param array $request
     * @return false|string
     */
    public static function run(array $request)
    {
        header('Content-Type: application/json; charset=utf-8');

        $class = NAMESPACE_SERVICES . $request['class'];
        $method = $request['method'] ? $request['method'] : '';

        try {
            if (class_exists($class)) {
                if (method_exists($class, $method)) {
                    $response = call_user_func([$class, $method], $request);
                    return json_encode([
                        'status' => 'success',
                        'data' => $response
                    ]);
                } else {
                    return json_encode([
                        'status' => 'error',
                        'data' => "Método {$method} não encontrado!"
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'error',
                    'data' => "Classe {$class} não encontrado!"
                ]);
            }
        } catch (Exception $e) {
            return json_encode([
                'status' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
}