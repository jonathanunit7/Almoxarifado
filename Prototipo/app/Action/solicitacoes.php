<?php

include(dirname(__DIR__, 1).'/controller/solicitacaoController.php');


		$solicitacao = new solicitacaoController();
 		$solicitacao->listarSolicitacoes($_GET['id_usuario']);	
	
	
?>