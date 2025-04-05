<?php

include 'header.php';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

</head>

<body class="body-emprestimo">
    <div class="container mt-5">
        <h2>Empréstimo de Equipamentos</h2>
        <form method="post" action="../Action/emprestimo.php" id="formulario">
            <hr>
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="dataHora" class="form-label">Escolha Data e Hora para o inicio do emprestimo</label>
                            <input type="text" id="data_inicio" name="data_inicio_emprestimo" class="form-control border-dark rounded-end-3 shadow-sm" placeholder="Selecione a data e hora" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="dataHora" class="form-label">Escolha Data e Hora para o fim do emprestimo</label>
                            <input type="text" id="data_fim" name="data_fim_emprestimo" class="form-control border-dark rounded-end-3 shadow-sm" placeholder="Selecione a data e hora" required>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-6">
                        Nome do Solicitante:
                        <input type="text" id="solicitante" name="solicitante" class="form-control border-dark rounded-end-3 shadow-sm" required>
                    </div>
                    <div class="col-md-6">
                        CPF do Solicitante:
                        <input type="text" id="cpf_solicitante" name="cpf_solicitante" class="form-control border-dark rounded-end-3 shadow-sm" required>
                    </div>
                </div>
            </div>
            <hr>

            <label for="dataHora" class="form-label">Leitura de Código de Barras</label>
            <input type="text" id="codigoDeBarras" name="codigoDeBarras" class="form-control border-dark rounded-end-3 shadow-sm" placeholder="Escaneie o Código de Barras" autofocus>
            <button type="button" id="adicionarEquipamento" class="btn btn-primary mt-3">Adicionar</button>

            <h3>Itens para Empréstimo</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th width="300px">Código de Barras</th>
                        <th width="400px">Nome</th>
                        <th width="200px">Tipo</th>
                        <th width="200px">Ação</th>
                    </tr>
                </thead>
                <tbody id="listaItens"></tbody>
            </table>
            <button type="submit" class="btn btn-success">Confirmar Empréstimo</button>
        </form>
        <script>
            function validarCpf(cpf) {
                // Remove caracteres especiais (pontos, traços)
                cpf = cpf.replace(/[^\d]+/g, '');

                // Verifica se o CPF tem 11 dígitos
                if (cpf.length !== 11) {
                    return false;
                }

                // Não permite CPFs com todos os números iguais (ex: 111.111.111-11)
                if (/^(\d)\1{10}$/.test(cpf)) {
                    return false;
                }

                // Validação dos dois últimos dígitos verificadores
                let soma = 0;
                let resto;

                // Valida o primeiro dígito verificador
                for (let i = 0; i < 9; i++) {
                    soma += parseInt(cpf.charAt(i)) * (10 - i);
                }
                resto = (soma * 10) % 11;
                if (resto === 10 || resto === 11) {
                    resto = 0;
                }
                if (resto !== parseInt(cpf.charAt(9))) {
                    return false;
                }

                soma = 0;
                // Valida o segundo dígito verificador
                for (let i = 0; i < 10; i++) {
                    soma += parseInt(cpf.charAt(i)) * (11 - i);
                }
                resto = (soma * 10) % 11;
                if (resto === 10 || resto === 11) {
                    resto = 0;
                }
                if (resto !== parseInt(cpf.charAt(10))) {
                    return false;
                }

                return true;
            }


            function validarData(data_inicio_emprestimo, data_fim_emprestimo) {
                if (data_inicio_emprestimo.length == 0) {
                    alert("Preencha a data inicial e final para adicionar equipamento");
                    return false;
                }

                if (data_fim_emprestimo.length == 0) {
                    alert("Preencha a data inicial e final para adicionar equipamento")
                    return false;
                }


                return true;
            }

            $(document).ready(function() {
                $('#adicionarEquipamento').click(function() {
                    let codigo = $('#codigoDeBarras').val();
                    let data_inicio_emprestimo = $('#data_inicio').val();
                    let data_fim_emprestimo = $('#data_fim').val();
                    let cpf_solicitante = $('#cpf_solicitante').val();
                    let validacao_data = validarData(data_inicio_emprestimo, data_fim_emprestimo);



                    if (codigo !== '' && validacao_data == true) {

                        $.ajax({
                            url: '../Model/pesquisa.php',
                            type: 'POST',
                            data: {
                                codigoDeBarras: codigo,
                                data_inicio_emprestimo: data_inicio_emprestimo,
                                data_fim_emprestimo: data_fim_emprestimo
                            },
                            success: function(response) {
                                let equipamento;
                                try {
                                    equipamento = JSON.parse(response);
                                } catch (e) {
                                    alert("Erro ao processar os dados.");
                                    return;
                                }

                                if (equipamento.erro) {
                                    alert(equipamento.erro);
                                } else {
                                    $('#listaItens').append(`
                                <tr>
                                    <td>${equipamento.codigoDeBarra}
                                        <input type="hidden" name="codigoDeBarras[]" value="${equipamento.codigoDeBarra}">
                                    </td>
                                    <td>${equipamento.nome}
                                        <input type="hidden" name="nome_equipamento[]" value="${equipamento.nome}">
                                    </td>
                                    <td>${equipamento.tipo}
                                        <input type="hidden" name="tipos[]" value="${equipamento.tipo}">
                                    </td>
                                    <td><button type="button" class="btn btn-danger removerItem">Remover</button></td>
                                </tr>
                            `);
                                }
                                $('#codigoDeBarras').val('').focus();
                            }
                        });
                    }
                });

                $(document).on('click', '.removerItem', function() {
                    $(this).closest('tr').remove();
                });



            });


            flatpickr("#data_fim", {
                enableTime: true,
                dateFormat: "d-m-Y H:i:ss",
                time_24hr: true
            });

            flatpickr("#data_inicio", {
                enableTime: true,
                dateFormat: "d-m-Y H:i:ss",
                time_24hr: true
            });
        </script>
</body>

</html>




<?php

if (isset($_GET['msg'])) {
    $mensagem = htmlspecialchars($_GET['msg']);
    echo "<div class='alert alert-success alert-dismissible fade show mt-5' role='alert'>
            <strong>Resultado:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

unset($_SESSION['msg']);


include 'footer.php'; ?>