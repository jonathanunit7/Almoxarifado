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

if (isset($_POST['busca'])) {
    $busca = "%" . $_POST['busca'] . "%"; // Adiciona % para usar LIKE no SQL
    $sql = "SELECT codigoDeBarra, nome FROM equipamento WHERE nome LIKE ? LIMIT 10";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $busca);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="equipamento-item label-control" data-id="' . $row['codigoDeBarra'] . '">' . $row['nome'] . '</div>';
        }
    } else {
        echo '<div>Nenhum equipamento encontrado</div>';
    }
}
?>
