<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'equipamentoController.php');


	if(null !== ($_POST['codigo_de_barras'] ?? null )){		
		$equipamento = new equipamentoController();
		$equipamento->updateEquipamento($_POST['id'], $_POST['nome'], $_POST['codigo_de_barras'], $_POST['tipo'], $_POST['status']);
	}

	if (isset($_GET['id'])) {
		$equipamento = new equipamentoController();
		$equipamento->editarEquipamento($_GET['id']);			
	}





?>