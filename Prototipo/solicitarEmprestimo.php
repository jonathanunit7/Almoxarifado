<?php

include(dirname(__DIR__, 1).'/controller/solicitacaoController.php');

	



	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['equipamentos']) && isset($_POST['data_inicio_emprestimo']) && isset($_POST['data_fim_emprestimo']) && isset($_POST['solicitante'])) {

		$solicitacao = new solicitacaoController();
 		$solicitacao->solicitarEmprestimo($_POST['equipamentos'], $_POST['data_inicio_emprestimo'],  $_POST['data_fim_emprestimo'],  $_POST['solicitante'], $_POST['nome_atividade'], $_POST['destino']);
	}else{
 		header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();  
 	}
	
	
	

	
	
	
?>