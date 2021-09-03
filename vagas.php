<?php
require_once("bd.php");
require_once("verificar_login.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./public/css/menu.css">
    <link rel="stylesheet" href="./public/css/global.css">
    <link rel="stylesheet" href="./public/css/vagas.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&family=Sen:wght@700&display=swap" rel="stylesheet">
    <title>Área de Vagas</title>
</head>

<body>
    <header>
        <div class="container">
            <input type="checkbox" name="" id="check">
            
            <div class="logo-container">
                <img src="./public/assets/logo-fatec.png" alt="logo fatec">
            </div>

            <div class="nav-btn">
                <div class="nav-links">
                    <ul>
                        <li class="nav-link" style="--i: .6s">
                            <a href="#">VAGAS</a>
                        </li>
                        <li class="nav-link" style="--i: 1.35s">
                            <a href="#">FORUM</a>
                        </li>
                        <li class="nav-link" style="--i: 1.1s">
                            <a href="#">REGULAMENTO<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="#">Estágio Obrigatório</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="#">Dicas de Currículo</a>
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
                <div class="container-vagas-elementos">
                    <div class="ola-usuario">Olá <span id="name-id"><?= $_SESSION['nome']?></span>, aqui estão as vagas disponiveis para o seu perfil.</div>

                    <div class="title">
                        <div class="rect"></div> Vagas Disponíveis
                    </div>

                    <div>
                        <forms class="input-search center">
                            <div>
                                <i class="fas fa-search"></i>
                                <input type="search" name="pesquisar" id="" placeholder="PESQUISAR">
                            </div>
                        </forms>
                    </div>

                    <div class="vagas center">
                        <?php 
                        require_once("bdVagas.php")
                        ?>
                    </div>
                    <div id="pagination-container"></div>
                    <footer>
                        <p>© Todos os direitos Reservados - <a href="#">Fatec Itaquaquecetuba</a></p>
                        <div class="social-icon">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </div>
                    </footer>
                    </div>
                </div>
            </div>
        </section>
        
    </main>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script src="./public/js/paginacao.js"></script>
</html>