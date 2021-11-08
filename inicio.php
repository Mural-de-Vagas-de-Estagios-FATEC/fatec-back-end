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
if(isset($_POST['excluir'])){
    $idExcluir = $_POST['excluir'];
    $sqlExcluir = "DELETE FROM vagas WHERE ID_VAGA=$idExcluir";
    $queryExcluir = mysqli_query($mysqli,$sqlExcluir);
    $cnt--;
    header("inicio.php");
}
if(isset($_POST['publicar'])){
    $id = $_SESSION['id'];
    $nomeVaga = $_POST['nomeVaga'];
    $regime = $_POST['regime'];
    $curso = $_POST['curso'];
    $qntd = $_POST['qntd'];
    $perfil = $_POST['perfil'];
    $data = date('YmdHi');
    $sqlPublicar = "INSERT INTO vagas (AUTOR, NOME_VAGA, REGIME, CURSO, QUANTIDADE, PERFIL, DATA) VALUES ('$id', '$nomeVaga', '$regime', '$curso', '$qntd', '$perfil', '$data')";

    if(mysqli_query($mysqli,$sqlPublicar)){
        header('Location: inicio.php');
        exit();
    }
    else{
        die("Erro no envio da vaga");
    }
}
// Area Perfil

if(isset($_FILES['subImagem'])){
    $id = $_SESSION['id'];
    $extensao = strtolower(substr($_FILES['subImagem']['name'],-4));
    $imagem = 'imagens/' . md5(time()) . $extensao;
    move_uploaded_file($_FILES['subImagem']['tmp_name'], $imagem);

    $sqlNovaImagem = "UPDATE empresa SET IMAGEM = '$imagem' WHERE ID_EMPRESA = '$id'";
    $queryNovaImagem = mysqli_query($mysqli, $sqlNovaImagem);
    $_SESSION['imagem'] = $imagem;
    echo 'Imagem alterada';
    
}

if(isset($_POST['deletarConta'])){
    $id = $_SESSION['id'];
    $sqlExcluirConta = "DELETE FROM empresa WHERE ID_EMPRESA = '$id'";
    $queryExcluirConta = mysqli_query($mysqli, $sqlExcluirConta);
    if($queryExcluirConta){
        session_destroy();
        header('Location: index.php');
        exit;
    }
}

