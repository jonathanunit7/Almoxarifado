<?php 

    if(isset($_SESSION['perfil'])){
        if($_SESSION['perfil'] != 'Administrador' && $_SESSION['perfil'] != 'Almoxerife'){
            header("refresh:1;url=../view/acessoNegado.php");
            exit;     
        }
    }

include 'header.php'; 

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Empréstimo de Equipamentos</title>
</head>
<body>
<div class="container mt-4 mb-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
      <h3 class="mb-0">Empréstimo de Equipamentos</h3>
    </div>
    <div class="card-body">

      <form method="post" action="../Action/emprestimo.php" id="formulario">

        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label for="data_inicio" class="form-label">Início do Empréstimo</label>
            <input type="datetime-local" id="data_inicio" name="data_inicio_emprestimo" class="form-control" required>
          </div>
          <div class="col-md-3">
            <label for="data_fim" class="form-label">Fim do Empréstimo</label>
            <input type="datetime-local" id="data_fim" name="data_fim_emprestimo" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" id="destino" name="destino" class="form-control" placeholder="Especifique o destino" required>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <label for="solicitante" class="form-label">Nome do Solicitante</label>
            <input type="text" id="solicitante" name="nome_solicitante" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label for="cpf_solicitante" class="form-label">CPF do Solicitante</label>
            <input type="text" id="cpf_solicitante" name="cpf_solicitante" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label for="cpf_solicitante" class="form-label">Nome da atividade</label>
            <input type="text" id="nome_atividade" name="nome_atividade" class="form-control" required>
          </div>
        </div>

        <hr>

        <div class="mb-3">
          <label for="codigoDeBarras" class="form-label">Leitura de Código de Barras</label>
          <div class="input-group">
            <input type="text" id="codigoDeBarras" name="codigoDeBarras" class="form-control" placeholder="Escaneie o código de barras" autofocus>
            <button type="button" id="adicionarEquipamento" class="btn btn-outline-primary">Adicionar</button>
          </div>
        </div>

        <h4 class="mt-4">Itens para Empréstimo</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th scope="col">Código de Barras</th>
                <th scope="col">Nome</th>
                <th scope="col">Tipo</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody id="listaItens"></tbody>
          </table>
        </div>

        <div class="d-grid gap-2 mt-4">
          <button type="submit" class="btn btn-success btn-lg">Confirmar Empréstimo</button>
        </div>
      </form>

    </div>
  </div>
</div>

<?php 
  if (isset($_GET['msg'])) {
    $mensagem = htmlspecialchars($_GET['msg']);
    echo "<div class='alert alert-success alert-dismissible fade show container' role='alert'>
            <strong>Resultado:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    unset($_SESSION['msg']);
  }
?>
    <script>





function validarData(data_inicio_emprestimo, data_fim_emprestimo){
    if(data_inicio_emprestimo.length == 0){
        alert ("Preencha a data inicial e final para adicionar equipamento");
        return false;
    }

    if(data_fim_emprestimo.length == 0){
        alert ("Preencha a data inicial e final para adicionar equipamento")
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
                        data: {codigoDeBarras: codigo,
                               data_inicio_emprestimo: data_inicio_emprestimo,
                               data_fim_emprestimo: data_fim_emprestimo},
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

        

   


</script>
<?php include 'footer.php'; ?>
</body>
</html>

				

