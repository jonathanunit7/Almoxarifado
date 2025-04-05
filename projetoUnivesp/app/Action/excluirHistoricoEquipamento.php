<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'equipamentoController.php');


	if (isset($_GET['id_historico'])) {
		$equipamento = new equipamentoController();
		$equipamento->excluirHistoricoEquipamento($_GET['id_historico']);			
	}else{
		header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
	}



?>