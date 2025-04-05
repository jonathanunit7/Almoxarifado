<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'emprestimoController.php');


	if (isset($_GET['id_emprestimo'])) {
		$equipamento = new emprestimoController();
		$equipamento->excluirEmprestimo($_GET['id_emprestimo']);			
	}


?>