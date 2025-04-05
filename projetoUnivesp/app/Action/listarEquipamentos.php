<?php

include(dirname(__DIR__, 1).'/controller/equipamentoController.php');


	$pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';
		
	$equipamentos = new equipamentoController();

	$equipamentos->listarEquipamentos($pesquisa);
?>