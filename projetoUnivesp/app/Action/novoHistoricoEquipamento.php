<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'equipamentoController.php');

 	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['descricao']) && isset($_POST['data_manutencao']) && isset($_POST['custo'])) {

 		$historico = new equipamentoController();
 		$historico->inserirHistoricoEquipamento($_POST['id'], $_POST['descricao'],  $_POST['data_manutencao'], $_POST['responsavel'], $_POST['custo']);
	}else{
 		header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();  
 	}