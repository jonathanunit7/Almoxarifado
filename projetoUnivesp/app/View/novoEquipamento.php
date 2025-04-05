<?php
include 'header.php'; 

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Equipamento</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Novo Equipamento</h2>
    
    <!-- Formulário de Edição -->
    <form action="../action/novoEquipamento.php" method="POST">

        <div class="mb-3 col-md-6">
            <label for="codigoDeBarra" class="form-label">Código de Barra</label>
            <input type="text" class="form-control border-dark col-6" id="codigoDeBarra" name="codigo_de_barras" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control border-dark col-6" id="nome" name="nome_equipamento" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control border-dark" id="tipo" name="tipo" required>
        </div>

        <button type="submit" class="btn btn-primary">Inserir</button>
    </form>
</div>

<div class="container mt-1">  
    <a href="equipamentos.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>

</body>
</html>

<?php 

if (isset($_SESSION['msg'])) {
    
  $mensagem = $_SESSION['msg'];
    echo "<div class='alert alert-success alert-dismissible fade show mt-5 container' role='alert'>
            <strong>Sucesso!</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

    unset($_SESSION['msg']);



include 'footer.php'; ?>