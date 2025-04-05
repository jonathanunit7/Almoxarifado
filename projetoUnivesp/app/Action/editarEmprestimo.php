<?php

include(dirname(__DIR__, 1).'/controller/emprestimoController.php');

	
	$emprestimo = new emprestimoController();
	
	if (isset($_GET['id_emprestimo'])){
		$id_emprestimo = $_GET['id_emprestimo'];
		$emprestimo->editarEmprestimo($id_emprestimo);
	}
	

	
	
	
?>