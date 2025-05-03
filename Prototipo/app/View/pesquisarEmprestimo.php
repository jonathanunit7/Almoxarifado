

<?php 

include 'header.php'; 

$emprestimos = '';

	if (isset($resultado)){
		$anterior = "";
		$alterna_cor = 0;
		foreach ($resultado as $result) {
			
			if($result['id_emprestimo'] != $anterior) 
				$emprestimos .= '<tr class="escura">';
			else{
				$emprestimos .= '<tr class="">';
			}

	        $emprestimos .= '<td class="col-1 text-center" name="id_emprestimo" value='.$result['id_emprestimo'].'>' . $result['id_emprestimo'] . '</td>
	                          <td class="col-2 text-center">' . $result['atividade'] . '</td>
	                          <td class="col-2 text-center">' . $result['destino'] . '</td>
	        				<td class="col-1 text-center" name="solicitante">' . $result['solicitante'] . '</td>
	                         <td class="col-2 text-center">' . date("d/m/Y H:i:s", strtotime($result['data_inicio_emprestimo'])) . '</td>
	                          <td class="col-2 text-center">' . date("d/m/Y H:i:s", strtotime($result['data_fim_emprestimo'])) . '</td>';

	                         $emprestimos .= ($result['id_emprestimo'] != $anterior) 
	            				? '<td class="col-2 text-center"><a href="../Action/editarEmprestimo.php?id_emprestimo='.$result['id_emprestimo'].'"  style="text-decoration: none;"><button type="button" class="btn btn-success btn-sm" >Entrar</button> </a>
	            				<a href="../Action/excluirEmprestimo.php?id_emprestimo='.$result['id_emprestimo'].'" style="text-decoration: none;" onclick="return confirmarExclusao()"><button type="button" class="btn btn-danger btn-sm" >Devolver</button> </a> </td></tr>' 
	            				: '<td></td></tr>';	



			$anterior = $result['id_emprestimo'];
			$alterna_cor++;					
		}
	}	

?>

 
<main>

</script>

<div class="container mt-5">

	<input class="form-control"  type="hidden" id='cod_fita' value=''>

		
	<h2 class="mt-5 text-center mb-1">Pesquisa de Emprestimo</h2>



	<form method="post" action="../action/pesquisarEmprestimo.php">

		<div class="input-group mb-3 col-5 mt-6">
	        <input type="text" name="cod_emprestimo" id="searchBox" class="form-control "  placeholder="Pesquisar por Número, Solicitante, Data, Destino ou Atividade">
	        <button type="submit" class="btn btn-primary ms-2" id="searchButton">Pesquisar</button>
    	</div>

	<section class='mt-3'>
			<table class='table table-bordered table-striped mt-3' id='emprestimos'>

			<thead>
				<tr>
					<th class='col-1 text-center' >Número</th>
					<th class='col-2 text-center'>Atividade</th>
					<th class='col-2 text-center'>Destino</th>
					<th class='col-2 text-center'>Solicitante</th>
					<th class='col-2 text-center'>Início do Emprestimo</th>
					<th class='col-2 text-center'>Fim do Emprestimo</th>																			
					<th class="col-2 text-center"> Ações</th>
				</tr>
			</thead>	


	<main>
	<?php 

		if (isset($result['solicitante']))
		{
			echo "
					<tbody>
						$emprestimos
					</tbody>
				";
	}

	?>

	</table>
			</section>
</form>
	
</main>

</div>

<script type="text/javascript">
	
	$('#emprestimos').dataTable( {
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

<style type="text/css">


.mt-6 {
  margin-top: 4rem;
}

 .table-striped tbody tr:nth-of-type(odd) {
    background-color: red; /* Azul bem claro */
  }

  .table-striped tbody tr:nth-of-type(even) {
    background-color: #ffffff; /* Branco (opcional) */
  }

</style>


<?php 


if (isset($_SESSION['msg'])) {
    
  $mensagem = $_SESSION['msg'];
    echo "<div class='alert alert-success alert-dismissible fade show mt-5 container' role='alert'>
            <strong>Mensagem:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

    unset($_SESSION['msg']);



include 'footer.php'; ?>