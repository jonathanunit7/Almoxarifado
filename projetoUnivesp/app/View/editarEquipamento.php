<?php
include 'header.php'; 

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipamento</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Editar Equipamento <?= (isset($resultado['nome'])) ? "-".$resultado['nome'] : ""  ?></h2>
    
    <!-- Formulário de Edição -->
    <form action="editarEquipamento.php" method="POST">
        <input type="hidden" name="id" value="<?= (isset($resultado)) ? $resultado[0]['id'] : ""?>">

        <div class="mb-3 col-md-6">
            <label for="codigoDeBarra" class="form-label">Código de Barra</label>
            <input type="text" class="form-control border-dark" id="codigoDeBarra" name="codigo_de_barras" value="<?= (isset($resultado)) ? $resultado[0]['codigoDeBarra'] : "" ?>" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control border-dark" id="nome" name="nome" value="<?= (isset($resultado)) ? $resultado[0]['nome'] : ""  ?>" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control border-dark" id="tipo" name="tipo" value="<?= (isset($resultado)) ? $resultado[0]['tipo'] : "" ?>" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="selectBasico" class="form-label">Status do equipamento:</label>
            <select class="form-select border-dark" id="selectBasico" name="status" required>
                <option value="Disponível" <?= ($resultado[0]['status'] == "Disponível") ? 'selected' : '' ?> >Disponível</option>
                <option value="Manutenção" <?= ($resultado[0]['status'] == "Manutenção") ? 'selected' : '' ?>>Manutenção</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>


</div>
<div class="container mt-1">  
    <a href="javascript:history.back();" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</body>
</html>

<?php 

if (isset($_SESSION['msg'])) {
    
  $mensagem = $_SESSION['msg'];
    echo "<div class='alert alert-success alert-dismissible fade show mt-5 container' role='alert'>
            <strong>Resultado:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

    unset($_SESSION['msg']);


include 'footer.php'; ?>