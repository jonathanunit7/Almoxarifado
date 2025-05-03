<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'emprestimoController.php');



 	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigoDeBarras']) && isset($_POST['nome_solicitante'])) {
 		$emprestimo = new emprestimoController();
 		$codigo_de_barras = $_POST['codigoDeBarras'];
 		$nome_equipamento = $_POST['nome_equipamento'];
 		$id_emprestimo = "";
 		$id_emprestimo = $emprestimo->buscaUltimoRegistro();
 		if($id_emprestimo == null) {
 			$id_emprestimo = 0;
 		}else{
 			$id_emprestimo = (int)$id_emprestimo;	
 		} 		
		$id_emprestimo++;
 		 		
 		foreach (array_keys($codigo_de_barras) as $i) {
 			
 			$emprestimo->emprestarEquipamento($codigo_de_barras[$i], $nome_equipamento[$i], $_POST['nome_solicitante'], $_POST['cpf_solicitante'], $id_emprestimo, $_POST['data_inicio_emprestimo'], $_POST['data_fim_emprestimo'], $_POST['destino'], $_POST['nome_atividade'], $_POST['solicitacao']);
		}

 	}else{
 		header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
 	}