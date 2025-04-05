<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'equipamentoController.php');


	if (isset($_POST['id'], $_POST['descricao'], $_POST['data_manutencao'], $_POST['responsavel'], $_POST['responsavel']) && $_POST['id'] !== null && $_POST['descricao'] !== null && $_POST['data_manutencao'] !== null && $_POST['responsavel'] !== null && $_POST['responsavel'] !== null) {	
		$equipamento = new equipamentoController();
		$equipamento->updateHistoricoEquipamento($_POST['id'], $_POST['descricao'], $_POST['data_manutencao'], $_POST['responsavel'], $_POST['custo'] );
	}

	if (isset($_GET['id_historico'])) {
		$equipamento = new equipamentoController();
		$equipamento->editarHistoricoEquipamento($_GET['id_historico']);			
	}





?>