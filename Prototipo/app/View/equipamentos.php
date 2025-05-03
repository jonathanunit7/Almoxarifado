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
    <h2 class=" text-center">Lista de Equipamentos   </h2>
    <?php if ($_SESSION['perfil'] == 'Administrador' || $_SESSION['perfil'] == 'Almoxerife'){ ?>
    <a class="text-decoration-none mp-3 mt-4" href="../view/novoEquipamento.php"><button type="button" class="btn btn-success mb-3">+ Novo Equipamento</button> </a>
    <?php } ?>
    <form action="../Action/listarEquipamentos.php" method="POST">
    <!-- Campo  mt-2 Pesquisa -->
    <div class="input-group mb-3 col-5 ">
        <input type="text" name="pesquisa" id="searchBox" class="form-control " placeholder="Pesquisar por Nome, Código de Barras ou Tipo...">
        <button type="submit" class="btn btn-primary ms-2" id="searchButton">Pesquisar</button>
    </div>
    </form>
    <!-- Tabela de Equipamentos -->
    <table class="table table-bordered table-striped mt-3" id="tabelaEquipamento">
        <thead>
            <tr>
                <th class="text-center">Nome</th>
                <th class="text-center">Código de Barras</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Status</th>
                <?php if ($_SESSION['perfil'] == 'Administrador' || $_SESSION['perfil'] == 'Almoxerife'){ ?>
                <th class="text-center">Ação</th>
            <?php } ?>
            </tr>
        </thead>
        <tbody id="equipamentosTable">
            <?php 
            if (isset($resultado) && !is_null($resultado)) {            
            foreach ($resultado as $result) { ?>
                <tr>
                    <td class="col-2 text-center"><?= $result['nome'] ?></td>
                    <td class="col-2 text-center"><?= $result['codigoDeBarra'] ?></td>
                    <td class="col-2 text-center"><?= $result['tipo'] ?></td>
                    <td class="col-2 text-center"><?= $result['status'] ?></td>
                    <?php if ($_SESSION['perfil'] == 'Administrador' || $_SESSION['perfil'] == 'Almoxerife'){ ?>
                    <td class="col-3 text-center">
                        <a class="text-decoration-none" href="../Action/editarEquipamento.php?id='<?= $result['id']?>'"><button type="button" class="btn btn-success btn-sm">Editar</button> </a>
                        <a class="text-decoration-none" href="../Action/historicoEquipamento.php?id='<?= $result['id']?>'"><button type="button" class="btn btn-secondary btn-sm">Histórico</button> </a> 
                        <a class="text-decoration-none" href="../Action/excluirEquipamento.php?id='<?= $result['id']?>'"><button type="button" class="btn btn-danger btn-sm">Deletar</button> </a>  
                    </td>
                <?php } ?>
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
