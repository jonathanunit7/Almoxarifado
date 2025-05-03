<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'solicitacaoController.php');


	if (isset($_GET['id'])) {
		$solicitacao = new solicitacaoController();
		$solicitacao->deletarSolicitacao($_GET['id']);			
	}else{
		header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
	}



?>