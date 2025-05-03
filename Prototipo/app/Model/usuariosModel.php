<?php

	include dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'configuration'.DIRECTORY_SEPARATOR.'connect.php';

	class usuariosModel{		
		

		function executaQuery($query=null){
			$resultado = mysqli_query(mysqli_connect(HOST, USER, PASSWORD, DBNAME), $query) or die('Erro na consulta');
			if(!is_bool($resultado)){
				$resultado = $resultado->fetch_all(MYSQLI_ASSOC);
			}	
			return $resultado;
		}


		function listarUsuariosModel(){

			$query = "SELECT * FROM usuarios";		
			$resultado = $this->executaQuery($query);
			return $resultado;
		}

		function excluirUsuariosModel($id_usuario){

			$query = "DELETE FROM usuarios WHERE id = {$id_usuario}";
	        $resultado = $this->executaQuery($query);
	        return $resultado;
		}

		function editarUsuarioModel($id) {
	        $query = "SELECT *
			FROM usuarios 
			WHERE id = {$id};";
	        $resultado = $this->executaQuery($query);
	        return $resultado;
    	}

    	function updateUsuarioModel($id=null, $nome=null, $cpf=null, $email=null,  $login=null, $senha=null, $perfil=null){		

			$nome = "'" . $nome . "'";
			$cpf = "'" . $cpf . "'";
		    $email = "'" .$email."'";
		    $login = "'" . $login . "'";
		    $perfil = "'" .$perfil."'";
			
			if(preg_match('#^\$2[ayb]\$[0-9]{2}\$[./A-Za-z0-9]{22}[./A-Za-z0-9]{31}$#', $senha) == false){		
				$hash = password_hash($senha, PASSWORD_DEFAULT);
		    	$senha = "'" . $hash . "'";
			}else{
				$senha = "'" . $senha . "'";
			}

		    $query = "UPDATE usuarios 
		              SET nome = {$nome},
		              	  cpf = {$cpf}, 
		                  email = {$email},
		                  login = {$login},
		                  senha = {$senha}, 
		                  perfil = {$perfil}
		              WHERE id = {$id}";
		    $resultado = $this->executaQuery($query);
		    
		    return $resultado;
		}


		function inserirUsuarioModel($nome=null, $cpf=null, $email=null,  $login=null, $senha=null, $perfil=null){	
		    
			if($this->confereLoginUnico($login)){
				return false;
			}else{

			    $nome = "'" . $nome . "'";
			    $cpf = "'" . $cpf . "'";
			    $email = "'" .$email."'";
			    $login = "'" . $login . "'";			   
			    $perfil = "'" .$perfil."'";

			    $hash = password_hash($senha, PASSWORD_DEFAULT);
			     $senha = "'" . $hash . "'";

			    $query = "INSERT INTO usuarios (nome, cpf, email, login, senha, perfil) 
			              VALUES ({$nome}, {$cpf}, {$email}, {$login}, {$senha}, {$perfil})";
			    $resultado = $this->executaQuery($query);
			    return $resultado;
			}
		}

		function confereLoginUnico($login=null){
			$login = "'" . $login . "'";
			$query = "SELECT *
			FROM usuarios 
			WHERE login = {$login};";
	        $resultado = $this->executaQuery($query);
	        return $resultado;
		}



	}	