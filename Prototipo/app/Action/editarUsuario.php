<?php

include(dirname(__DIR__, 1).'/controller/usuariosController.php');


	
	
	if (isset($_GET['id_usuario'])){
		$usuario = new usuariosController();
		$usuario->editarUsuario($_GET['id_usuario']);
	}
	
	if(isset($_POST['nome']) && isset($_POST['senha']) && isset($_POST['email']) && isset($_POST['perfil'])){
		$usuario = new usuariosController();
		$usuario->updateUsuario($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['login'], $_POST['senha'], $_POST['perfil']);
	}

	
	
	
?>