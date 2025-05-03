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
<div class="container-fluid mt-5">

    <div class="bg-white p-5 rounded-4 shadow-sm">

        <!-- Título -->
        <div class="text-start mb-4">
            <h2 class="fw-bold">Editar Histórico <?= (isset($resultado[0]['id'])) ? "- ID: " . htmlspecialchars($resultado[0]['id']) : "" ?></h2>
            <p class="text-muted">Faça as edições necessárias e salve as alterações.</p>
        </div>

        <!-- Formulário de Edição -->
        <form action="editarHistoricoEquipamento.php" method="POST">
            <input type="hidden" name="id" value="<?= (isset($resultado)) ? htmlspecialchars($resultado[0]['id']) : "" ?>">

            <div class="row g-4">

                <!-- Descrição -->
                <div class="col-md-6">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="descricao" name="descricao" value="<?= (isset($resultado)) ? htmlspecialchars($resultado[0]['descricao']) : "" ?>" required>
                </div>

                <!-- Data da Manutenção -->
                <div class="col-md-6">
                    <label for="data_manutencao" class="form-label">Data da Manutenção</label>
                    <input type="datetime-local" class="form-control form-control-lg border-dark" id="data_manutencao" name="data_manutencao" value="<?= (isset($resultado)) ? htmlspecialchars($resultado[0]['data_manutencao']) : "" ?>" required>
                </div>

                <!-- Responsável -->
                <div class="col-md-6">
                    <label for="responsavel" class="form-label">Responsável</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="responsavel" name="responsavel" value="<?= (isset($resultado)) ? htmlspecialchars($resultado[0]['responsavel']) : "" ?>" required>
                </div>

                <!-- Custo -->
                <div class="col-md-6">
                    <label for="custo" class="form-label">Custo</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="custo" name="custo" value="<?= (isset($resultado)) ? htmlspecialchars($resultado[0]['custo']) : "" ?>" required>
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

        <!-- Mensagem -->
        <?php
        if (isset($_SESSION['msg'])) {
            $mensagem = $_SESSION['msg'];
            echo "<div class='alert alert-success alert-dismissible fade show mt-4' role='alert'>
                    <strong>Sucesso!</strong> $mensagem
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
            unset($_SESSION['msg']);
        }
        ?>

    </div>

</div>
</main>

<?php include 'footer.php'; ?>
