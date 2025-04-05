<?php

	include dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'configuration'.DIRECTORY_SEPARATOR.'connect.php';

	class equipamentoModel{		
		

		function executaQuery($query=null){
			$resultado = mysqli_query(mysqli_connect(HOST, USER, PASSWORD, DBNAME), $query) or die('Erro na consulta');
			if(!is_bool($resultado)){
				$resultado = $resultado->fetch_all(MYSQLI_ASSOC);
			}	
			return $resultado;
		}

		function listarEquipamentosModel($pesquisa=null){		

			$pesquisa = "%".$pesquisa."%";
			$query = "SELECT * FROM equipamento where nome like '$pesquisa' or tipo like '$pesquisa' or codigoDeBarra like '$pesquisa'";		
			$resultado = $this->executaQuery($query); 
			return $resultado;
		}


		function updateEquipamentoModel($id=null, $nome_equipamento=null, $codigo_de_barras=null, $tipo=null, $status=null){		

			$nome_equipamento = "'" . $nome_equipamento . "'";
		    $codigo_de_barras = "'" . $codigo_de_barras . "'";
		    $tipo = "'" .$tipo."'";
		    $status = "'" .$status."'";

		   
		    $query = "UPDATE equipamento 
		              SET nome = {$nome_equipamento}, 
		                  tipo = {$tipo}, 
		                  codigoDeBarra = {$codigo_de_barras},
		                  status = {$status}
		              WHERE id = {$id}";

		    $resultado = $this->executaQuery($query);
		    
		    return $resultado;
		}

		function editarEquipamentoModel($id=null){		

			$query = "SELECT * FROM equipamento where id = {$id}";		
			$resultado = $this->executaQuery($query);
			return $resultado;
		}

		function historicoEquipamentoModel($id_equipamento) {
	        $query = "SELECT *
			FROM equipamento e
			INNER JOIN historico h ON e.id = h.id_equipamento
			WHERE h.id_equipamento = {$id_equipamento} 
			ORDER BY h.data_manutencao DESC;";
	        $resultado = $this->executaQuery($query);
	        return $resultado;
    	}

    	function editarHistoricoEquipamentoModel($id) {
	        $query = "SELECT *
			FROM historico 
			WHERE id = {$id};";
	        $resultado = $this->executaQuery($query);
	        return $resultado;
    	}

    	function updateHistoricoEquipamentoModel($id=null, $descricao=null, $data_manutencao=null, $responsavel=null, $custo=null){		

    		$data_manutencao = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data_manutencao)));
			$descricao = "'" . $descricao . "'";
		    $data_manutencao = "'" .$data_manutencao."'";
		    $responsavel = "'" . $responsavel . "'";
		    $custo = "'" .$custo."'";

		   
		    $query = "UPDATE historico 
		              SET descricao = {$descricao}, 
		                  data_manutencao = {$data_manutencao},
		                  custo = {$custo}, 
		                  responsavel = {$responsavel}
		              WHERE id = {$id}";
		    $resultado = $this->executaQuery($query);
		    
		    return $resultado;
		}


		function excluirEquipamentoModel($id=null){		

			$query = "DELETE FROM equipamento WHERE id = {$id}";		
			$resultado = $this->executaQuery($query);
			return $resultado;
		}

		function excluirHistoricoEquipamentoModel($id=null){		

			$query = "DELETE FROM historico WHERE id = {$id}";		
			$resultado = $this->executaQuery($query);
			return $resultado;
		}

		function inserirEquipamentoModel($codigo_de_barras = null, $nome_equipamento = null, $tipo = null) {
		    $codigo_de_barras = "'" . $codigo_de_barras . "'";
		    $nome_equipamento = "'" . $nome_equipamento . "'";
		    $tipo = "'" . $tipo . "'";
		    $status = "'disponível'";

		    $query = "INSERT INTO equipamento (codigoDeBarra, nome, tipo, status) 
		              VALUES ({$codigo_de_barras}, {$nome_equipamento}, {$tipo}, {$status})";

		    $resultado = $this->executaQuery($query);
		    return $resultado;
		}

		function inserirHistoricoEquipamentoModel($id = null, $descricao = null, $data_manutencao = null, $responsavel=null, $custo) {
		    $id_equipamento = $id;
			$nome_equipamento = "'" . $descricao . "'";
			$responsavel = "'" . $responsavel . "'";
			$custo = "'" . $custo . "'";
			$data_manutencao = "'" . date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data_manutencao))) . "'";

			$query = "INSERT INTO historico (id_equipamento, descricao, data_manutencao, responsavel, custo) 
			          VALUES ({$id_equipamento}, {$nome_equipamento}, {$data_manutencao}, {$responsavel}, {$custo})";

			$resultado = $this->executaQuery($query);
			return $resultado;

		}


	}	
