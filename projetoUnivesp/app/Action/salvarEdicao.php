<?php

include(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'emprestimoController.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['equipamentos'])) {
        $emprestimo = new emprestimoController();
        
        $emprestimo->updateEmprestimo($_POST['solicitante'], $_POST['cpf_solicitante'], $_POST['id_emprestimo'], $_POST['nome_equipamentos'], $_POST['data_inicio_emprestimo'], $_POST['data_fim_emprestimo'], $_POST['equipamentos'] );
        
    }else{
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
?>