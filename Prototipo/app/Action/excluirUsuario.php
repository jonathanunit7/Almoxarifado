<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'usuariosController.php');


	if (isset($_GET['id_usuario'])) {
		$usuario = new usuariosController();
		$usuario->excluirUsuario($_GET['id_usuario']);			
	}else{
		header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();	
	}


?>