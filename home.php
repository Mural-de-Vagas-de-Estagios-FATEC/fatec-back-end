<?php
require_once("bd.php");
require_once("verificar_login.php");
if($_SESSION['situacao'] == 'Empresa'){
    header("Location: inicio.php");
}
if(isset($_POST['excluir'])){
    $idExcluir = $_POST['excluir'];
    $sqlExcluir = "DELETE FROM VAGAS WHERE ID_VAGA=$idExcluir";
    $queryExcluir = mysqli_query($mysqli,$sqlExcluir);
    header("home.php");
}
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
    <style type="text/css">
        .link {
            background: none;
            border: none;
            padding: 0;
            padding-left: 10px;
            font-size: 15px;
            }
    </style>
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
                                        <a href="dicas_de_curriculo.php" class="last">Dicas de Currículo</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                        <?php if($_SESSION['situacao'] == 'Admin'){?>
                            <li class="nav-link" style="--i: 1.1s">
                                <a href="#">PENDENTES<i class="fas fa-caret-down"></i></a>
                                <div class="dropdown">
                                    <ul>
                                        <li class="dropdown-link">
                                            <a href="alunos-admin.php">Alunos</a>
                                        </li>
                                        <li class="dropdown-link">
                                            <a href="egressos-admin.php">Egressos</a>
                                        </li>
                                        <li class="dropdown-link">
                                            <a href="empresas-admin.php" class="last">Empresas</a>
                                        </li>
                                        <div class="arrow"></div>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-link" style="--i: 1.35s">
                                <a href="admin.php">DIVULGAR VAGA</a>
                            </li>
                        <?php }?>
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
                        <p>© Todos os direitos Reservados - <a href="http://www.fatecitaqua.edu.br/fatecitaqua/">Fatec Itaquaquecetuba</a></p>
                        <div class="social-icon">
                            <a href="https://www.instagram.com/fatecitaquaquecetuba/"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/company/fatec-itaquaquecetuba/"><i class="fab fa-linkedin"></i></a>
                            <a href="https://www.youtube.com/channel/UC6LUrLB2BOaw_J_LOHyaisA"><i class="fa fa-youtube"></i></a>
                            <a href="https://twitter.com/FatecItaqua"><i class="fa fa-twitter"></i></a>
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
