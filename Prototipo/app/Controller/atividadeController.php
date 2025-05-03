<?php


	include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR.'atividadeModel.php');
	/**
 	* 
 	*/




	class atividadeController{
		
		
		function novaAtividade($nome_atividade=null, $destino=null, $data_inicio_emprestimo=null, $data_fim_emprestimo=null, $hora_inicio_emprestimo=null, $hora_fim_emprestimo=null, $frequencia=null, $equipamentos=null, $nome_equipamentos=null, $solicitante=null, $cpf_solicitante=null){

			$atividade = new atividadeModel();
			$resultado = $atividade->novaAtividadeModel($nome_atividade, $destino, $data_inicio_emprestimo, $data_fim_emprestimo, $hora_inicio_emprestimo, $hora_fim_emprestimo, $frequencia, $equipamentos, $nome_equipamentos, $solicitante, $cpf_solicitante);
			session_start();
			$_SESSION['msg'] = "Atividade criada com sucesso";
			include dirname(__DIR__).'/view/novaAtividade.php';		
		}

		function listarAtividade(){
			$atividade = new atividadeModel();
			$resultado = $atividade->listarAtividadeModel();
			include dirname(__DIR__).'/view/atividades.php';		
		}

		function excluirAtividade($id_atividade=null){
		
			$atividade = new atividadeModel();
			$resultado = $atividade->excluirAtividadeModel($id_atividade);
			session_start();
			if($resultado == true){
				$resultado = $atividade->listarAtividadeModel();
			}	
			$_SESSION['msg'] = "Deletado com sucesso";
			include(dirname(__DIR__, 1).'/view/atividades.php');	
			
		}

		function editarAtividade($id_atividade=null){
			$atividade = new atividadeModel();
			$resultado = $atividade->editarAtividadeModel($id_atividade);
			include dirname(__DIR__).'/view/editarAtividade.php';		

		}

	}