<?php

namespace API\Controller;
use Exception,
	API\Model\ChavePixModel;

class ChavePixController extends Controller {
	public static function save() : void
	{
		try
        {
            $data = json_decode(file_get_contents('php://input'));

            $model = new ChavePixModel();
            $model->id = $data->Id;
            $model->tipo = $data->Tipo;
            $model->chave = $data->Chave;
			$model->id_conta = $data->Id_conta;

            parent::getResponseAsJSON($model->save());
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

	public static function select() : void
	{
		try
        {
            $data = json_decode(file_get_contents('php://input'));
            $model = new ChavePixModel();
            
            parent::getResponseAsJSON($model->getAllRows($data->id_correntista));
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

	public static function update() 
	{

	}

	public static function delete() : void
	{
		try 
        {
            $id = json_decode(file_get_contents('php://input'));
            
            (new ChavePixModel())->delete( (int) $id);

        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

	public static function search()
	{
		try
        {
            $model = new ChavePixModel();
            
            $busca = json_decode(file_get_contents('php://input'));
            
            //fwrite(fopen("dados.json", "w"), file_get_contents('php://input'));
            
            $model->getAllRows($busca);

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}
}