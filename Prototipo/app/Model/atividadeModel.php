<?php

	include dirname(__DIR__, 2)."/configuration/connect.php";

	class atividadeModel{		
		
		function executaQuery($query=null){
			$resultado = mysqli_query(mysqli_connect(HOST, USER, PASSWORD, DBNAME), $query) or die('Erro na consulta');
			if(!is_bool($resultado)){
				$resultado = $resultado->fetch_all(MYSQLI_ASSOC);
			}	
			return $resultado;
		}

		function novaAtividadeModel($nome_atividade=null, $destino=null, $data_inicio_emprestimo=null, $data_fim_emprestimo=null, $hora_inicio_emprestimo=null, $hora_fim_emprestimo=null, $frequencia=null, $equipamentos=null, $nome_equipamentos=null, $solicitante=null, $cpf_solicitante=null){

			// Converte as strings para o formato Y-m-d H:i:s
			$data_inicio = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data_inicio_emprestimo.' '.$hora_inicio_emprestimo. ':00')));
			$data_fim = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data_fim_emprestimo.' '.$hora_fim_emprestimo. ':00')));
			$data_do_emprestimo = date('Y-m-d H:i:s');

			$id_emprestimo = $this->buscaUltimoRegistroModel();
			$id_emprestimo++;

			$datas_encontradas = [];

			//var_dump($data_inicio); exit;

			$query = "INSERT INTO ATIVIDADE (nome_atividade, destino, data_inicio_emprestimo, data_fim_emprestimo, frequencia) VALUES ('$nome_atividade', '$destino', '$data_inicio', '$data_fim', '$frequencia')";					 
			$resultado = $this->executaQuery($query);

				if($frequencia != '8'){
					// Agora transforma as strings em objetos DateTime
					$data_inicio = new DateTime($data_inicio);
					$data_fim = new DateTime($data_fim);

					// Adiciona 1 dia para incluir a data final no intervalo
					$data_fim->modify('+1 day');

					$intervalo = new DateInterval('P1D'); // Intervalo de 1 dia

					// Usa os objetos DateTime diretamente (NÃO strings formatadas!)
					$periodo = new DatePeriod($data_inicio, $intervalo, $data_fim);

					foreach ($periodo as $data) {
					    if ($data->format('N') == $frequencia) { 
					        $datas_encontradas[] = $data->format('Y-m-d');
					    }
					}

					foreach (array_keys($datas_encontradas) as $i){

					foreach (array_keys($equipamentos) as $j){				
						$equipamento = intval($equipamentos[$j]);
						$nome_equipamento = $nome_equipamentos[$j];

						$data_in = $datas_encontradas[$i] . ' ' . $hora_inicio_emprestimo . ':00';
						$data_out = $datas_encontradas[$i] . ' ' . $hora_fim_emprestimo . ':00';
		
						$query = "INSERT INTO EMPRESTIMOS (solicitante, nome_equipamento, codigo_de_barras, DATA_EMPRESTIMO, CPF_SOLICITANTE, id_emprestimo, data_inicio_emprestimo, data_fim_emprestimo, destino, atividade) VALUES ('$solicitante', '$nome_equipamento', '$equipamento', '$data_do_emprestimo', '$cpf_solicitante', '$id_emprestimo', '$data_in', '$data_out', '$destino', '$nome_atividade')";	

						$resultado = $this->executaQuery($query);
					}
					$id_emprestimo++;
					}	
				}else{

					foreach (array_keys($equipamentos) as $i){

						$equipamento = intval($equipamentos[$i]);
						$nome_equipamento = $nome_equipamentos[$i];
		
						$query = "INSERT INTO EMPRESTIMOS (solicitante, nome_equipamento, codigo_de_barras, DATA_EMPRESTIMO, CPF_SOLICITANTE, id_emprestimo, data_inicio_emprestimo, data_fim_emprestimo, destino, atividade) VALUES ('$solicitante', '$nome_equipamento', '$equipamento', '$data_do_emprestimo', '$cpf_solicitante', '$id_emprestimo', '$data_inicio', '$data_fim', '$destino', '$nome_atividade')";	


						$resultado = $this->executaQuery($query);
					}
				}	

			return $resultado;				
							
		}


		function buscaUltimoRegistroModel(){
			$query = "SELECT id_emprestimo FROM emprestimos order by id_emprestimo desc  LIMIT 1";		
			$resultado = $this->executaQuery($query);

			if(is_null($resultado) || empty($resultado)){
				return '0';
			}else{
				return $resultado[0]["id_emprestimo"];
			}
				
		}


		function listarAtividadeModel(){
				$query = "SELECT * FROM atividade";		
				$resultado = $this->executaQuery($query);
				return $resultado;
		}

		function excluirAtividadeModel($id_atividade=null){		
			$query = "DELETE FROM atividade WHERE id = {$id_atividade}";		
			$resultado = $this->executaQuery($query);
			return $resultado;
		}

		function editarAtividadeModel($id_atividade=null){
			$query = "SELECT * FROM atividade where id = {$id_atividade}";		
			$resultado = $this->executaQuery($query);
			return $resultado;
		}		

}	
	
		