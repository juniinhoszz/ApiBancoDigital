<?php

namespace API\Controller;

use API\Model\CorrentistaModel;
use Exception,
    Api\Model\ContaModel;

class ContaController extends Controller
{
    public static function criarPoupanca()
    {
        $data = json_decode(file_get_contents('php://input'));

        // ARRUMAR CRIAÇÃO DE CONTA
        $model = new CorrentistaModel();

        parent::getResponseAsJSON($model->CriarPoupanca($data));
    }

    public static function selectContaByTipoeId()
    {
        try {
            $data = json_decode(file_get_contents('php://input'));
            
            $model = new ContaModel();
            $id = $data->Id_correntista;
            $tipo = $data->Tipo;

            parent::getResponseAsJSON($model->getContaByTipoeId($id, $tipo));
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public static function select()
    {
        try {

            $model = new ContaModel();

            $model->getAllRows();

            parent::getResponseAsJSON($model->rows);
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public static function selectById()
    {
        try {
            $data = json_decode(file_get_contents('php://input'));

            $model = new ContaModel();

            parent::getResponseAsJSON($model->getById($data));
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public static function update()
    {
    }

    public static function extrato()
    {
    }

    public static function delete()
    {
        try {
            $id = json_decode(file_get_contents('php://input'));

            (new ContaModel())->delete((int) $id);
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public static function search()
    {
        try {
            $model = new ContaModel();

            $busca = json_decode(file_get_contents('php://input'));

            $model->getAllRows($busca);

            parent::getResponseAsJSON($model->rows);
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }
}
