<?php

include dirname(__DIR__, 2)."/configuration/connect.php";  // Inclui a conexão com o banco de dados

		
$conn = mysqli_connect(HOST, USER, PASSWORD, DBNAME);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigoDeBarras'])) {
    $codigo = $_POST['codigoDeBarras'];
    $data_inicio_emprestimo = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['data_inicio_emprestimo'])));
    $data_fim_emprestimo = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['data_fim_emprestimo'])));

    if (verificarDisponibilidade($conn, $codigo, $data_inicio_emprestimo, $data_fim_emprestimo)) {
        $stmt = $conn->prepare("SELECT id, nome, tipo, codigoDeBarra FROM equipamento WHERE codigoDeBarra = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            echo json_encode($row);
        } else {
            echo json_encode(["erro" => "Equipamento não encontrado!"]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(["erro" => "O equipamento escolhido já está reservado para o período selecionado"]); exit;
    }


    
}


function verificarDisponibilidade($conn, $codigo, $data_inicio, $data_fim) {

    $sql = "SELECT * FROM emprestimos 
            WHERE codigo_de_barras = ? 
            AND (
                (data_inicio_emprestimo BETWEEN ? AND ?) 
                OR (data_fim_emprestimo BETWEEN ? AND ?) 
                OR (? BETWEEN data_inicio_emprestimo AND data_fim_emprestimo) 
                OR (? BETWEEN data_inicio_emprestimo AND data_fim_emprestimo)
            )";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $codigo, $data_inicio, $data_fim, $data_inicio, $data_fim, $data_inicio, $data_fim);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows === 0; 
}

    ?>
