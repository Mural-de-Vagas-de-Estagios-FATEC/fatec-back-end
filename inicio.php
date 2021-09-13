<?php
require_once("bd.php");
require_once("verificar_login.php");
if($_SESSION['situacao'] != "Empresa"){
    header("Location: home.php");
}
$cnt = 0;
$sqlVagas = "SELECT * FROM vagas";
$queryVagas = mysqli_query($mysqli,$sqlVagas); 

if(mysqli_num_rows($queryVagas) > 0) {
    $sqlId = "SELECT * FROM vagas WHERE AUTOR=" . $_SESSION['id'];
    $queryId = mysqli_query($mysqli,$sqlId);
    $infoId = mysqli_fetch_all($queryId);

    $cnt = sizeof($infoId);
}

if(isset($_POST['publicar'])){
    $id = $_SESSION['id'];
    $nomeVaga = $_POST['nomeVaga'];
    $regime = $_POST['regime'];
    $curso = $_POST['curso'];
    $qntd = $_POST['qntd'];
    $perfil = $_POST['perfil'];
    $sqlPublicar = "INSERT INTO vagas (AUTOR, NOME_VAGA, REGIME, CURSO, QUANTIDADE, PERFIL) VALUES ('$id', '$nomeVaga',
    '$regime', '$curso', '$qntd', '$perfil')";

    if(mysqli_query($mysqli,$sqlPublicar)){
        header('Location: inicio.php');
        exit();
    }
    else{
        die("Erro no envio da vaga");
    }
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
    <link rel="stylesheet" href="./public/css/grid.css">
    <link rel="stylesheet" href="./public/css/vagas.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&family=Sen:wght@400;700&display=swap" rel="stylesheet">
    <title>Divulgar Vagas</title>
</head>

<body>
    <header>
        <div class="container">
            <input type="checkbox" name="" id="check">
            
            <div class="logo-container">
                <a href="inicio.php">
                    <img src="./public/assets/logo-fatec.png" alt="logo fatec">
                </a>
            </div>

            <div class="nav-btn">
                <div class="nav-links">
                    <ul>
                        
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
            <div class="container-perfil-flex">
                <div class="lado-esquerdo">
                    <div class="altera-image">
                        <div class="imagem-perfil center">
                            <img src="<?= $_SESSION['imagem']?>" alt="imagem da empresa">
                        </div>
                        <label class="input-upload center">
                            <input type="file" name="" id="">
                            ALTERAR IMAGEM
                        </label>
                    </div>
                    <div class="texto-perfil">
                        Olá <?= $_SESSION['nome']?>, até o momento você divulgou <span id=" "><?=$cnt?></span> vagas em nossa plataforma.
                    </div>
                    <div class="dados-do-perfil">
                        <h3>Dados da empresa</h3>
                        <div class="dados">
                            <p>Nome: <?=$_SESSION['nome']?></p>
                            <p>E-mail: <?= $_SESSION['email']?></p>
                            <hr>
                            <p>Tel: <?= $_SESSION['telefone']?></p>
                            <p>Cel: <?= $_SESSION['celular']?></p>
                            <hr>
                            <p>Cidade: <?= $_SESSION['cidade']?></p>
                            <hr>
                            <p>CNPJ: <?= $_SESSION['cnpj']?></p>
                        </div>
                        <div class="botoes-perfil">
                            <button class="botao-perfil">Editar conta</button>
                            <button class="botao-perfil">Excluir conta</button>
                        </div>
                    </div>
                </div>
                
                <div class="lado-direito">
                    <p class="texto-perfil-hidden">Olá <?= $_SESSION['nome']?>, até o momento você divulgou <span id=" "><?=$cnt?></span> vagas em nossa plataforma.</p>
                    <div class="title">
                        <div class="rect"></div> Divulgar Vagas
                    </div>

                    <div class="formulario-divulgar-vaga">
                        <form method="post">
                            <table>
                                <tr>
                                    <td colspan="2">
                                        <label for="">Nome da Vaga</label>
                                        <br><input type="text" name="nomeVaga" id="" class="input">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label for="">Regime do Estágio (Horário e dias da Semana)</label>
                                        <br><input type="text" name="regime" id="" class="input">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Curso de Interesse</label>
                                        <br><select class="input" aria-label="Default select example" id="select-curso" name="curso"></select>
                                    </td>
                                    <td>
                                        <label for="">Quantidade de Vagas</label>
                                        <!-- <br><input type="number" name="" id="" class="input"> -->
                                        <div class="quantidade">
                                            <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                            <input type="number" name="qntd" id="number" value="1" />
                                            <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label for="">Perfil da Vaga</label><br>
                                        <textarea name="perfil" id="" class="input" placeholder="Descreva sobre o perfil da vaga."></textarea>
                                    </td>
                                </tr>
                            </table>
                            <div class="buttons-forms center">
                                <button type="submit" name="publicar" class="button">Publicar</button>
                            </div>
                        </form>

                        
                    </div>
                    <?php 
                    include_once("bdDivulgar_vagas.php");
                    ?>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="./public/js/divulgar-vagas.js"></script>
</html>