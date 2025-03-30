<?php
include 'header.php'; 

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Usuario</title>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Novo Usuario</h2>
    
    <form action="../action/novoUsuario.php" method="POST">

        <div class="mb-3 col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control border-dark col-6" id="nome" name="nome" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control border-dark col-6" id="email" name="email" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="tipo" class="form-label">Login</label>
            <input type="text" class="form-control border-dark" id="login" name="login" required>
        </div>
            <label for="tipo" class="form-label">Senha</label>

        <div class="input-group-sm mb-3 col-md-6">
            <input type="password" class="form-control border-dark" id="senha" name="senha" required>
              <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                👁️
            </span>
        </div>

        <div class="mb-3 col-md-6">
            <label for="selectBasico" class="form-label">Perfil:</label>
            <select class="form-select border-dark" id="selectBasico" name="perfil" required>
                <option value="Almoxerife" selected>Almoxerife</option>
                <option value="Manutenção" >Manutenção</option>
                <option value="Patrimonio">Patrimonio</option>
                <option value="Administrador">Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Inserir</button>
    </form>
</div>

<div class="container mt-1">  
    <a href="usarios.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>

</body>
</html>
<script type="text/javascript">
    
function togglePassword() {
    const senha = document.getElementById("senha");
    if (senha.type === "password") {
        senha.type = "text";
    } else {
        senha.type = "password";
    }
}


</script>
<?php 

if (isset($_SESSION['msg'])) {
    
  $mensagem = $_SESSION['msg'];
    echo "<div class='alert alert-success alert-dismissible fade show mt-5 container' role='alert'>
            <strong>Mensagem:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

if (isset($_SESSION['msg2'])) {
    
  $mensagem = $_SESSION['msg2'];
    echo "<div class='alert alert-danger alert-dismissible fade show mt-5 container' role='alert'>
            <strong>Mensagem:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

    unset($_SESSION['msg2']);


include 'footer.php'; ?>