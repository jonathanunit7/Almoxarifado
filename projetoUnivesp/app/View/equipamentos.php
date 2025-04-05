<?php 
include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Equipamentos</title>
    <style>
        
        table { margin-top: 15px; }
        .pagination { margin-top: 20px; justify-content: center; }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="">Lista de Equipamentos   </h2>

     <a class="text-decoration-none mp-5" href="../view/novoEquipamento.php"><button type="button" class="btn btn-success">Novo Equipamento</button> </a>
    <form action="../Action/listarEquipamentos.php" method="POST">
    <!-- Campo  mt-2 Pesquisa -->
    <div class="input-group mb-3 col-5 mt-5">
        <input type="text" name="pesquisa" id="searchBox" class="form-control border-dark" placeholder="Pesquisar por Nome, Código de Barras ou Tipo...">
        <button type="submit" class="btn btn-primary ms-2" id="searchButton">Pesquisar</button>
    </div>
    </form>
    <!-- Tabela de Equipamentos -->
    <table class="table table-bordered table-striped mt-3" id="tabelaEquipamento">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Código de Barras</th>
                <th>Tipo</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody id="equipamentosTable">
            <?php 
            if (isset($resultado) && !is_null($resultado)) {            
            foreach ($resultado as $result) { ?>
                <tr>
                    <td><?= $result['nome'] ?></td>
                    <td><?= $result['codigoDeBarra'] ?></td>
                    <td><?= $result['tipo'] ?></td>
                    <td class="col-3">
                        <a class="text-decoration-none" href="../Action/editarEquipamento.php?id='<?= $result['id']?>'"><button type="button" class="btn btn-success">Editar</button> </a>
                        <a class="text-decoration-none" href="../Action/historicoEquipamento.php?id='<?= $result['id']?>'"><button type="button" class="btn btn-secondary">Histórico</button> </a> 
                        <a class="text-decoration-none" href="../Action/excluirEquipamento.php?id='<?= $result['id']?>'"><button type="button" class="btn btn-danger">Deletar</button> </a>  
                    </td>
                </tr>
            <?php } }?>
        </tbody>
    </table>

    
</div>



<script>
$('#tabelaEquipamento').dataTable( {
        "searching": true,
        "ordering": false,
        "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "Não encontrou resultado",
        "sEmptyTable":    "Nenhum resultado",
        "sInfo":          "Exibindo registros do _START_ a _END_ de um total de _TOTAL_ registros",
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

</body>
</html>

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
