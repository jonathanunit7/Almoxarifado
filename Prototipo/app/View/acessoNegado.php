<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <title>Acesso Restrito</title>
    <link rel="stylesheet" href="../style/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-acesso {
            max-width: 600px;
            border: none;
            border-radius: 1rem;
            padding: 2rem;
            background-color: #ffffff;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
        }
        .icon-box {
            width: 80px;
            height: 80px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }
        .icon-box i {
            font-size: 2rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class='container d-flex justify-content-center align-items-center vh-100'>
    <div class='card-acesso text-center'>        
        <h3 class='mb-3 text-danger'>Acesso Restrito</h3>
        <p class='mb-4'>Desculpe, você não tem permissão para visualizar esta página.</p>
        <p class='text-muted'>Você será redirecionado em instantes...</p>
    </div>
</div>
</body>
</html>

<?php 

    header("refresh:5;url=index.php");
    exit;
?>    