if(isset($_POST['txtNome'])){

    $id = $_SESSION['id'];
    $novoNome = $_POST['txtNome'];
    $novoEmail = $_POST['txtEmail'];
    $novoSenha = $_POST['txtSenha'];
    $novoTel = $_POST['txtTel'];
    $novoCel = $_POST['txtCel'];
    $novoCidade = $_POST['txtCidade'];
    if($novoNome == '' || $novoEmail == '' || $novoTel == '' || $novoCel == '' || $novoCidade == ''){
        echo 'Campos foram deixados em brancos';
        exit();
    }
    $sqlEmail = "SELECT ID_EMPRESA, COUNT(ID_EMPRESA) FROM empresa WHERE EMAIL= '$novoEmail'";
    $queryEmail = mysqli_query($mysqli, $sqlEmail);
    if(mysqli_fetch_row($queryEmail)[0] == $id){// Se a busca pelo email retornar o mesmo id de quem fez a alterãção
        if($novoSenha == ''){//Se não informaram uma nova senha, atualiza o banco de dados

            $sqlAtualizar = "UPDATE empresa SET NOME = '$novoNome', EMAIL = '$novoEmail', CIDADE = '$novoCidade',
            TELEFONE = '$novoTel', CELULAR = '$novoCel' WHERE ID_EMPRESA = '$id'";
            if(mysqli_query($mysqli, $sqlAtualizar)){
                echo "Atualizado com sucesso";
                $_SESSION['nome'] = $novoNome;
                $_SESSION['email'] = $novoEmail;
                $_SESSION['cidade'] = $novoCidade;
                $_SESSION['telefone'] = $novoTel;
                $_SESSION['celular'] = $novoCel;
                
            }
        }
        else {
            $novoSenha = password_hash($novoSenha, PASSWORD_BCRYPT);
            $sqlAtualizar = "UPDATE empresa SET NOME = '$novoNome', EMAIL = '$novoEmail', CIDADE = '$novoCidade',
            SENHA = '$novoSenha', TELEFONE = '$novoTel', CELULAR = '$novoCel' WHERE ID_EMPRESA = '$id'";
            if(mysqli_query($mysqli, $sqlAtualizar)){
                echo "Atualizado com sucesso";
                $_SESSION['nome'] = $novoNome;
                $_SESSION['email'] = $novoEmail;
                $_SESSION['cidade'] = $novoCidade;
                $_SESSION['telefone'] = $novoTel;
                $_SESSION['celular'] = $novoCel;
                
            }
        }
            
    }
    else {
        $sqlVerificaEmail = "SELECT ID_USUARIO, COUNT(ID_USUARIO) FROM usuarios WHERE EMAIL = '$novoEmail'";
        $queryVerifica = mysqli_query($mysqli, $sqlVerificaEmail);
        $sqlVerificaEmailAdmin = "SELECT ID_ADMIN, COUNT(ID_ADMIN) FROM admin WHERE EMAIL = '$novoEmail'";
        $queryVerificaAdmin = mysqli_query($mysqli, $sqlVerificaEmailAdmin);
        $sqlVerificaEmailEmpresa = "SELECT ID_EMPRESA, COUNT(ID_EMPRESA) FROM empresa WHERE EMAIL = '$novoEmail'";
        $queryVerificaEmpresa = mysqli_query($mysqli, $sqlVerificaEmailEmpresa);
        $sqlVerificaEmailP = "SELECT ID_PEND_USUARIO, COUNT(ID_PEND_USUARIO) FROM pendente_usuario WHERE EMAIL = '$novoEmail'";
        $queryVerificaP = mysqli_query($mysqli, $sqlVerificaEmailP);

        $sqlVerificaEmailPEmpresa = "SELECT ID_PEND_EMPRESA, COUNT(ID_PEND_EMPRESA) FROM pendente_empresa WHERE EMAIL = '$novoEmail'";
        $queryVerificaPEmpresa = mysqli_query($mysqli, $sqlVerificaEmailPEmpresa);
        if(mysqli_fetch_row($queryVerifica)[0] != ''){

            die("Esse email já existe no sistema");
        }
        elseif (mysqli_fetch_row($queryVerificaAdmin)[0] != '') {
            die("Esse email já existe no sistema");
        }
        elseif (mysqli_fetch_row($queryVerificaEmpresa)[0] != '') {
            die("Esse email já existe no sistema");
        }
        elseif (mysqli_fetch_row($queryVerificaP)[0] != '') {
            die("Esse email já existe no sistema");
        }
        elseif (mysqli_fetch_row($queryVerificaPEmpresa)[0] != '') {
            die("Esse email já existe no sistema");
        }
        else {
            if($novoSenha == ''){
                $sqlAtualizar = "UPDATE empresa SET NOME = '$novoNome', EMAIL = '$novoEmail', CIDADE = '$novoCidade',
                TELEFONE = '$novoTel', CELULAR = '$novoCel' WHERE ID_EMPRESA = '$id'";
                if(mysqli_query($mysqli, $sqlAtualizar)){
                    echo 'Atualizado com sucesso';
                    $_SESSION['nome'] = $novoNome;
                    $_SESSION['email'] = $novoEmail;
                    $_SESSION['cidade'] = $novoCidade;
                    $_SESSION['telefone'] = $novoTel;
                    $_SESSION['celular'] = $novoCel;
                    
                }
            }
            else {
                $novoSenha = password_hash($novoSenha, PASSWORD_BCRYPT);
                $sqlAtualizar = "UPDATE empresa SET NOME = '$novoNome', EMAIL = '$novoEmail', CIDADE = '$novoCidade',
                SENHA = '$novoSenha', TELEFONE = '$novoTel', CELULAR = '$novoCel' WHERE ID_EMPRESA = '$id'";
                if(mysqli_query($mysqli, $sqlAtualizar)){
                    echo 'Atualizado com sucesso';
                    $_SESSION['nome'] = $novoNome;
                    $_SESSION['email'] = $novoEmail;
                    $_SESSION['cidade'] = $novoCidade;
                    $_SESSION['telefone'] = $novoTel;
                    $_SESSION['celular'] = $novoCel;
                    
                }
            }
        }
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
    <script src="lado_esquerdo.js"></script>
    <style type="text/css">
        .link {
            background: none;
            border: none;
            padding: 0;
            padding-left: 10px;
            font-size: 15px;
            }
    </style>
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
                        <form enctype="multipart/form-data" method="post" id="formImagem"></form>
                        <label class="input-upload center">
                            <input type="file" name="subImagem" value="Imagem" id="fileImagem" form="formImagem" accept="image/png, image/jpeg" onchange="

                            form.submit();
                            ">
                            ALTERAR IMAGEM
                        </label>
                    </div>
                    <form action="forum.php" method="post" id="formPerfil" name="formPerfil"></form>
                    <div class="texto-perfil">
                        Olá <?= $_SESSION['nome']?>, até o momento você divulgou <span id=" "><?=$cnt?></span> vagas em nossa plataforma.
                    </div>
                    <div class="dados-do-perfil">
                        <h3>Dados da empresa</h3>
                        <div class="dados">
                            Nome: <span id="pNome"><?=$_SESSION['nome']?></span><br>
                            E-mail: <span id="pEmail"><?=$_SESSION['email']?></span><br>
                            <span id='spanSenha'></span>
                            <hr id="remove1"><br id="remove4">
                            Tel: <span id="pTel"><?=$_SESSION['telefone']?></span><br>
                            Cel: <span id="pCel"><?=$_SESSION['celular']?></span><br>
                            <hr id="remove2"><br id="remove5">
                            Cidade: <span id="pCidade"><?=$_SESSION['cidade']?></span><br id="remove6"><br>
                            <hr id="remove3"><br id="remove6">
                            <span>CNPJ: <?= $_SESSION['cnpj']?></span>
                        </div>
                        <div class="botoes-perfil">
                            <button class="botao-perfil" name="btnEditarConta" id="btnEditarConta" onclick="editarContaE();">Editar conta</button>
                            <button class="botao-perfil" name="btnExcluirConta" id="btnExcluirConta"onclick="excluirConta(<?= $_SESSION['id']?>);">Excluir conta</button>
                        </div>
                        <div id="hidden_form_container" style="display:none;"></div>
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
                    <form method="post" id="formExcluir"></form>
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
