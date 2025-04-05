<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'usuariosController.php');

 	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['senha'])) {
 		$usuario = new usuariosController();
 		$usuario->inserirUsuario($_POST['nome'], $_POST['email'],  $_POST['login'], $_POST['senha'],  $_POST['perfil']);
	}else{
 		header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();  
 	}