<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Solicitação de Empréstimo</title>
</head>
<body>
  <div class="container mt-4 mb-5">
    <div class="card shadow-lg border-0">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Solicitação de Empréstimo</h3>
      </div>
      <div class="card-body">
        <form action="../Action/solicitarEmprestimo.php" method="POST" id="formulario">

          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <label for="solicitante" class="form-label">Solicitante:</label>
              <input type="text" id="solicitante" name="solicitante" class="form-control" value="<?=$_SESSION['nome'] ?>"  readonly required>
              <input type="hidden" name="id_usuario" value="<?=$_SESSION['user_id'] ?>">
            </div>
            <div class="col-md-4">
              <label for="data_inicio_emprestimo" class="form-label">Data Inicial:</label>
              <input type="datetime-local" id="data_inicio_emprestimo" name="data_inicio_emprestimo" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label for="data_fim_emprestimo" class="form-label">Data Final:</label>
              <input type="datetime-local" id="data_fim_emprestimo" name="data_fim_emprestimo" class="form-control" required>
            </div>
          </div>

          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label for="nome_atividade" class="form-label">Nome da Atividade:</label>
              <input type="text" id="nome_atividade" name="nome_atividade" class="form-control" placeholder="Nome da atividade" required>
            </div>
            <div class="col-md-6">
              <label for="destino" class="form-label">Destino:</label>
              <input type="text" id="destino" name="destino" class="form-control" placeholder="Destino da solicitação" required>
            </div>
          </div>

          <h4 class="mt-4">Buscar Equipamento para Empréstimo:</h4>
          <input type="text" id="busca-equipamento" name="busca-equipamento" class="form-control mb-3" placeholder="Digite para buscar..." autocomplete="off">
          <div id="lista-equipamentos" class="list-group mb-3"></div>
          <ul id="equipamentos-selecionados" class="list-group mb-4"></ul>

          <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-success btn-lg">Solicitar Empréstimo</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php 
    if (isset($_GET['msg']) || isset($_SESSION['msg'])) {
      $mensagem = $_SESSION['msg'];
      echo "<div class='alert alert-success alert-dismissible fade show mt-5 container' role='alert'>
              <strong>Resultado:</strong> $mensagem
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
      unset($_SESSION['msg']);
    }
  ?>

  <script>
    let equipamentosSelecionados = [];

    $(document).ready(function() {
      $('#busca-equipamento').keyup(function() {
        let busca = $(this).val();
        let data_inicio = $('#data_inicio_emprestimo').val();
        let data_fim = $('#data_fim_emprestimo').val();
        if (busca.length >= 2) {
          $.ajax({
            url: '../Model/buscarEquipamentos.php',
            type: 'POST',
            data: { 
              busca: busca,
              data_inicio: data_inicio,
              data_fim: data_fim,
              excluidos: equipamentosSelecionados
            },
            success: function(data) {
              $('#lista-equipamentos').html(data).show();
            }
          });
        } else {
          $('#lista-equipamentos').hide();
        }
      });

      $(document).on('click', '.equipamento-item', function() {
        let equipamentoNome = $(this).text();
        let equipamentoId = $(this).data('id');

        equipamentosSelecionados.push(equipamentoId);

        let novoItem = ` 
          <li class="list-group-item d-flex justify-content-between align-items-center">
            ${equipamentoNome}
            <button type="button" class="btn btn-danger btn-sm remover-equipamento" data-id="${equipamentoId}">Remover</button>
            <input type="hidden" name="equipamentos[]" value="${equipamentoId}">
          </li>`;
        $('#equipamentos-selecionados').append(novoItem);
        $('#busca-equipamento').val('');
        $('#lista-equipamentos').hide();
      });

      $(document).on('click', '.remover-equipamento', function() {
        let equipamentoId = $(this).data('id');
        $(this).closest('li').remove();
        equipamentosSelecionados = equipamentosSelecionados.filter(id => id !== equipamentoId);
      });
    });
  </script>

<?php include 'footer.php'; ?>
</body>
</html>
