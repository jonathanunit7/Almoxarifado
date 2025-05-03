<?php
include 'header.php';   
?>

<main>
<div class="container-fluid mt-5">

    <div class="bg-white p-5 rounded-4 shadow-sm">

        <!-- Título -->
        <div class="text-start mb-4">
            <h2 class="fw-bold">Novo Histórico <?= (isset($_GET['nome'])) ? ": " . htmlspecialchars($_GET['nome']) : "" ?></h2>
            <p class="text-muted">Preencha os dados da manutenção realizada.</p>
        </div>

        <!-- Formulário -->
        <form action="../action/novoHistoricoEquipamento.php" method="POST">
            <input type="hidden" name="id" value="<?= (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : "" ?>">

            <div class="row g-4">

                <!-- Descrição -->
                <div class="col-md-6">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="descricao" name="descricao" required>
                </div>

                <!-- Data da manutenção -->
                <div class="col-md-6">
                    <label for="data_manutencao" class="form-label">Data da Manutenção</label>
                    <input type="datetime-local" class="form-control form-control-lg border-dark" id="data_manutencao" name="data_manutencao" required>
                </div>

                <!-- Responsável -->
                <div class="col-md-6">
                    <label for="responsavel" class="form-label">Responsável</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="responsavel" name="responsavel" required>
                </div>

                <!-- Custo -->
                <div class="col-md-6">
                    <label for="custo" class="form-label">Custo</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="custo" name="custo" required>
                </div>

            </div>

            <!-- Botões -->
            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="javascript:history.back();" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-save"></i> Salvar
                </button>
            </div>

        </form>

        <!-- Mensagem -->
        <?php
        if (isset($_SESSION['msg'])) {
            $mensagem = $_SESSION['msg'];
            echo "<div class='alert alert-success alert-dismissible fade show mt-4' role='alert'>
                    <strong>Mensagem:</strong> $mensagem
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
            unset($_SESSION['msg']);
        }
        ?>

    </div>

</div>
</main>

<?php include 'footer.php'; ?>
