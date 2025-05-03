<?php

include(dirname(__DIR__, 1).'/controller/atividadeController.php');


	
	$atividade = new atividadeController();
	
	$atividade->listarAtividade();
		
?>