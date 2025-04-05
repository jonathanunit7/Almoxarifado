<?php
include 'header.php'; 

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Histórico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>


<div class="container mt-5">
    <h2 class="mb-4">Editar Histórico <?= (isset($resultado[0]['id'])) ? "- ID: ".$resultado[0]['id'] : ""  ?></h2>
    
        <!-- Formulário de Edição -->
    <form action="editarHistoricoEquipamento.php" method="POST">
        <input type="hidden" name="id" value="<?= (isset($resultado)) ? $resultado[0]['id'] : ""?>">

        <div class="mb-3 col-md-6">
            <label for="descrição" class="form-label">Descrição</label>
            <input type="text" class="form-control border-dark" id="descricao" name="descricao" value="<?= (isset($resultado)) ? $resultado[0]['descricao'] : "" ?>" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="nome" class="form-label">Data da manutenção</label>
            <input type="text" class="form-control border-dark" id="data_manutencao" name="data_manutencao" value="<?= (isset($resultado)) ? $resultado[0]['data_manutencao'] : ""  ?>" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="tipo" class="form-label">Responsável</label>
            <input type="text" class="form-control border-dark" id="responsavel" name="responsavel" value="<?= (isset($resultado)) ? $resultado[0]['responsavel'] : "" ?>" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="tipo" class="form-label">Custo</label>
            <input type="text" class="form-control border-dark" id="custo" name="custo" value="<?= (isset($resultado)) ? $resultado[0]['custo'] : "" ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>

<div class="container mt-1">  
    <a href="javascript:history.back();" class="btn btn-secondary mt-3">Voltar</a>
    </div>

</body>
</html>

<script type="text/javascript">
    
 flatpickr("#data_manutencao", {
      enableTime: true,
      dateFormat: "d-m-Y H:i:ss",
      time_24hr: true
  });


</script>



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