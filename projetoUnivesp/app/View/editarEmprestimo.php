<?php

include 'header.php';

$emprestimos = "";
foreach ($resultado as $result) {
    $emprestimos .= '<tr id="equipamento-' . $result['codigo_de_barras'] . '">
                                <td name="nome_equipamento">' . $result['nome_equipamento'] . '</td>
                                <td name="codigo_de_barras">' . $result['codigo_de_barras'] . '</td>
                                <td name="excluir">
                                    <button type="button" class="btn btn-danger btn-sm remover-equipamento"
                                        data-emprestimo="' . $result['id_emprestimo'] . '"
                                        data-equipamento="' . $result['codigo_de_barras'] . '">
                                        Remover
                                    </button>
                                </td>
                            </tr>';
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empréstimo número: </title>
</head>

<body class="container mt-4">
    <h2 class="container mt-4">Editar Equipamentos do Empréstimo</h2>

    <form action="../Action/salvarEdicao.php" method="POST" class="container">
        <div class="container">
            <div class="row ">
                <div class="mb-3 col-md-6">
                    <h3>Número:</h3>
                    <input type="text" class="form-control " id="emprestimo" name="emprestimo" value="<?= $resultado[0]['id_emprestimo'] ?>" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <h3>Solicitante:</h3>
                    <input type="text" id="solicitante" name="solicitante" class="form-control" value="<?= $resultado[0]['solicitante'] ?>" readonly>
                    <input type="hidden" name="cpf_solicitante" value="<?= $resultado[0]['cpf_solicitante']  ?>">
                </div>
                <div class="mb-3 col-md-6">
                    <h3>Data inicial:</h3>
                    <input type="text" id="data_inicio_emprestimo" name="data_inicio_emprestimo" class="form-control " value="<?= $resultado[0]['data_inicio_emprestimo'] ?>" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <h3>Data final:</h3>
                    <input type="text" id="data_fim_emprestimo" name="data_fim_emprestimo" class="form-control " value="<?= $resultado[0]['data_fim_emprestimo'] ?>" readonly>
                </div>
            </div>
        </div>
        <table class="table table-bordered container mt-3">
            <thead>
                <tr>
                    <th>Equipamento</th>
                    <th>Código de Barra</th>
                    <th>Ação</th>

                </tr>
            </thead>
            <tbody>
                <?php
                echo $emprestimos;
                ?>

            </tbody>
        </table>


        <input type="hidden" name="id_emprestimo" value="<?= $resultado[0]['id_emprestimo'] ?>">

        <h4>Buscar equipamento para este emprestimo:</h4>
        <input type="text" id="busca-equipamento" name="busca-equipamento" class="form-control border-dark rounded-end-3 shadow-sm" autocomplete="off">
        <div id="lista-equipamentos"></div>
        <br>

        <ul id="equipamentos-selecionados" class="col-md-6 "></ul>

        <button type="submit" class="btn btn-primary ">Salvar Alterações</button>
    </form>


    <div class="container mt-4">
        <a href="listarEmprestimo.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</body>


</html>

<script type="text/javascript">
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
                            linha.fadeOut(500, function() {
                                $(this).remove();
                            });
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
        let data_inicio_emprestimo = $('#data_inicio_emprestimo').val();
        let data_fim_emprestimo = $('#data_fim_emprestimo').val();
        if (busca.length >= 2) { // Faz a busca apenas se tiver pelo menos 2 caracteres
            $.ajax({
                url: '../Model/buscarEquipamentos.php',
                type: 'POST',
                data: {
                    busca: busca,
                    data_inicio: data_inicio_emprestimo,
                    data_fim: data_fim_emprestimo
                },
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

<?php
include 'footer.php';

?>