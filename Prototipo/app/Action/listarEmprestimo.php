<?php

include(dirname(__DIR__, 1).'/controller/emprestimoController.php');


	
	$emprestimo = new emprestimoController();
	
	$emprestimo->listarEmprestimo();
		
?>