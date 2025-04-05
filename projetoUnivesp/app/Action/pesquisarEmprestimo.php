<?php

include(dirname(__DIR__, 1).'/controller/emprestimoController.php');


	$codEmprestimo = "";
	
	$emprestimo = new emprestimoController();
	
	if (isset($_POST['cod_emprestimo'])){
		$codEmprestimo = $_POST['cod_emprestimo'];
		$emprestimo->pesquisaEmprestimo($codEmprestimo);
	}else{
		$emprestimo->pesquisaEmprestimo($codEmprestimo);
	}
	

	
	
	
?>