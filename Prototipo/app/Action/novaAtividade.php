<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'atividadeController.php');

 	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_atividade']) && isset($_POST['destino']) && isset($_POST['data_inicio_emprestimo']) && isset($_POST['data_fim_emprestimo']) && isset($_POST['frequencia']) && isset($_POST['equipamentos'])) {


 		$atividade = new atividadeController();
 		$atividade->novaAtividade($_POST['nome_atividade'], $_POST['destino'], $_POST['data_inicio_emprestimo'], $_POST['data_fim_emprestimo'], $_POST['hora_inicio_emprestimo'], $_POST['hora_fim_emprestimo'], $_POST['frequencia'], $_POST['equipamentos'], $_POST['nome_equipamentos'], $_POST['solicitante'], $_POST['cpf_solicitante']);
	}else{
 		header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();  
 	}