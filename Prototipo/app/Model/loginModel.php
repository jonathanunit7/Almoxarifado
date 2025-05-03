<?php

	include dirname(__DIR__, 2)."/configuration/connect.php";

	class loginModel{		
		function executaQuery($query=null){
			$resultado = mysqli_query(mysqli_connect(HOST, USER, PASSWORD, DBNAME), $query) or die('Erro na consulta');
			if(!is_bool($resultado)){
				$resultado = $resultado->fetch_all(MYSQLI_ASSOC);
			}	
			return $resultado;
		}

		function verificaLoginModel($login=null, $senha=null){			
			$login = "'{$login}'";
			$query = "SELECT * FROM usuarios WHERE login={$login}";				 
			$resultado = $this->executaQuery($query);
			session_start();
			
			if ($resultado) {
			    if (password_verify($senha, $resultado[0]['senha'])) {


			    	 $_SESSION['user_id'] = $resultado[0]['id'];
       				 $_SESSION['nome'] = $resultado[0]['nome'];
       				 $_SESSION['cpf'] = $resultado[0]['cpf'];
       				 $_SESSION['perfil'] = $resultado[0]['perfil'];       				 

			    	return $resultado;
			    }else {
			    	return false;
			    } 

			}

		}

	}	
	
		