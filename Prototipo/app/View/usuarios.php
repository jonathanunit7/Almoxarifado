<?php
include 'header.php';   
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Usuários</h2>
        <a href="../view/novoUsuario.php" class="btn btn-success mb-3">Criar Novo</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Função  </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                 <?php 
            if (isset($resultado) && !is_null($resultado)) {            
            foreach ($resultado as $result) { ?>
                <tr>
                    <td><?= $result['nome'] ?></td>
                    <td><?= $result['email'] ?></td>
                    <td><?= $result['perfil'] ?></td>
                    <td class="col-3">
                        <a class="text-decoration-none" href="../Action/editarUsuario.php?id_usuario='<?= $result['id']?>'"><button type="button" class="btn btn-success">Editar</button> </a>
                        <a class="text-decoration-none" href="../Action/excluirUsuario.php?id_usuario='<?= $result['id']?>'"><button type="button" class="btn btn-danger">Deletar</button> </a>  
                    </td>
                </tr>
            <?php } }?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).on('click', '.excluirUsuario', function() {
            var id_usuario = $(this).data('id');
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Esta ação não pode ser desfeita!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../Action/excluirUsuario.php',
                        type: 'POST',
                        data: { id_usuario: id_usuario },
                        success: function(response) {
                            Swal.fire('Excluído!', 'O usuário foi excluído com sucesso.', 'success');
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

<?php

if (isset($_SESSION['msg'])) {
    
  $mensagem = $_SESSION['msg'];
    echo "<div class='alert alert-success alert-dismissible fade show mt-5 container' role='alert'>
            <strong>Mensagem:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

    unset($_SESSION['msg']);



include 'footer.php';   
?>
