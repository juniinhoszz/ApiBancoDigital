<?php
namespace API\Controller;
use Exception,
	API\Model\CorrentistaModel;

class CorrentistaController extends Controller {

    public static function login()
    {
        try
        {
            // Transformando os dados da entrada enviada do app em
            // JSON para um objeto em PHP.
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            parent::getResponseAsJSON($model->getByCpfAndSenha($data->Cpf, $data->Senha)); 

        } catch(Exception $e) {
            
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }  
    
    }

	public static function save() : void
	{
		try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();
            $model->id = $json_obj->Id;
            $model->nome = $json_obj->Nome;
            $model->cpf = $json_obj->CPF;
			$model->data_nasc = $json_obj->Data_nasc;
			$model->senha = $json_obj->Senha;

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
            $model = new CorrentistaModel();
            
            $model->getAllRows();

            parent::getResponseAsJSON($model->rows);
              
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
            
            (new CorrentistaModel())->delete( (int) $id);

        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

}