<?php
include dirname(__DIR__, 2)."/configuration/connect.php";  // Inclui a conexão com o banco de dados

$conn = mysqli_connect(HOST, USER, PASSWORD, DBNAME);


if (isset($_POST['busca'])) {
    $pesquisa = "%" . $_POST['busca'] . "%"; // Adiciona % para usar LIKE no SQL
    $data_inicio_emprestimo = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['data_inicio'])));
    $data_fim_emprestimo = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['data_fim'])));
    $query = "
            SELECT *
            FROM equipamento e
            WHERE e.status = 'disponível'
            AND NOT EXISTS (
                SELECT 1
                FROM emprestimos em
                WHERE em.codigo_de_barras = e.codigoDeBarra
                AND (
                    (em.data_inicio_emprestimo BETWEEN ? AND ?) 
                    OR (em.data_fim_emprestimo BETWEEN ? AND ?)
                    OR (? BETWEEN em.data_inicio_emprestimo AND em.data_fim_emprestimo)
                )
            )
            AND e.nome LIKE ?";

   
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $data_inicio_emprestimo, $data_fim_emprestimo, $data_inicio_emprestimo, $data_fim_emprestimo, $data_inicio_emprestimo, $pesquisa);
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
