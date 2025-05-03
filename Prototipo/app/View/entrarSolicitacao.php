<?php include 'header.php'; ?>


<div class="container mt-4">
    <h2 class="text-center mb-4">Detalhes da Solicitação #<?= $_GET['id']?></h2>

 <form action="../Action/emprestimo.php" method="POST" class="container">

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informações da Solicitação</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Solicitante:</strong> <?= $resultado[0][0]['nome'] ?>
                </div>
                <div class="col-md-6">
                    <strong>Atividade:</strong> <?= $resultado[0][0]['nome_atividade'] ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Destino:</strong> <?= $resultado[0][0]['destino'] ?>
                </div>
                <div class="col-md-6">
                    <strong>Status:</strong> <?= ($resultado[0][0]['status'] == 'Aprovada') ? '<span style="background-color: green;">APROVADO</span>': '<span style="background-color: yellow;">PENDENTE</span>'  ;  ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <strong>Data Início:</strong> <?= date('d/m/Y H:i', strtotime($resultado[0][0]['data_inicio_emprestimo'])) ?>
                </div>
                <div class="col-md-6">
                    <strong>Data Fim:</strong> <?= date('d/m/Y H:i', strtotime($resultado[0][0]['data_fim_emprestimo'])) ?>
                </div>
            </div>
        </div>
    </div>
        <input type="hidden" id="data_inicio_emprestimo" name="data_inicio_emprestimo" value="<?= $resultado[0][0]['data_inicio_emprestimo']  ?>">
        <input type="hidden" id="data_fim_emprestimo" name="data_fim_emprestimo" value="<?= $resultado[0][0]['data_fim_emprestimo']  ?>">
        <input type="hidden" id="destino" name="destino" value="<?= $resultado[0][0]['destino']  ?>">
        <input type="hidden" id="nome_atividade" name="nome_atividade" value="<?= $resultado[0][0]['nome_atividade']  ?>">
        <input type="hidden" id="nome_solicitante" name="nome_solicitante" value="<?= $resultado[0][0]['nome']  ?>">
        <input type="hidden" id="cpf_solicitante" name="cpf_solicitante" value="<?=  $_SESSION['cpf']  ?>">
        <input type="hidden" id="solicitacao" name="solicitacao" value="<?= $_GET['id']  ?>">

       <div class="row">
    <!-- Bloco esquerdo: Tabela de equipamentos vinculados -->
    <div class="col-md-6">
        <h5>Equipamentos Solicitados</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
               <?php foreach ($resultado[1] as $equip): ?>
                    <tr>
                        <td><?= htmlspecialchars($equip['nome']) ?></td>
                        <td>
                            <button type="button" class="btn btn-outline-secondary btn-sm copiar-linha">
                                Copiar Linha
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Campo oculto -->
        <input type="hidden" name="id_emprestimo" value="<?= isset($resultado[0]['id_emprestimo']) ? $resultado[0]['id_emprestimo'] : '' ?>">
    </div>
    <?php 
    if ($_SESSION['perfil'] == 'Administrador' || $_SESSION['perfil'] == 'Almoxerife'){
    ?>    
        <!-- Bloco direito: Adicionar novos equipamentos -->
        <div class="col-md-6">
            <h5>Adicionar Equipamentos</h5>

            <input type="text" id="busca-equipamento" class="form-control" placeholder="Digite o nome do equipamento">
            <div id="lista-equipamentos" class="list-group mt-2"></div>
            <ul id="equipamentos-selecionados" class="list-group mt-3"></ul>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary" <?= ($resultado[0][0]['status']=="Aprovada") ?  'disabled' : '' ?> >Criar emprestimo</button>
            </div>
        </div>
    <?php } ?>
</div>

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


<script type="text/javascript">

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('copiar-linha')) {
            const linha = e.target.closest('tr');
            const texto = Array.from(linha.querySelectorAll('td'))
                .slice(0, -1) // ignora a última célula (onde está o botão)
                .map(td => td.textContent.trim())
                .join(' | '); // separador opcional

            navigator.clipboard.writeText(texto).then(() => {
                e.target.innerText = 'Copiado!';
                setTimeout(() => {
                    e.target.innerText = 'Copiar Linha';
                }, 1500);
            }).catch(err => {
                console.error('Erro ao copiar: ', err);
            });
        }
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

        let novoItem = `
        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${equipamentoId}">
            <span>${equipamentoNome}</span>
            <div>
                <button type="button" class="btn btn-danger btn-sm remover-equipamento">Remover</button>
            </div>
            <input type="hidden" name="codigoDeBarras[]" value="${equipamentoId}">
            <input type="hidden" name="nome_equipamento[]" value="${equipamentoNome}">
        </li>`;


        $('#equipamentos-selecionados').append(novoItem);
        $('#busca-equipamento').val('');
        $('#lista-equipamentos').hide();
    });

    // Remover equipamento da lista
   $(document).ready(function () {
    $(document).on('click', '.remover-equipamento', function () {
        $(this).closest('li').remove(); // Usa closest() pra garantir que vai remover o <li>
    });
});


</script>





 
 