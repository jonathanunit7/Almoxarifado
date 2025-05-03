<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR.'emprestimoModel.php');


 	
	class emprestimoController{
		
		function emprestarEquipamento($codigoDeBarras=null, $nome_equipamento, $nome_solicitante=null, $cpfSolicitante=null, $id_emprestimo=null, $data_inicio_emprestimo=null, $data_fim_emprestimo=null, $destino=null, $nome_atividade=null, $solicitacao=null){
			$emprestimoModel = new emprestimoModel();
			
			$resultado = $emprestimoModel->emprestarEquipamentoModel($codigoDeBarras, $nome_equipamento, $nome_solicitante, $cpfSolicitante, $id_emprestimo, $data_inicio_emprestimo, $data_fim_emprestimo, $destino, $nome_atividade, $solicitacao);



			if(empty($resultado)){
				return false;
			}elseif(!empty($resultado) && !isset($solicitacao) && empty($solicitacao)){
				header("Location: ../view/emprestimo.php?msg=Emprestimo realizado com sucesso");
    			exit();	
			}else{
				$_SESSION['msg'] = "Emprestimo criado com sucesso";	
				header("Location: ../Action/entrarSolicitacao.php?id=".$solicitacao);
    			exit();	
			}
		}


		function pesquisaEmprestimo($emprestimo=null){
			define('TITLE','Pesquisar Emprestimo');

			if(!empty($emprestimo)){
				$emprestimoModel = new emprestimoModel();
				$resultado = $emprestimoModel->pesquisaEmprestimoModel($emprestimo);
			}

			include(dirname(__DIR__, 1).'/view/pesquisarEmprestimo.php');
			
		}

		function listarEmprestimo(){
			$emprestimoModel = new emprestimoModel();
			$resultado = $emprestimoModel->listarEmprestimoModel();
			

			include(dirname(__DIR__, 1).'/view/pesquisarEmprestimo.php');
		}

		function buscaUltimoRegistro(){
			$emprestimoModel = new emprestimoModel();
			$registro = $emprestimoModel->buscaUltimoRegistroModel();
			return $registro;
		}

		function editarEmprestimo($id_emprestimo=null){
			$emprestimoModel = new emprestimoModel();
			$resultado = $emprestimoModel->editarEmprestimoModel($id_emprestimo);

			include(dirname(__DIR__, 1).'/view/editarEmprestimo.php');
		}

		function updateEmprestimo($solicitante=null, $cpf_solicitante=null, $id_emprestimo=null, $nome_equipamento=null, $data_inicio_emprestimo=null, $data_fim_emprestimo=null, $equipamentos=null, $nome_atividade=null, $destino=null){
			$emprestimoModel = new emprestimoModel();
			$resultado = $emprestimoModel->updateEmprestimoModel($solicitante, $cpf_solicitante, $id_emprestimo, $nome_equipamento, $data_inicio_emprestimo, $data_fim_emprestimo, $equipamentos, $nome_atividade, $destino);

			$resultado = $emprestimoModel->editarEmprestimoModel($id_emprestimo);

			include(dirname(__DIR__, 1).'/view/editarEmprestimo.php');
		}


		function excluirEmprestimo($id_emprestimo=null){
		
			$emprestimo = new emprestimoModel();
			$resultado = $emprestimo->excluirEmprestimoModel($id_emprestimo);
			
			if($resultado == true){

				$resultado = $emprestimo->listarEmprestimoModel();
			}	
			session_start();
			$_SESSION['msg'] = "Deletado com sucesso";
			include(dirname(__DIR__, 1).'/view/pesquisarEmprestimo.php');	
			
		}

	}


		if ($_SERVER["REQUEST_METHOD"] === "POST") {
		    $action = $_POST["action"] ?? null;

		    $emprestimoModel = new emprestimoModel();


		    if ($action === "removerEquipamento") {
		        $id_emprestimo = $_POST["id_emprestimo"] ?? null;
		        $codigo_de_barras = $_POST["codigo_barras"] ?? null;

		        if ($id_emprestimo && $codigo_de_barras) {
		            $resultado = $emprestimoModel->removerEquipamentoModel($id_emprestimo, $codigo_de_barras);
		            echo $resultado ? "Equipamento removido!" : "Erro ao remover equipamento.";
		        } else {
		            echo "Dados inválidos.";
		        }
		    }	 
		}