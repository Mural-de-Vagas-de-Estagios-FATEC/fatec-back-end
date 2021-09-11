<?php
require("verificar_login.php");
if($_SESSION['situacao'] == 'Empresa'){
    header("Location: inicio.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./arquivos/css/menu.css">
    <link rel="stylesheet" href="./arquivos/css/global.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&family=Sen:wght@700&display=swap" rel="stylesheet">
    <title>Estágio Obrigatório</title>
</head>

<body>
    <header>
        <div class="container">
            <input type="checkbox" name="" id="check">
            
            <div class="logo-container">
                <img src="./arquivos/assets/logo-fatec.png" alt="logo fatec">
            </div>

            <div class="nav-btn">
                <div class="nav-links">
                    <ul>
                        <li class="nav-link" style="--i: .6s">
                            <a href="vagas.php">VAGAS</a>
                        </li>
                        <li class="nav-link" style="--i: 1.35s">
                            <a href="forum.php">FORUM</a>
                        </li>
                        <li class="nav-link" style="--i: 1.1s">
                            <a href="#">REGULAMENTO<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="estagio_obrigatorio.php">Estágio Obrigatório</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="dicas_de_curriculo.php">Dicas de Currículo</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="#" class="last">Carta de equivalencia</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-link" style="--i: 1.35s">
                            <a href="sair.php" id="exit">SAIR</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="icon-menu-container">
                <div class="icon-menu">
                    <div></div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section>
            <div class="overlay">
                <div class="title">
                    <div class="rect"></div> Estágio Obrigatório
                </div>
                <div class="center">
                    <div class="content-texto">
                        <p>
                            Estágio é ato educativo escolar supervisionado, desenvolvido no ambiente de trabalho, que visa a preparação para
                          o trabalho produtivo de educandos que estejam frequentando o ensino regular em instituições de educação superior,
                          de educação profissional, de ensino médio, da educação especial e dos anos finais do ensino fundamental, na
                          modalidade profissional da educação de jovens e adultos.
                        </p>
                        <p><br><span class="texto-estagio"> Estágio obrigatório </span> é aquele definido como tal no projeto
                            do curso, cuja carga horária é requisito para aprovação e obtenção de diploma.</p>
                        <div class="link-download">
                            <a href="#">Faça o download dos documentos do estágio</a>
                        </div>
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
            </div>
        </section>
    </main>
</body>

</html>