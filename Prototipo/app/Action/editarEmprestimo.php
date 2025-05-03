<?php

include(dirname(__DIR__, 1).'/controller/emprestimoController.php');

	
	$emprestimo = new emprestimoController();
	
	if (isset($_POST['equipamentos'], $_POST['nome_equipamentos'])){	
		
		$emprestimo->updateEmprestimo($_POST['solicitante'], $_POST['cpf_solicitante'], $_POST['id_emprestimo'], $_POST['nome_equipamentos'], $_POST['data_inicio_emprestimo'], $_POST['data_fim_emprestimo'], $_POST['equipamentos'], $_POST['nome_atividade'], $_POST['destino']);
	
	}elseif(isset($_GET['id_emprestimo'])){
		
		$id_emprestimo = $_GET['id_emprestimo'];
		$emprestimo->editarEmprestimo($id_emprestimo);
	
	}else{
		 header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
	}

	

?>