<?php
include dirname(__DIR__, 2)."/configuration/connect.php";  // Inclui a conexão com o banco de dados

        
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "prototipo";

// Criar a conexão
$conn = new mysqli($host, $user, $pass, $dbname);



// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['equipamentos'])) {

    $equipamentos = $_POST['equipamentos'];
    $solicitante = 'Jonathan';
    $data_emprestimo = '2018-04-23';

     foreach ($equipamentos as $codigo) {
        $stmt = $conn->prepare("INSERT INTO emprestimos (solicitante, equipamentos, data_emprestimo) 
                                SELECT ?, solicitante, ?, 'emprestado' FROM equipamentos WHERE codigoDeBarra = ?");
        $stmt->bind_param("iss", $solicitante, $data_emprestimo, $codigo);
        $stmt->execute();
        $stmt->close();
    }

    echo "Empréstimo realizado com sucesso!";
    $conn->close();
}

?>
