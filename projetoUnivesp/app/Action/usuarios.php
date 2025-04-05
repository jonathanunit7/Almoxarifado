<?php

include(dirname(__DIR__, 1).'/controller/usuariosController.php');
	
	
	
		$usuarios = new usuariosController();
		$usuarios->listarUsuarios();

	

	
	
	
?>