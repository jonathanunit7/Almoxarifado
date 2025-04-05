<?php
include 'header.php'; 

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Editar Usuario <?= (isset($resultado['nome'])) ? "-".$resultado['nome'] : ""  ?></h2>
    
    <!-- Formulário de Edição -->
    <form action="editarUsuario.php" method="POST">
        <input type="hidden" name="id" value="<?= (isset($resultado)) ? $resultado[0]['id'] : ""?>">
        <input type="hidden" name="login" value="<?= (isset($resultado)) ? $resultado[0]['login'] : ""?>">

        <div class="mb-3 col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control border-dark" id="nome" name="nome" value="<?= (isset($resultado)) ? $resultado[0]['nome'] : "" ?>" required>
        </div> 

        <div class="mb-3 col-md-6">
            <label for="email" class="form-label">email</label>
            <input type="text" class="form-control border-dark" id="email" name="email" value="<?= (isset($resultado)) ? $resultado[0]['email'] : ""  ?>" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control border-dark" id="login" name="login" value="<?= (isset($resultado)) ? $resultado[0]['login'] : ""  ?>" disabled>
        </div>

        <div class="mb-3 col-md-6">
            <label for="tipo" class="form-label">senha</label>
            <input type="password" class="form-control border-dark" id="senha" name="senha" value="<?= (isset($resultado)) ? $resultado[0]['senha'] : "" ?>" required>
        </div>

        

        <div class="mb-3 col-md-6">
            <label for="selectBasico" class="form-label">Perfil:</label>
            <select class="form-select border-dark" id="selectBasico" name="perfil" required>
                <option value="Almoxerife" <?= ($resultado[0]['perfil'] == "almoxerife") ? 'selected' : '' ?> >Almoxerife</option>
                <option value="Manutenção" <?= ($resultado[0]['perfil'] == "manutenção") ? 'selected' : '' ?>>Manutenção</option>
                <option value="Patrimonio" <?= ($resultado[0]['perfil'] == "patrimonio") ? 'selected' : '' ?> >Patrimonio</option>
                <option value="Administrador" <?= ($resultado[0]['perfil'] == "administrador") ? 'selected' : '' ?>>Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>


</div>
<div class="container mt-1">  
    <a href="javascript:history.back();" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</body>
</html>

<?php 

if (isset($_SESSION['msg'])) {
    
  $mensagem = $_SESSION['msg'];
    echo "<div class='alert alert-success alert-dismissible fade show mt-5 container' role='alert'>
            <strong>Resultado:</strong> $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

    unset($_SESSION['msg']);


include 'footer.php'; ?>