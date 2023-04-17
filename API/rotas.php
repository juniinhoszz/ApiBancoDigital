<?php
use API\Controller\{
    CorrentistaController,
    ContaController
};

$parse_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($parse_uri) {

    
    case "/correntista/save":
        
    break;

    case "/conta/extrato":
        
    break;

    case "/conta/pix/enviar":

    break;

    case "/conta/pix/receber":
        
    break;

    case "/correntista/entrar":
        
    break;

    default:
        header("Location: /");
    break;
}