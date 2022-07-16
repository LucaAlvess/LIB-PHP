<?php

namespace App\services;

use App\database\Produto;
use App\database\transaction\Transaction;
use Exception;

/**
 * |REMOTE FACADE|
 * Classe de serviços para produto
 */
class ProdutoServices
{
    /**
     * Método responsável por retornar os dados do banco de dados de produto a partir do id
     * @param array $request
     * @return array
     */
    public static function getDataCadastro(array $request)
    {
        $idProduct = $request['id'];


        try {
            Transaction::open('conf_db');

            $product = new Produto($idProduct);
            if (!empty($product)) {
                $produtoArray = $product->toArray();
            } else {
                throw new Exception("Produto de código {$idProduct} não encontrado!");
            }

            Transaction::close();

            return $produtoArray;
        } catch (Exception $e) {
            Transaction::rollback();
            print $e->getMessage();
        }
    }
}