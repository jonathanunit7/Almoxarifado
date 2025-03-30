<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'equipamentoController.php');


	if (isset($_GET['id'])) {
		$equipamento = new equipamentoController();
		$equipamento->excluirEquipamento($_GET['id']);			
	}else{
		header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
	}



?>