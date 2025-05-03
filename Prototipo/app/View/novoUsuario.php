<?php
include 'header.php'; 
?>

<main>
<div class="container-fluid mt-5">

    <div class="bg-white p-5 rounded-4 shadow-sm">

        <!-- Título -->
        <div class="text-start mb-4">
            <h2 class="fw-bold">Novo Usuário</h2>
            <p class="text-muted">Preencha as informações abaixo para criar um novo usuário.</p>
        </div>

        <!-- Formulário de Edição -->
        <form action="../action/novoUsuario.php" method="POST">
            <div class="row g-4">

               
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="nome" name="nome" required>
                </div>

                <div class="col-md-6">
                    <label for="nome" class="form-label">CPF</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="cpf_solicitante" name="cpf" required>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-lg border-dark" id="email" name="email" required>
                </div>

                <!-- Login -->
                <div class="col-md-6">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="login" name="login" required>
                </div>

                <!-- Senha -->
                <div class="col-md-6">
                    <label for="senha" class="form-label">Senha</label>
                    <div class="input-group">
                        <input type="password" class="form-control form-control-lg border-dark" id="senha" name="senha" required>
                        <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                            👁️
                        </span>
                    </div>
                </div>

                <!-- Perfil -->
                <div class="col-md-6">
                    <label for="perfil" class="form-label">Perfil</label>
                    <select class="form-select form-select-lg border-dark" id="perfil" name="perfil" required>
                        <option value="Almoxerife" selected>Almoxerife</option>
                        <option value="Manutenção">Manutenção</option>
                        <option value="Solicitante">Solicitante</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>

            </div>

            <!-- Botões -->
            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="usarios.php" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-save"></i> Inserir
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

<?php include 'footer.php'; ?>
