<?php

	include dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'configuration'.DIRECTORY_SEPARATOR.'connect.php';

	class solicitacaoModel{		
		

		function executaQuery($query=null){
			$resultado = mysqli_query(mysqli_connect(HOST, USER, PASSWORD, DBNAME), $query) or die('Erro na consulta');
			if(!is_bool($resultado)){
				$resultado = $resultado->fetch_all(MYSQLI_ASSOC);
			}	
			return $resultado;
		}


		function listarSolicitacoesModel($id_usuario=null){
			$query = "SELECT perfil FROM usuarios where id = $id_usuario";

			$resultado = $this->executaQuery($query);

		 	if ($resultado[0]['perfil'] == "Administrador" || $resultado[0]['perfil'] == "Almoxerife"){

				$query = "SELECT 
								  s.id, 
								  s.id_usuarios, 
								  s.data_inicio_emprestimo, 
								  s.data_fim_emprestimo, 
								  s.nome_atividade, 
								  s.destino, 
								  s.status,
								  u.nome,
								  GROUP_CONCAT(eq.nome SEPARATOR ', ') AS equipamentos
								FROM solicitacao s
								LEFT JOIN solicitacao_equipamento se ON s.id = se.id_solicitacao
								LEFT JOIN equipamento eq ON se.id_equipamento = eq.id							
								LEFT JOIN usuarios u ON s.id_usuarios = u.id
								GROUP BY s.id
								ORDER BY s.id DESC";

				
			}else{
					$query = "SELECT 
								  s.id, 
								  s.id_usuarios, 
								  s.data_inicio_emprestimo, 
								  s.data_fim_emprestimo, 
								  s.nome_atividade, 
								  s.destino, 
								  s.status,
								  u.nome,
								  GROUP_CONCAT(eq.nome SEPARATOR ', ') AS equipamentos
								FROM solicitacao s
								LEFT JOIN solicitacao_equipamento se ON s.id = se.id_solicitacao
								LEFT JOIN equipamento eq ON se.id_equipamento = eq.id							
								LEFT JOIN usuarios u ON s.id_usuarios = u.id

								WHERE s.id_usuarios = $id_usuario
								GROUP BY s.id
								ORDER BY s.id DESC";
			}

			$resultado = $this->executaQuery($query);
			return $resultado;
		}



		function solicitarEmprestimoModel($equipamentos = null, $data_inicio = null, $data_fim = null, $solicitante = null, $nome_atividade = null, $destino = null) {
		    $data_inicio = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data_inicio)));
			$data_fim = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data_fim)));
			$status = "Pendente";

		    $query_solicitacao = "INSERT INTO SOLICITACAO (data_inicio_emprestimo, data_fim_emprestimo, id_usuarios, nome_atividade, destino, status) 
		                          VALUES ('$data_inicio', '$data_fim', '$solicitante', '$nome_atividade', '$destino', '$status')";
		    
		    $resultado_solicitacao = $this->executaQuery($query_solicitacao);

		    if ($resultado_solicitacao) {
		        $query = "SELECT id FROM SOLICITACAO order by id desc LIMIT 1";	
		        $id_solicitacao = $this->executaQuery($query); 
		        $id_solicitacao = $id_solicitacao[0]['id'];
		        
		        // Inserir os equipamentos na tabela SOLICITACAO_EQUIPAMENTO
		        foreach ($equipamentos as $equipamento_id) {
		            $query_equipamento = "INSERT INTO SOLICITACAO_EQUIPAMENTO (id_solicitacao, id_equipamento) 
		                                  VALUES ('$id_solicitacao', '$equipamento_id')";
		            $resultado_equipamento = $this->executaQuery($query_equipamento);
		            
		            // Verifica se a inserção do equipamento foi bem-sucedida
		            if (!$resultado_equipamento) {		               
		                return false; // 
		            }
		        }

		        return true; 
		    } else {
		        return false; 
		    }
		}

		function entrarSolicitacaoModel($id=null){
			$query_solicitacao = "SELECT 
				    s.id,
				    s.id_usuarios,
				    s.data_inicio_emprestimo,
				    s.data_fim_emprestimo,
				    s.nome_atividade,
				    s.destino,
				    s.status,
				    u.id AS usuario_id,
				    u.nome AS nome,
				    u.email AS usuario_email,
				    u.perfil AS usuario_perfil
				FROM solicitacao s
				INNER JOIN usuarios u ON s.id_usuarios = u.id
				WHERE s.id = $id";

			$solicitacao = $this->executaQuery($query_solicitacao);	

			$query_equipamentos = "
			    SELECT e.nome
			    FROM solicitacao_equipamento se
			    INNER JOIN equipamento e ON se.id_equipamento = e.codigoDeBarra
			    WHERE se.id_solicitacao = $id
			";

			$equipamentos = $this->executaQuery($query_equipamentos);
			
			$resultado = [$solicitacao, $equipamentos];
			return $resultado;		
		}

		function deletarSolicitacaoModel($id=null){
			$query = "DELETE FROM SOLICITACAO WHERE id = {$id}";		
			$resultado = $this->executaQuery($query);
			return $resultado;

		}



	}	
