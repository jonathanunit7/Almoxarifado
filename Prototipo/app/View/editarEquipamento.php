<?php

  if(isset($_SESSION['perfil'])){
        if($_SESSION['perfil'] != 'Administrador' && $_SESSION['perfil'] != 'Almoxerife' && $_SESSION['perfil'] != 'Manutenção'){
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
            <h2 class="fw-bold">Editar Equipamento <?= (isset($resultado[0]['nome'])) ? "- " . htmlspecialchars($resultado[0]['nome']) : "" ?></h2>
            <p class="text-muted">Atualize as informações do equipamento abaixo.</p>
        </div>

        <!-- Formulário -->
        <form action="editarEquipamento.php" method="POST">
            <input type="hidden" name="id" value="<?= (isset($resultado[0]['id'])) ? $resultado[0]['id'] : "" ?>">

            <div class="row g-4">

                <!-- Código de Barras -->
                <div class="col-md-6">
                    <label for="codigoDeBarra" class="form-label">Código de Barras</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="codigoDeBarra" name="codigo_de_barras" value="<?= (isset($resultado[0]['codigoDeBarra'])) ? htmlspecialchars($resultado[0]['codigoDeBarra']) : "" ?>" required>
                </div>

                <!-- Nome -->
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome do Equipamento</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="nome" name="nome" value="<?= (isset($resultado[0]['nome'])) ? htmlspecialchars($resultado[0]['nome']) : "" ?>" required>
                </div>

                <!-- Tipo -->
                <div class="col-md-6">
                    <label for="tipo" class="form-label">Tipo do Equipamento</label>
                    <input type="text" class="form-control form-control-lg border-dark" id="tipo" name="tipo" value="<?= (isset($resultado[0]['tipo'])) ? htmlspecialchars($resultado[0]['tipo']) : "" ?>" required>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="selectBasico" class="form-label">Status do Equipamento</label>
                    <select class="form-select form-select-lg border-dark" id="selectBasico" name="status" required>
                        <option value="Disponível" <?= (isset($resultado[0]['status']) && $resultado[0]['status'] == "Disponível") ? 'selected' : '' ?>>Disponível</option>
                        <option value="Manutenção" <?= (isset($resultado[0]['status']) && $resultado[0]['status'] == "Manutenção") ? 'selected' : '' ?>>Manutenção</option>
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

        <!-- Mensagem de Resultado -->
        <?php 
        if (isset($_SESSION['msg'])) {
            $mensagem = $_SESSION['msg'];
            echo "<div class='alert alert-success alert-dismissible fade show mt-4' role='alert'>
                    <strong>Resultado:</strong> $mensagem
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
