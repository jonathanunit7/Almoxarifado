<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'solicitacaoController.php');

	
 	 	
		$solicitacao = new solicitacaoController();
		$solicitacao->entrarSolicitacao($_GET['id']);
	



?>