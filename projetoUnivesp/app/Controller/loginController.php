<?php


	include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR.'loginModel.php');
	/**
 	* 
 	*/




	class loginController{
		
		function verificaLogin($login=null, $senha=null){
			$consultaModel = new loginModel();
			$resultado = $consultaModel->verificaLoginModel($login, $senha);

			if($resultado==false){
				include_once '..'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'index.php';
			}else{
				include_once '..'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'header.php';
				include_once '..'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Bem-Vindo.php';
				include_once '..'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'footer.php';
			}
		}
	}