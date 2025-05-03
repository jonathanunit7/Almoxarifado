<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Criar Nova Atividade</title>
</head>
<body>

<div class="container mt-4 mb-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
      <h3 class="mb-0">Criar Nova Atividade</h3>
    </div>
    <div class="card-body">

      <form action="../Action/novaAtividade.php" method="POST">

        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <label for="nome" class="form-label">Nome da Atividade</label>
            <input type="text" class="form-control" id="nome" name="nome_atividade" required>
          </div>

          <div class="col-md-2">
            <label for="data_inicio" class="form-label">Data Inicial</label>
            <input type="date" id="data_inicio" name="data_inicio_emprestimo" class="form-control" required>
          </div>

          <div class="col-md-2">
            <label for="data_fim" class="form-label">Data Final</label>
            <input type="date" id="data_fim" name="data_fim_emprestimo" class="form-control" required>
          </div>

          <div class="col-md-2">
            <label for="hora_inicio" class="form-label">Hoário inicial</label>
            <input type="time" id="hora_inicio" name="hora_inicio_emprestimo" class="form-control" required>
          </div>

          <div class="col-md-2">
            <label for="hora_fim" class="form-label">Horário Final</label>
            <input type="time" id="hora_fim" name="hora_fim_emprestimo" class="form-control" required>
          </div>
        </div>

        <input type="hidden" name="solicitante" value="<?= $_SESSION['nome']?>">
                <input type="hidden" name="cpf_solicitante" value="<?= $_SESSION['cpf']?>">




        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <label for="dia_semana" class="form-label">Em qual dia da semana a atividade se repetirá</label>
            <select class="form-select" id="dia_semana" name="frequencia" required>
              <option value="">Selecione</option>
              <option value="1">Segunda-feira</option>
              <option value="2">Terça-feira</option>
              <option value="3">Quarta-feira</option>
              <option value="4">Quinta-feira</option>
              <option value="5">Sexta-feira</option>
              <option value="6">Sábado</option>
              <option value="7">Domingo</option>
              <option value="8">Não repetirá </option>

            </select>
          </div>

          <div class="col-md-8">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" class="form-control" id="destino" name="destino" required>
          </div>
        </div>

        <div class="mb-4">
          <label for="equipamentos" class="form-label">Buscar Equipamento para Empréstimo:</label>
          <input type="text" id="busca-equipamento" name="busca-equipamento" class="form-control mb-3" placeholder="Digite para buscar..." autocomplete="off" >

        </div>

        <div id="lista-equipamentos" class="list-group mb-3"></div>
        
        <ul id="equipamentos-selecionados" class="list-group mb-4"></ul>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-success btn-lg">Criar Atividade</button>
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
}

    unset($_SESSION['msg']);
?>

<?php include 'footer.php'; ?>
</body>

<script type="text/javascript">


window.addEventListener('DOMContentLoaded', function() {
    const hoje = new Date().toISOString().split('T')[0];
    document.getElementById('data_inicio').min = hoje;
    document.getElementById('data_fim').min = hoje;
  });


document.getElementById('data_inicio').addEventListener('change', function() {
    const dataInicio = this.value;
    const dataFim = document.getElementById('data_fim');

    // Atualiza o mínimo permitido para o campo de data final
    dataFim.min = dataInicio;

    // Se a data final já escolhida for menor que a inicial, limpa
    if (dataFim.value && dataFim.value < dataInicio) {
        dataFim.value = '';
    }
});

        
$(document).ready(function() {
    $(".remover-equipamento").click(function() {
        let equipamentoId = $(this).data("equipamento");
        let emprestimoId = $(this).data("emprestimo");
        let linha = $("#equipamento-" + equipamentoId);

        if (confirm("Tem certeza que deseja remover este equipamento do empréstimo?")) {
            $.ajax({
                url: "../Controller/emprestimoController.php",
                type: "POST",
                data: {
                    action: "removerEquipamento",
                    id_emprestimo: emprestimoId,
                    codigo_barras: equipamentoId
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.sucesso) {
                        linha.fadeOut(500, function() { $(this).remove(); });
                    } else {
                        alert("Erro ao remover: " + res.mensagem);
                    }
                },
                error: function() {
                    alert("Erro na requisição.");
                }
            });
        }
    });
});

    // Evento de digitação no campo de busca
    $('#busca-equipamento').keyup(function() {
        let busca = $(this).val();
        let data_inicio_emprestimo = $('#data_inicio').val();
        let data_fim_emprestimo = $('#data_fim').val();
        if (busca.length >= 2) { // Faz a busca apenas se tiver pelo menos 2 caracteres
            $.ajax({
                url: '../Model/buscarEquipamentos.php',
                type: 'POST',
                data: { busca: busca,
                        data_inicio: data_inicio_emprestimo,
                        data_fim: data_fim_emprestimo},
                success: function(data) {
                    console.log("Resposta do servidor:", data);
                    $('#lista-equipamentos').html(data).show();
                }
            });
        } else {
            $('#lista-equipamentos').hide();
        }
    });

    // Adicionar equipamento à lista ao clicar
    $(document).on('click', '.equipamento-item', function() {
        let equipamentoNome = $(this).text();
        let equipamentoId = $(this).data('id');

        let novoItem = `<li class="form-control col-md-4"  data-id="${equipamentoId}">${equipamentoNome}
            <button type="button" class="btn btn-danger btn-sm remover-equipamento">Remover</button>
            <input type="hidden" name="equipamentos[]" value="${equipamentoId}">
        <input type="hidden" name="nome_equipamentos[]" value="${equipamentoNome}">
        </li>`;

        $('#equipamentos-selecionados').append(novoItem);
        $('#busca-equipamento').val('');
        $('#lista-equipamentos').hide();
    });

    // Remover equipamento da lista
    $(document).on('click', '.remover-equipamento', function() {
        $(this).parent().remove();
    });

</script>


</html>
