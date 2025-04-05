<?php

	include dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'configuration'.DIRECTORY_SEPARATOR.'connect.php';

	class emprestimoModel{		
		

		function executaQuery($query=null){
			$resultado = mysqli_query(mysqli_connect(HOST, USER, PASSWORD, DBNAME), $query) or die('Erro na consulta');
			if(!is_bool($resultado)){
				$resultado = $resultado->fetch_all(MYSQLI_ASSOC);
			}	
			return $resultado;
		}

		function emprestarEquipamentoModel($codigoDeBarras=null, $nome_equipamento, $solicitante=null, $cpfSolicitante=null, $id_emprestimo, $data_inicio_emprestimo=null, $data_fim_emprestimo=null){			
			
			$data_inicio = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['data_inicio_emprestimo'])));
			$data_fim = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['data_fim_emprestimo'])));
			$data_do_emprestimo = date('Y-m-d H:i:s');	

			$query = "INSERT INTO EMPRESTIMOS (SOLICITANTE, nome_equipamento, codigo_de_barras, DATA_EMPRESTIMO, CPF_SOLICITANTE, id_emprestimo, data_inicio_emprestimo, data_fim_emprestimo) VALUES ('$solicitante', '$nome_equipamento', '$codigoDeBarras', '$data_do_emprestimo', '$cpfSolicitante', '$id_emprestimo', '$data_inicio', '$data_fim')";				 
			$resultado = $this->executaQuery($query);
			return $resultado;	
		}


		function pesquisaEmprestimoModel($cod_emprestimo=null){

			if($cod_emprestimo != "*"){		
				$cod_emprestimo = "'{$cod_emprestimo}'";			
				$query = "SELECT * FROM emprestimos WHERE id_emprestimo={$cod_emprestimo} group by id_emprestimo";
			}else{
				$query = "SELECT * FROM emprestimos group by id_emprestimo";
			}						 
			$resultado = $this->executaQuery($query);
			return $resultado;
		}

		function listarEmprestimoModel(){

			$query = "SELECT * FROM emprestimos group by id_emprestimo";		
			$resultado = $this->executaQuery($query);
			return $resultado;
		}

		public function buscaUltimoRegistroModel(){
			$query = "SELECT id_emprestimo FROM emprestimos order by id_emprestimo desc  LIMIT 1";		
			$resultado = $this->executaQuery($query);

			
			return $resultado[0]["id_emprestimo"];
		}

		function editarEmprestimoModel($id_emprestimo=null){
			$query = "SELECT * FROM emprestimos where id_emprestimo = {$id_emprestimo}";		
			$resultado = $this->executaQuery($query);
			return $resultado;	

		}

		function removerEquipamentoModel($id_emprestimo, $codigo_de_barras) {
	        $query = "DELETE FROM emprestimos WHERE id_emprestimo = {$id_emprestimo} AND codigo_de_barras = {$codigo_de_barras}";
	        $resultado = $this->executaQuery($query);
	        echo json_encode([
					        "sucesso" => $resultado,
					        "mensagem" => $resultado ? "Equipamento removido com sucesso!" : "Erro ao remover equipamento."]);
	        exit();
    	}

    	function updateEmprestimoModel($solicitante=null, $cpf_solicitante=null, $id_emprestimo=null, $nome_equipamento=null, $data_inicio_emprestimo=null, $data_fim_emprestimo=null, $equipamentos=null){
    		
    		$data_do_emprestimo = date('Y-m-d H:i:s');

			foreach (array_keys($equipamentos) as $i) {	        
	        
		        $query = "INSERT INTO EMPRESTIMOS (solicitante, nome_equipamento, codigo_de_barras, DATA_EMPRESTIMO, CPF_SOLICITANTE, id_emprestimo, data_inicio_emprestimo, data_fim_emprestimo) VALUES ('$solicitante', '$nome_equipamento[$i]', '$equipamentos[$i]', '$data_do_emprestimo', '$cpf_solicitante', '$id_emprestimo', '$data_inicio_emprestimo', '$data_fim_emprestimo')";				 
				$resultado = $this->executaQuery($query);
			}
			return $resultado;
    	}

    	function excluirEmprestimoModel($id_emprestimo=null){		

			$query = "DELETE FROM emprestimos WHERE id_emprestimo = {$id_emprestimo}";		
			$resultado = $this->executaQuery($query);
			return $resultado;
		}


    



	}



	
		