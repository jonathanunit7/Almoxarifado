<?php 
//var_dump($_SESSION['perfil']);exit;
    if(isset($_SESSION['perfil'])){
        if($_SESSION['perfil'] != 'Administrador' && $_SESSION['perfil'] != 'Almoxerife'){

            header("refresh:1;url=../view/acessoNegado.php");
            exit;     
        }
    }
include 'header.php'; 
        
?>

<main class="container mt-5">
    <h2 class="mb-4 text-center">Lista de Atividades</h2>

    <a href="../View/novaAtividade.php" class="btn btn-success mb-3">+ Criar Atividade</a>

    <table id="tabelaAtividades" class="table table-bordered table-striped text-center">
        <thead class="">
            <tr>
                <th>Nome da Atividade</th>
                <th>Destino</th>
                <th>Data Inicial</th>
                <th>Data Final</th>
                <th class="col-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($resultado)): ?>
                <?php foreach ($resultado as $resultado): ?>
                    <tr>                        
                        <td><?= htmlspecialchars($resultado['nome_atividade']); ?></td>
                        <td><?= htmlspecialchars($resultado['destino']); ?></td>
                        <td><?= date('d/m/Y', strtotime($resultado['data_inicio_emprestimo'])); ?></td>
                        <td><?= date('d/m/Y', strtotime($resultado['data_fim_emprestimo'])); ?></td>

                        <td class="col-2">
                            <a href="editarAtividade.php?id_atividade=<?= $resultado['id']; ?>" class="btn btn-success btn-sm">Entrar</a>
                            <a href="excluirAtividade.php?id_atividade=<?= $resultado['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta atividade?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhuma atividade encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php 


if (isset($_GET['msg']) || isset($_SESSION['msg'])) {
    $mensagem = $_SESSION['msg'];
    echo "<div class='alert alert-success alert-dismissible fade show mt-5 container' role='alert'>
            <strong>Resultado:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

    unset($_SESSION['msg']);


include 'footer.php'; 


?>

<script type="text/javascript">
$('#tabelaAtividades').dataTable( {
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