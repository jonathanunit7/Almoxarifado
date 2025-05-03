<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR.'solicitacaoModel.php');


 	
	class solicitacaoController{



		function listarSolicitacoes($id_usuario=null){
			$solicitacaoModel = new solicitacaoModel();			
			$resultado = $solicitacaoModel->listarSolicitacoesModel($id_usuario);
			include dirname(__DIR__).'/view/solicitacoes.php';		
		}


		function solicitarEmprestimo($equipamentos=null, $data_inicio=null, $data_fim=null, $solicitante=null, $nome_atividade=null, $destino=null){
			$solicitacaoModel = new solicitacaoModel();
			$resultado = $solicitacaoModel->solicitarEmprestimoModel($equipamentos, $data_inicio, $data_fim, $solicitante, $nome_atividade, $destino);

			if(empty($resultado)){
				return false;
			}else{				
				session_start();
				$_SESSION['msg'] = "Solicitado com sucesso";
				include dirname(__DIR__) . '/View/solicitarEmprestimo.php';
    			exit();	
			}
		}

		
		function entrarSolicitacao($id=null){
			
			$id = intval($id);
			$solicitacaoModel = new solicitacaoModel();
			$resultado = $solicitacaoModel->entrarSolicitacaoModel($id);
			include dirname(__DIR__).'/View/entrarSolicitacao.php';
		}

		function deletarSolicitacao($id=null){
			
			$solicitacao = new solicitacaoModel();
			$resultado = $solicitacao->deletarSolicitacaoModel($id);
			session_start();
			
			if($resultado == true){
			
				$resultado = $solicitacao->listarSolicitacoesModel($_SESSION['user_id']);
			}	
			
			$_SESSION['msg'] = "Deletado com sucesso";
			include(dirname(__DIR__, 1).'/view/solicitacoes.php');	
			
		}



	}
	

?>	