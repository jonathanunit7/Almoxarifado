<?php 
include 'header.php'; 

if($id){
    $id = $id;
}else{
    $id = $resultado[0]['id_equipamento'];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Manutenções</title>
      
</head>
<body>

<div class="container mt-5">

    <a class="text-decoration-none mp-5" href="../view/novoHistorico.php?id=<?=$id?>"><button type="button" class="btn btn-primary float-end">Novo Histórico</button> </a>   

    <h2 class="mb-4">Histórico de Manutenções -  <?= (isset($resultado[0]['nome']) && !is_null($resultado[0]['nome'])) ? $resultado[0]['nome'] : ""  ?></h2>

    <table id="tabelaHistorico" class=" table table-bordered table-striped mt-3">
        <thead class="">
            <tr class="table table-secondary">
                
                <th>Data</th> 
                <th>Descrição</th>
                <th>Custo (R$)</th>
                <th>Responsável</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            foreach($resultado as $result) { ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($result['data_manutencao'])) ?></td>
                    <td><?= $result['descricao'] ?></td>
                    <td><?= number_format($result['custo'], 2, ',', '.') ?></td>
                    <td><?= $result['responsavel'] ?></td>
                    <td><a class="text-decoration-none" href="../Action/editarHistoricoEquipamento.php?id_historico='<?= $result['id']?>'"><button type="button" class="btn btn-success btn-sm">Editar</button> </a>
                        <a class="text-decoration-none" href="../Action/excluirHistoricoEquipamento.php?id_historico='<?= $result['id']?>'"><button type="button" class="btn btn-danger btn-sm">Excluir</button> </a> 
                    </td>    
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>

$('#tabelaHistorico').dataTable( {
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

</body>
</html>

<?php include 'footer.php'; ?>
