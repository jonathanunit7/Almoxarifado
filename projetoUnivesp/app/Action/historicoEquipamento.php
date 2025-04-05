<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'equipamentoController.php');


	if(null !== ($_GET['id'] ?? null )){		
		$equipamento = new equipamentoController();
		$equipamento->historicoEquipamento($_GET['id']);
	}

	




?>