<?php include 'header.php'; ?>

<?php 
    $emprestimos = "";
    foreach ($resultado as $result) {
        $emprestimos .= '<tr id="equipamento-' . $result['codigo_de_barras'] . '">
                            <td>' . $result['nome_equipamento'] . '</td>
                            <td>' . $result['codigo_de_barras'] . '</td>';
                            if ($_SESSION['perfil'] == 'Administrador' || $_SESSION['perfil'] == 'Almoxerife' ){
                            $emprestimos .= '<td>
                                                <button type="button" class="btn btn-danger btn-sm remover-equipamento"
                                                    data-emprestimo="' . $result['id_emprestimo'] . '"
                                                    data-equipamento="' . $result['codigo_de_barras'] . '">
                                                    Remover
                                                </button>
                                            </td>';
                            }                
        $emprestimos .='</tr>';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empréstimo Nº <?= $resultado[0]['id_emprestimo'] ?></title>
</head>
<body>

<div class="container mt-5 mb-5">
  <div class="card shadow-sm border-0 rounded-0">
    <div class="card-header bg-primary text-white text-center">
      <h3 class="mb-0">Editar Equipamentos do Empréstimo</h3>
    </div>
    <div class="card-body">

      <form action="../Action/editarEmprestimo.php" method="POST">

        <div class="row g-4 mb-4">
          <div class="col-md-2">
            <label class="form-label fw-bold">Número do Empréstimo</label>
            <input type="text" class="form-control rounded-0" name="id_emprestimo" value="<?= $resultado[0]['id_emprestimo'] ?>" readonly>
          </div>

          <div class="col-md-5">
            <label class="form-label fw-bold">Solicitante</label>
            <input type="text" class="form-control rounded-0" name="solicitante" value="<?= $resultado[0]['solicitante'] ?>" readonly>
            <input type="hidden" name="cpf_solicitante" value="<?= $resultado[0]['cpf_solicitante'] ?>">
          </div>

          <div class="col-md-5">
            <label class="form-label fw-bold">Nome da Atividade</label>
            <input type="text" class="form-control rounded-0" name="nome_atividade" value="<?= $resultado[0]['atividade'] ?>" readonly>
          </div>

          <div class="col-md-3">
            <label class="form-label fw-bold">Data Inicial</label>
            <input type="text"   class="form-control rounded-0" name="data_inicio_emprestimo" value="<?= $resultado[0]['data_inicio_emprestimo'] ?>" readonly>
          </div>

          <div class="col-md-3">
            <label class="form-label fw-bold">Data Final</label>
            <input type="text" class="form-control rounded-0" name="data_fim_emprestimo" value="<?= $resultado[0]['data_fim_emprestimo'] ?>" readonly>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-bold">Destino</label>
            <input type="text" class="form-control rounded-0" name="destino" value="<?= $resultado[0]['destino'] ?>"  readonly>
          </div>

          
        </div>

        <div class="table-responsive mb-4">
          <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-primary">
              <tr>
                <th>Equipamento</th>
                <th>Código de Barras</th>
                <?php if ($_SESSION['perfil'] == 'Administrador' || $_SESSION['perfil'] == 'Almoxerife'){ ?> 
                    <th>Ação</th>
                <?php } ?>    
              </tr>
            </thead>
            <tbody>
              <?= $emprestimos; ?>
            </tbody>
          </table>
        </div>
        <?php 
            if ($_SESSION['perfil'] == 'Administrador' || $_SESSION['perfil'] == 'Almoxerife'){
        ?> 
            <div class="mb-4">
              <label class="form-label fw-bold">Buscar Equipamento para este Empréstimo</label>
              <input type="text" id="busca-equipamento" name="busca-equipamento" class="form-control rounded-0 shadow-sm" autocomplete="off" placeholder="Digite o nome do equipamento...">
              <div id="lista-equipamentos" class="list-group mt-2"></div>
            </div>

            <div class="mb-4">
              <ul id="equipamentos-selecionados" class="list-group"></ul>
            </div>

            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-success">Salvar Alterações</button>
              <a href="listarEmprestimo.php" class="btn btn-secondary">Voltar</a>
            </div>
        <?php }else{ ?>
            <a href="listarEmprestimo.php" class="btn btn-secondary">Voltar</a>
        <?php } ?> 
      </form>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script type="text/javascript">

$(document).ready(function() {
    // Remover equipamento existente
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

    // Buscar novo equipamento
    $('#busca-equipamento').keyup(function() {
        let busca = $(this).val();
        let data_inicio = $('input[name="data_inicio_emprestimo"]').val();
        let data_fim = $('input[name="data_fim_emprestimo"]').val();

        if (busca.length >= 2) {
            $.ajax({
                url: '../Model/buscarEquipamentos.php',
                type: 'POST',
                data: { busca: busca, data_inicio: data_inicio, data_fim: data_fim },
                success: function(data) {
                    $('#lista-equipamentos').html(data).show();
                }
            });
        } else {
            $('#lista-equipamentos').hide();
        }
    });

    // Adicionar equipamento novo à lista
    $(document).on('click', '.equipamento-item', function() {
        let equipamentoNome = $(this).text();
        let equipamentoId = $(this).data('id');

        let novoItem = `
        <li class="list-group-item d-flex justify-content-between align-items-center rounded-0">
            ${equipamentoNome}
            <button type="button" class="btn btn-outline-danger btn-sm remover-equipamento">Remover</button>
            <input type="hidden" name="equipamentos[]" value="${equipamentoId}">
            <input type="hidden" name="nome_equipamentos[]" value="${equipamentoNome}">
        </li>`;

        $('#equipamentos-selecionados').append(novoItem);
        $('#busca-equipamento').val('');
        $('#lista-equipamentos').hide();
    });

    // Remover equipamento novo
    $(document).on('click', '.remover-equipamento', function() {
        $(this).parent().remove();
    });

});
</script>

</body>
</html>
