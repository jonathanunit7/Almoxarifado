<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR.'equipamentoModel.php');


 	
	class equipamentoController{
		
		function listarEquipamentos($pesquisa=null){
		
			if($pesquisa == ""){	
				$pesquisa = "*";
			}
			$equipamentos = new equipamentoModel();
			$resultado = $equipamentos->listarEquipamentosModel($pesquisa);
			include(dirname(__DIR__, 1).'/view/equipamentos.php');	
			
		}

		function updateEquipamento($id=null, $nome_equipamento=null, $codigo_de_barras=null, $tipo=null, $status=null){
		
			$equipamento = new equipamentoModel();
			$resultado = $equipamento->updateEquipamentoModel($id, $nome_equipamento, $codigo_de_barras, $tipo, $status);
			
			if($resultado==true){
				$resultado = $equipamento->editarEquipamentoModel($id);
				session_start();
			    $_SESSION['msg'] = "Alteração realizada com sucesso";
				include(dirname(__DIR__, 1).'/view/editarEquipamento.php');	
			}
			
		}

		function editarEquipamento($id=null){
		
			$equipamento = new equipamentoModel();
			$resultado = $equipamento->editarEquipamentoModel($id);
			include(dirname(__DIR__, 1).'/view/editarEquipamento.php');		
			
		}

		function historicoEquipamento($id=null){

			$equipamento = new equipamentoModel();
			$resultado = $equipamento->historicoEquipamentoModel($id);
			if($resultado==false){
				$id;
				include dirname(__DIR__).'/view/historicoEquipamento.php';	
			}else{
				include dirname(__DIR__).'/view/historicoEquipamento.php';	
			}		
		}

		function editarHistoricoEquipamento($id=null){

			$equipamento = new equipamentoModel();
			$resultado = $equipamento->editarHistoricoEquipamentoModel($id);
			include dirname(__DIR__).'/view/editarHistoricoEquipamento.php';		
		}

		function updateHistoricoEquipamento($id=null, $descricao=null, $data_manutencao=null, $responsavel=null, $custo=null){
			$equipamento = new equipamentoModel();
			$resultado = $equipamento->updateHistoricoEquipamentoModel($id, $descricao, $data_manutencao, $responsavel, $custo);
			if($resultado==true){
				$resultado = $equipamento->editarHistoricoEquipamentoModel($id);
				session_start();
				$_SESSION['msg'] = "Alteração realizada com sucesso";
				include dirname(__DIR__).'/view/editarHistoricoEquipamento.php';
			}		
		}


		function excluirEquipamento($id=null){
		
			$equipamento = new equipamentoModel();
			$resultado = $equipamento->excluirEquipamentoModel($id);
			
			if($resultado == true){

				$resultado = $equipamento->listarEquipamentosModel("");
			}	
			session_start();
			$_SESSION['msg'] = "Deletado com sucesso";
			include(dirname(__DIR__, 1).'/view/equipamentos.php');	
			
		}


		function excluirHistoricoEquipamento($id=null){
		
			$equipamento = new equipamentoModel();
			$resultado = $equipamento->excluirHistoricoEquipamentoModel($id);
			$resultado = null;
			session_start();
			$_SESSION['msg'] = "Deletado com sucesso";
			include(dirname(__DIR__, 1).'/view/equipamentos.php');	

		}

		function inserirEquipamento($codigo_de_barras=null, $nome_equipamento=null, $tipo=null){

			$equipamento = new equipamentoModel();
			$resultado = $equipamento->inserirEquipamentoModel($codigo_de_barras, $nome_equipamento, $tipo);
			session_start();
			$_SESSION['msg'] = "Inserido com sucesso";
			include dirname(__DIR__).'/view/novoEquipamento.php';		
		}

		function inserirHistoricoEquipamento($id=null, $descricao=null, $data_manutencao=null, $responsavel=null, $custo=null){

			$equipamento = new equipamentoModel();
			$resultado = $equipamento->inserirHistoricoEquipamentoModel($id, $descricao, $data_manutencao, $responsavel, $custo);
			session_start();
			$_SESSION['msg'] = "Inserido com sucesso";
			include dirname(__DIR__).'/view/novoHistorico.php';		
		}


	}	