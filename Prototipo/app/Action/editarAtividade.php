<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'atividadeController.php');


	if(null !== ($_POST['codigo_de_barras'] ?? null )){		
		$atividade = new atividadeController();
		$atividade->updateAtividade($_POST['id'], $_POST['nome'], $_POST['codigo_de_barras'], $_POST['tipo'], $_POST['status']);
	}

	if (isset($_GET['id_atividade'])) {
		$atividade = new atividadeController();
		$atividade->editarAtividade($_GET['id_atividade']);			
	}





?>