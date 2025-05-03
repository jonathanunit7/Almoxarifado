<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almox</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../style/bootstrap.min.css">

    <!-- jQuery -->
    <script src="../scripts/jquery-3.6.0.min.js"></script>

    <script src="../scripts/validarCpf.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="../scripts/bootstrap.bundle.min.js"></script>

    <!-- DataTables CSS e JS -->
    <link rel="stylesheet" href="../style/jquery.dataTables.min.css">
    <script src="../scripts/jquery.dataTables.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="../scripts/sweetalert2@11.js"></script>

    <style>
        .navbar-brand {
            font-size: 1.3rem;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #fff;
            text-decoration: underline;
        }

        .nav-link{
            color: #E0E0E0;
        }

        .user-info {
            margin-right: 1rem;
            color: white;
        }

        .fundo{
            color: #E0E0E0;
        }

        .btn-logout {
            margin-left: 1rem;
        }
    </style>
</head>

<body class="fundo text-black">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background:#2a5d84;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../View/index.php">Almox</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                        if(isset($_SESSION['perfil']) ){
                            if($_SESSION['perfil'] == 'Administrador' ||  $_SESSION['perfil'] == 'Almoxerife'){
                            echo '<li class="nav-item">
                                <a class="nav-link" href="../View/emprestimo.php">Realizar Empréstimo</a>
                            </li>';
                            }
                        }
                    ?>
                     <li class="nav-item">
                        <a class="nav-link" href="../Action/solicitacoes.php?id_usuario=<?=$_SESSION['user_id']?>">Solicitações</a>
                    </li>
                    <?php
                    if(isset($_SESSION['perfil']) ){
                            if($_SESSION['perfil'] == 'Administrador' || $_SESSION['perfil'] == 'Almoxerife' ){
                            echo'<li class="nav-item">
                                    <a class="nav-link" href="../Action/listarAtividade.php">Atividade</a>
                                </li> ';
                            }
                    }
                     ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="../Action/listarEmprestimo.php">Agenda de Empréstimos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Action/listarEquipamentos.php">Equipamentos</a>
                    </li>
                    <?php
                    if(isset($_SESSION['perfil']) ){
                            if($_SESSION['perfil'] == 'Administrador'){
                            echo '<li class="nav-item">
                                    <a class="nav-link" href="../Action/usuarios.php">Usuários</a>
                                </li>';
                        }
                    }    
                  ?>            
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <span class="user-info">Olá, <?= $_SESSION['nome'] ?></span>
                <a href="../View/logout.php" class="btn btn-danger btn-sm">Sair</a>
            </div>
        </div>
    </nav>
</body>

</html>
