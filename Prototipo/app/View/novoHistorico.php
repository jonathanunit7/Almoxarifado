<?php
include 'header.php';   
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Histórico</title>
</head>
<body>


<div class="container mt-5">
    <h2 class="mb-4">Novo Histórico <?= (isset($_GET['nome'])) ? ": ". $_GET['nome'] : ""  ?></h2>
    
        <!-- Formulário de Edição -->
    <form action="..\action\novoHistoricoEquipamento.php" method="POST">
        <input type="hidden" name="id" value="<?= (isset($_GET['id'])) ? $_GET['id'] : ""?>">

        <div class="mb-3 col-md-6">
            <label for="descrição" class="form-label">Descrição</label>
            <input type="text" class="form-control border-dark" id="descricao" name="descricao" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="nome" class="form-label">Data da manutenção</label>
            <input type="text" class="form-control border-dark" id="data_manutencao" name="data_manutencao" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="tipo" class="form-label">Responsável</label>
            <input type="text" class="form-control border-dark" id="responsavel" name="responsavel" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="tipo" class="form-label">Custo</label>
            <input type="text" class="form-control border-dark" id="custo" name="custo" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
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
            <strong>Mensagem:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

    unset($_SESSION['msg']);


include 'footer.php'; ?>