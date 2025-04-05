<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'equipamentoController.php');

 	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo_de_barras']) && isset($_POST['nome_equipamento']) && isset($_POST['tipo'])) {

 		$equipamento = new equipamentoController();
 		$equipamento->inserirEquipamento($_POST['codigo_de_barras'], $_POST['nome_equipamento'],  $_POST['tipo']);
	}else{
 		header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();  
 	}