<?php
session_start();
if(isset($_SESSION['nome'])){//se estiver logado, encaminha para a tela de home
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#bf383a">
    <title>Cadastrado</title>

    <style>
        body { background: var(--cor-fatec); user-select: none;}
        
        ::-webkit-scrollbar { display: none; }
        
        .box-content { 
            background: var(--cor-branco);
            margin: 3rem 15rem;
            border-radius: 1rem;
            padding: 0 10rem;
        }
        .message > p { text-align: center; font-size: 1.8rem; margin: 2rem 0; }
        .button { width: 15rem; text-align: center; margin-bottom: 3rem; }

        @media (max-width: 1200px){ .box-content{margin: 3rem 8rem; padding: 0 5rem;} }
        @media (max-width: 992px){ .box-content{margin: 3rem 5rem; padding: 0 2rem;} }
        @media (max-width: 768px){ .box-content{margin: 3rem 2rem; padding: 0 1rem;} }
        @media (max-width: 600px){ .box-content{margin: 3rem 1rem; padding: 0 .5rem;} }
    </style>

    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./public/css/global.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&family=Sen:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="center box-content">
        <div class="title">
            <div class="rect"></div> Tudo Certo!
        </div>
        <div class="images center">
            <img src="./public/assets/sucesso.png" alt="imagem de sucesso">
        </div>
        <div class="message">
            <p>Seu e-mail foi cadastrado, aguarde ser analisado pelo administrador para ser possível acessa-lo.</p>
        </div>
        <div class="center">
            <a href="./index.php" class="button">IR PARA O INICIO</a>
        </div>
    </div>
    <footer>
        <p>© Todos os direitos Reservados - <a href="http://www.fatecitaqua.edu.br/fatecitaqua/">Fatec Itaquaquecetuba</a></p>
        <div class="social-icon">
            <a href="https://www.instagram.com/fatecitaquaquecetuba/"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com/company/fatec-itaquaquecetuba/"><i class="fab fa-linkedin"></i></a>
            <a href="https://www.youtube.com/channel/UC6LUrLB2BOaw_J_LOHyaisA"><i class="fa fa-youtube"></i></a>
            <a href="https://twitter.com/FatecItaqua"><i class="fa fa-twitter"></i></a>
        </div>
    </footer>
</body>
</html>