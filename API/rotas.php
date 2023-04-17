<?php
use API\Controller\{
    CorrentistaController,
    ContaController
};

$parse_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($parse_uri) {

    // http://localhost:8000/correntista/save --
    case "/correntista/save":
        CorrentistaController::save();
    break;

    // http://localhost:8000/conta/extrato --
    case "/conta/extrato":
        
    break;

    // http://localhost:8000/conta/pix/enviar --
    case "/conta/pix/enviar":

    break;

    // http://localhost:8000/conta/pix/receber --
    case "/conta/pix/receber":
        
    break;

    // http://localhost:8000/correntista/entrar --
    case "/correntista/entrar":
        
    break;

    default:
        header("Location: /");
    break;
}