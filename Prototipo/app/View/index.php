<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Almoxarifado</title>

    <link href="../style/bootstrap.min.css" rel="stylesheet">
    <script src="../View/jquery-3.6.0.min.js"></script>
    <script src="../View/bootstrap.bundle.min.js"></script>

    <!-- Estilos customizados para esse template -->
    <style>
      body {
        background-color: #f4f4f9; /* Cor de fundo mais suave */
      }

      .form-signin {
        max-width: 400px;
        padding: 30px;
        margin: auto;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .form-signin .form-control {
        border-radius: 4px;
      }

      .form-signin .btn {
        width: 100%;
        border-radius: 4px;
      }

      .checkbox label {
        font-size: 0.875rem;
      }

      .navbar {
        margin-bottom: 30px;
      }

      h1 {
        font-size: 2rem;
        margin-bottom: 30px;
      }

      .text-muted {
        font-size: 0.75rem;
      }

      .form-signin input {
        margin-bottom: 15px;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="../View/index.php">Almox</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
    </nav>

    <div class="container">
      <form class="form-signin" method="post" action="../Action/Bem-Vindo.php">
        <h1 class="h3 mb-3 font-weight-normal text-center">Tela de Login</h1>

        <div class="form-group">
          <label for="inputEmail" class="sr-only">Usuário</label>
          <input type="text" name="login" class="form-control" placeholder="Seu login" required autofocus>
        </div>

        <div class="form-group">
          <label for="inputPassword" class="sr-only">Senha</label>
          <input type="password" name="senha" class="form-control" placeholder="Senha" required>
        </div>

        <div class="form-group form-check mb-3">
          <input type="checkbox" class="form-check-input" id="rememberMe">
          <label class="form-check-label" for="rememberMe">Lembrar de mim</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        
        <p class="mt-4 mb-3 text-muted text-center">&copy; 2025-2030</p>
      </form>
    </div>
  </body>
</html>
