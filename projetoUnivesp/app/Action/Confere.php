 		
<?php


include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'loginController.php');


 	

 	if (!empty($_POST['login']) && !empty($_POST['senha']) ){
		$login = new loginController();
		$login->verificaLogin($_POST['login'], $_POST['senha']);
	}