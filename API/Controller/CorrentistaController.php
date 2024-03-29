<?php
namespace API\Controller;
use Exception,
	API\Model\CorrentistaModel;

class CorrentistaController extends Controller {

    public static function login()
    {
        try
        {
            // Transformando os dados da entrada enviada do app em JSON para um objeto em PHP.
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            parent::getResponseAsJSON($model->getByCpfAndSenha($data->CPF, $data->Senha)); 
        } catch(Exception $e) {
            
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

	public static function save() 
	{
		try
        {
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            foreach (get_object_vars($data) as $key => $value) 
            {
                $prop_letra_minuscula = strtolower($key);

                $model->$prop_letra_minuscula = $value;
            }

            /*
             * Salvando o novo correntista e definindo a saída.
             * Exemplo de saída que poderá ser vista no Console do Visual Studio 2022:
             * {"rows":null,"id":"6","nome":"Giovani","email":"giovani@teste.com","cpf":"123456789","data_nascimento":"2005-02-08T00:00:00","senha":"123"}
             */
            parent::getResponseAsJSON($model->save());
        } catch (Exception $e) {
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
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