

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

	        $emprestimos .= '<td name="id_emprestimo" value='.$result['id_emprestimo'].'>' . $result['id_emprestimo'] . '</td>
	        				<td name="solicitante">' . $result['solicitante'] . '</td>
	                         <td>' . date("d/m/Y H:i:s", strtotime($result['data_inicio_emprestimo'])) . '</td>
	                          <td>' . date("d/m/Y H:i:s", strtotime($result['data_fim_emprestimo'])) . '</td>';

	                         $emprestimos .= ($result['id_emprestimo'] != $anterior) 
	            				? '<td><a href="../Action/editarEmprestimo.php?id_emprestimo='.$result['id_emprestimo'].'"  style="text-decoration: none;"><button type="button" class="btn btn-success" >Entrar</button> </a>
	            				<a href="../Action/excluirEmprestimo.php?id_emprestimo='.$result['id_emprestimo'].'" style="text-decoration: none;" onclick="return confirmarExclusao()"><button type="button" class="btn btn-danger" >Deletar</button> </a> </td></tr>' 
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

		
	<h2 class="mt-5 container	">Pesquisa de Emprestimo</h2>



	<form method="post" action="../action/pesquisarEmprestimo.php">

		<div class="form-group container">
			<label  >Código do emprestimo</label>
			<input value="*" class="form-control w-25 border-dark" name="cod_emprestimo" style="text-transform: uppercase;" required="required">
		</div>
		
		
		<div class="form-group container">
			<button type="submit" id="pesquisar" class="btn btn-success mt-2" style="" >Pesquisar</button>
		</div>

	



	<main>
	<?php 

		if (isset($result['solicitante']))
		{
			echo "<section>
					<table class='container' id='emprestimos'>
					<thead>
						<tr>
							<th class='col-3' >Número do Emprestimo</th>
							<th>Solicitante</th>
							<th>Início do Emprestimo</th>
							<th>Fim do Emprestimo</th>							
							<th> Ações</th>
						</tr>
					</thead>
					<tbody>
						$emprestimos
					</tbody>
				</table>
			</section>";
	}

	?>
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