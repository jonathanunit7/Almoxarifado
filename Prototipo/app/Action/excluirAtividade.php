<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'atividadeController.php');


	if (isset($_GET['id_atividade'])) {
		$atividade = new atividadeController();
		$atividade->excluirAtividade($_GET['id_atividade']);			
	}


?>