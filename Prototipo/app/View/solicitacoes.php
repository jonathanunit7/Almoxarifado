<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Gerenciar Solicitações</h2>

    <div class="mb-3 ">
        <a href="../View/solicitarEmprestimo.php" class="btn btn-success">
            + Criar Solicitação
        </a>
    </div>

    <?php if ($resultado>0): ?>
        <table id="tabelaSolicitacoes" class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Solicitante</th>
                    <th class="text-center">Atividade</th>
                    <th class="text-center">Destino</th>
                    <th class="text-center">Data Início</th>
                    <th class="text-center">Data Fim</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($resultado as $result) { ?>
                    <tr>
                        <td class="text-center"><?= $result['id'] ?></td>
                        <td class="text-center"><?= $result['nome'] ?></td>
                        <td class="text-center"><?= $result['nome_atividade'] ?></td>
                        <td class="text-center"><?= $result['destino'] ?></td>
                        <td class="text-center"><?= date('d/m/Y H:i', strtotime($result['data_inicio_emprestimo'])) ?></td>
                        <td class="text-center"><?= date('d/m/Y H:i', strtotime($result['data_fim_emprestimo'])) ?></td>
                        <td class="text-center"><?= $result['status'] ?></td>
                        <td class="text-center" >

                            <a href="../Action/entrarSolicitacao.php?id=<?= $result['id'] ?>" class="btn btn-success btn-sm ">
                                Entrar
                            </a>                            

                            <a href="excluirSolicitacao.php?id=<?= $result['id'] ?>" class="btn btn-danger btn-sm">
                               Excluir
                            </a>  
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    
        <!--<p class="alert alert-info text-center">Nenhuma solicitação pendente encontrada.</p> -->
    <?php endif; ?>
</div>
<script type="text/javascript">
$('#tabelaSolicitacoes').dataTable( {
        "searching": true,
        "ordering": false,
        "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "Não encontrou resultado",
        "sEmptyTable":    "Nenhum resultado",
        "sInfo":          "Exibindo registros do _START_ à _END_ de um total de _TOTAL_ registros",
        "sInfoEmpty":     "Exibindo registros do 0 a 0 de um total de 0 registros",
        "sInfoFiltered":  "(filtrado de um total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Carregando...",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sLast":    "Último",
            "sNext":    "Seguinte",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
    } );

</script>

<?php

if (isset($_GET['msg']) || isset($_SESSION['msg'])) {
    $mensagem = $_SESSION['msg'];
    echo "<div class='alert alert-success alert-dismissible fade show mt-5 container' role='alert'>
            <strong>Resultado:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

    unset($_SESSION['msg']);





 include 'footer.php'; ?>
