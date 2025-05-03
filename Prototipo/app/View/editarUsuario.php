<?php

  if(isset($_SESSION['perfil'])){
        if($_SESSION['perfil'] != 'Administrador' && $_SESSION['perfil'] != 'Almoxerife'){
            header("refresh:1;url=../view/acessoNegado.php");
            exit;     
        }
    }


include 'header.php'; 
?>

<main>
<div class="container mt-5">

    <div class="bg-white p-5 rounded-4 shadow-sm">

        <!-- Título -->
        <div class="text-start mb-4">
            <h2 class="fw-bold">Editar Usuário <?= (isset($resultado['nome'])) ? "- ".$resultado['nome'] : ""  ?></h2>
            <p class="text-muted">Faça as alterações necessárias nos campos abaixo.</p>
        </div>

        <!-- Formulário de Edição -->
        <form action="editarUsuario.php" method="POST">
            <input type="hidden" name="id" value="<?= (isset($resultado)) ? $resultado[0]['id'] : "" ?>">
            <input type="hidden" name="login" value="<?= (isset($resultado)) ? $resultado[0]['login'] : "" ?>">

            <div class="row g-4">

                <!-- Nome -->
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="nome" name="nome" value="<?= (isset($resultado)) ? $resultado[0]['nome'] : "" ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="nome" class="form-label">CPF</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="cpf_solicitante" name="cpf" value="<?= (isset($resultado)) ? $resultado[0]['cpf'] : "" ?>" required>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-lg border-dark" id="email" name="email" value="<?= (isset($resultado)) ? $resultado[0]['email'] : "" ?>" required>
                </div>

                <!-- Login -->
                <div class="col-md-6">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="login" name="login" value="<?= (isset($resultado)) ? $resultado[0]['login'] : "" ?>" disabled>
                </div>

                <!-- Senha -->
                <div class="col-md-6">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control form-control-lg border-dark" id="senha" name="senha" value="<?= (isset($resultado)) ? $resultado[0]['senha'] : "" ?>" required>
                </div>

                <!-- Perfil -->
                <div class="col-md-6">
                    <label for="perfil" class="form-label">Perfil</label>
                    <select class="form-select form-select-lg border-dark" id="perfil" name="perfil" required>
                        <option value="Almoxerife" <?= ($resultado[0]['perfil'] == "Almoxerife") ? 'selected' : '' ?>>Almoxerife</option>
                        <option value="Manutenção" <?= ($resultado[0]['perfil'] == "Manutenção") ? 'selected' : '' ?>>Manutenção</option>
                        <option value="Solicitante" <?= ($resultado[0]['perfil'] == "Solicitante") ? 'selected' : '' ?>>Solicitante</option>
                        <option value="Administrador" <?= ($resultado[0]['perfil'] == "Administrador") ? 'selected' : '' ?>>Administrador</option>
                    </select>
                </div>

            </div>

            <!-- Botões -->
            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="javascript:history.back();" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-save"></i> Salvar Alterações
                </button>
            </div>

        </form>

        <!-- Mensagens -->
        <?php 
        if (isset($_SESSION['msg'])) {
            $mensagem = $_SESSION['msg'];
            echo "<div class='alert alert-success alert-dismissible fade show mt-4' role='alert'>
                    <strong>Sucesso!</strong> $mensagem
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
            unset($_SESSION['msg']);
        }

        if (isset($_SESSION['msg2'])) {
            $mensagem = $_SESSION['msg2'];
            echo "<div class='alert alert-danger alert-dismissible fade show mt-4' role='alert'>
                    <strong>Erro!</strong> $mensagem
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
            unset($_SESSION['msg2']);
        }
        ?>

    </div>

</div>
</main>

<?php include 'footer.php'; ?>
