<?php
use API\Controller\{
    CorrentistaController,
    ContaController,
    TransacaoController
};

$parse_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($parse_uri) {

    // CORRENTISTA

    // php -S 0.0.0.0:8000
    // http://localhost:8000/correntista/save --
    case "/correntista/save":
        CorrentistaController::save();
    break;

    // http://localhost:8000/correntista/login --
    // URL Local: http://0.0.0.0:8000/correntista/login
    case "/correntista/login":
        CorrentistaController::login();
    break;

    // CONTA
    
    // http://localhost:8000/conta/extrato --
    case "/conta/extrato":
        ContaController::extrato();
    break;

    // http://localhost:8000/conta/extrato --
    case "/conta/criarpoupanca":
        ContaController::criarPoupanca();
    break;

    // http://localhost:8000/conta/extrato --
    case "/conta/vercontabytipoeid":
        ContaController::selectContaByTipoeId();
    break;

    // PIX

    // http://localhost:8000/transacao/pix/enviar --
    case "/transacao/pix/enviar":
        TransacaoController::enviarPix();
    break;

    // http://localhost:8000/transacao/pix/receber --
    case "/transacao/pix/receber":
        TransacaoController::receberPix();
    break;

    default:
        //header("Location: /");
    break;
}