<?php

include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR.'usuariosModel.php');


 	
	class usuariosController{

		function listarUsuarios(){
			$usuarios = new usuariosModel();
			$resultado = $usuarios->listarUsuariosModel();
			include(dirname(__DIR__, 1).'/view/usuarios.php');
		}

		function excluirUsuario($id_usuario=null){
			$usuarios = new usuariosModel();
			$resultado = $usuarios->excluirUsuariosModel($id_usuario);
			$resultado = $usuarios->listarUsuariosModel();
			session_start();
			$_SESSION['msg'] = "Deletado com sucesso";
			include(dirname(__DIR__, 1).'/view/usuarios.php');
		
		}	
		
		function editarUsuario($id=null){
			$usuario = new usuariosModel();
			$resultado = $usuario->editarUsuarioModel($id);
			include(dirname(__DIR__, 1).'/view/editarUsuario.php');		
			
		}

		function updateUsuario($id=null, $nome=null, $cpf=null, $email=null, $login=null, $senha=null, $perfil=null){
		
			$usuario = new usuariosModel();
			$resultado = $usuario->updateUsuarioModel($id, $nome, $cpf, $email, $login, $senha, $perfil);
			
			if($resultado==true){
				$resultado = $usuario->editarUsuarioModel($id);
				session_start();
			    $_SESSION['msg'] = "Edição feita com sucesso";
				include(dirname(__DIR__, 1).'/view/editarUsuario.php');	
			}
			
		}

		function inserirUsuario($nome=null, $cpf=null, $email=null, $login=null, $senha=null, $perfil=null){

			$usuario = new usuariosModel();
			$resultado = $usuario->inserirUsuarioModel($nome, $cpf, $email, $login, $senha, $perfil);

			if($resultado != false){
				session_start();
				$_SESSION['msg'] = "Inserido com sucesso";
				include dirname(__DIR__).'/view/novoUsuario.php';
			}else{
				session_start();
				$_SESSION['msg2'] = "Esse login já existe. Escolha outro login";
				include dirname(__DIR__).'/view/novoUsuario.php';	
			}		
		}


		
	}
