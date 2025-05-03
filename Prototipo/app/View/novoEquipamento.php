<?php
include 'header.php'; 
?>

<main>
<div class="container-fluid mt-5">

    <div class="bg-white p-5 rounded-4 shadow-sm">

        <!-- Título -->
        <div class="text-start mb-4">
            <h2 class="fw-bold">Cadastrar Novo Equipamento</h2>
            <p class="text-muted">Preencha os campos abaixo para adicionar um novo equipamento ao sistema.</p>
        </div>

        <!-- Formulário -->
        <form action="../action/novoEquipamento.php" method="POST">

            <div class="row g-4">

                <!-- Código de Barras ocupa a linha inteira -->
                <div class="col-md-6">
                    <label for="codigoDeBarra" class="form-label">Código de Barras</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="codigoDeBarra" name="codigo_de_barras" required>
                </div>

                <!-- Nome ocupa a metade -->
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome do Equipamento</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="nome" name="nome_equipamento" required>
                </div>

                <!-- Tipo ocupa a metade -->
                <div class="col-md-6">
                    <label for="tipo" class="form-label">Tipo do Equipamento</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="tipo" name="tipo" required>
                </div>

            </div>

            <!-- Botões -->
            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="equipamentos.php" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-lg"></i> Inserir
                </button>
            </div>

        </form>

        <!-- Mensagem de Sucesso -->
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

<?php 
include 'footer.php'; 
?>
