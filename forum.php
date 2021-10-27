<?php
require_once("bd.php");
require_once("verificar_login.php");
if($_SESSION['situacao'] == 'Empresa'){
    header("Location: inicio.php");
}
$novoSemestre;
if(isset($_POST['excluir'])){
    $idExcluir = $_POST['excluir'];
    $sqlExcluir = "DELETE FROM forum WHERE ID_PUBLICACAO=$idExcluir";
    $queryExcluir = mysqli_query($mysqli,$sqlExcluir);
    header("forum.php");
}
if(isset($_POST['enviar'])){
    $autor = $_SESSION['id'];
    $situacao;
    if($_SESSION['situacao'] == 'Admin'){
        $situacao = 'Admin';
    }
    else {
        $situacao = 'Usuario';
    }
    $publicacao = $_POST['txtaPublicacao'];

    $sqlPublicar = "INSERT INTO forum (AUTOR, SITUACAO, PUBLICACAO, COMENTARIOS) VALUES ('$autor', '$situacao', '$publicacao','0')";
    if(mysqli_query($mysqli,$sqlPublicar)){
        header("Location: forum.php");//redireciona o usuário para a página principal
        exit();
    }
    else {
        die("Erro no envio da publicação");
    }
}
//Area do Perfil
if(isset($_FILES['subImagem'])){
    $id = $_SESSION['id'];
    $extensao = strtolower(substr($_FILES['subImagem']['name'],-4));
    $imagem = 'imagens/' . md5(time()) . $extensao;
    move_uploaded_file($_FILES['subImagem']['tmp_name'], $imagem);
    if($_SESSION['situacao'] == 'Aluno' || $_SESSION['situacao'] == 'Egresso'){

        $sqlNovaImagem = "UPDATE usuarios SET IMAGEM = '$imagem' WHERE ID_USUARIO = '$id'";
        $queryNovaImagem = mysqli_query($mysqli, $sqlNovaImagem);
        $_SESSION['imagem'] = $imagem;
        echo 'Imagem alterada';
    }
    else {
        $sqlNovaImagem = "UPDATE admin SET IMAGEM = '$imagem' WHERE ID_admin = '$id'";
        $queryNovaImagem = mysqli_query($mysqli, $sqlNovaImagem);
        $_SESSION['imagem'] = $imagem;
        echo 'Imagem alterada';

    }
}
if(isset($_POST['txtNome'])){

    if($_SESSION['situacao'] == 'Admin'){
        $id = $_SESSION['id'];
        $novoNome = $_POST['txtNome'];
        $novoEmail = $_POST['txtEmail'];
        $novoSenha = $_POST['txtSenha'];

        if($novoNome == '' || $novoEmail == ''){
            echo 'Campos foram deixados em brancos';
            exit();
        }

        $sqlEmail = "SELECT ID_ADMIN, COUNT(ID_ADMIN) FROM admin WHERE EMAIL= '$novoEmail'";
        $queryEmail = mysqli_query($mysqli, $sqlEmail);
        if(mysqli_fetch_row($queryEmail)[0] == $id){
            if($novoSenha == ''){
                $sqlAtualizar = "UPDATE admin SET NOME = '$novoNome', EMAIL = '$novoEmail'
                WHERE ID_ADMIN = '$id'";
                if(mysqli_query($mysqli, $sqlAtualizar)){
                    echo "Atualizado com sucesso";
                    $_SESSION['nome'] = $novoNome;
                    $_SESSION['email'] = $novoEmail;
                }
            }
            else {
                $novoSenha = password_hash($novoSenha, PASSWORD_BCRYPT);
                $sqlAtualizar = "UPDATE admin SET NOME = '$novoNome', EMAIL = '$novoEmail',
                SENHA = '$novoSenha' WHERE ID_ADMIN = '$id'";
                if(mysqli_query($mysqli, $sqlAtualizar)){
                    echo "Atualizado com sucesso";
                    $_SESSION['nome'] = $novoNome;
                    $_SESSION['email'] = $novoEmail;
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
                    $sqlAtualizar = "UPDATE admin SET NOME = '$novoNome', EMAIL = '$novoEmail' WHERE ID_ADMIN = '$id'";
                    if(mysqli_query($mysqli, $sqlAtualizar)){
                        echo 'Atualizado com sucesso';
                        $_SESSION['nome'] = $novoNome;
                        $_SESSION['email'] = $novoEmail;
                    }
                }
                else {
                    $novoSenha = password_hash($novoSenha, PASSWORD_BCRYPT);
                    $sqlAtualizar = "UPDATE admin SET NOME = '$novoNome', EMAIL = '$novoEmail', SENHA = '$novoSenha' WHERE ID_ADMIN = '$id'";
                    if(mysqli_query($mysqli, $sqlAtualizar)){
                        echo 'Atualizado com sucesso';
                        $_SESSION['nome'] = $novoNome;
                        $_SESSION['email'] = $novoEmail;
                    }
                }
            }
        }
    }
    else {
        $id = $_SESSION['id'];
        $novoNome = $_POST['txtNome'];
        $novoEmail = $_POST['txtEmail'];
        $novoSenha = $_POST['txtSenha'];
        if(isset($_POST['slcSemestre'])){
            $novoSemestre = $_POST['slcSemestre'];
        }
        else {
            $novoSemestre = $_SESSION['semestre'];
        }

        if($novoNome == '' || $novoEmail == ''){
            echo 'Campos foram deixados em brancos';
            exit();
        }

        $sqlEmail = "SELECT ID_USUARIO, COUNT(ID_USUARIO) FROM usuarios WHERE EMAIL= '$novoEmail'";
        $queryEmail = mysqli_query($mysqli, $sqlEmail);
        if(mysqli_fetch_row($queryEmail)[0] == $id){
            if($novoSenha == ''){

                if($novoSemestre != $_SESSION['semestre'] && $novoSemestre == 'Concluído'){
                    $sqlAtualizar = "UPDATE usuarios SET NOME = '$novoNome', EMAIL = '$novoEmail',
                    SEMESTRE = '$novoSemestre', SITUACAO = 'Egresso' WHERE ID_USUARIO = '$id'";
                    if(mysqli_query($mysqli, $sqlAtualizar)){
                        echo "Atualizado com sucesso";
                        $_SESSION['nome'] = $novoNome;
                        $_SESSION['email'] = $novoEmail;
                        $_SESSION['semestre'] = $novoSemestre;
                        $_SESSION['situacao'] = 'Egresso';
                    }
                }
                else {
                    $sqlAtualizar = "UPDATE usuarios SET NOME = '$novoNome', EMAIL = '$novoEmail',
                    SEMESTRE = '$novoSemestre' WHERE ID_USUARIO = '$id'";
                    if(mysqli_query($mysqli, $sqlAtualizar)){
                        echo "Atualizado com sucesso";
                        $_SESSION['nome'] = $novoNome;
                        $_SESSION['email'] = $novoEmail;
                        $_SESSION['semestre'] = $novoSemestre;
                    }
                }
            }
            else {
                $novoSenha = password_hash($novoSenha, PASSWORD_BCRYPT);
                if($novoSemestre != $_SESSION['semestre'] && $novoSemestre == 'Concluído'){
                    $sqlAtualizar = "UPDATE usuarios SET NOME = '$novoNome', EMAIL = '$novoEmail',
                    SEMESTRE = '$novoSemestre', SENHA = '$novoSenha', SITUACAO = 'Egresso' WHERE ID_USUARIO = '$id'";
                    if(mysqli_query($mysqli, $sqlAtualizar)){
                        echo "Atualizado com sucesso";
                        $_SESSION['nome'] = $novoNome;
                        $_SESSION['email'] = $novoEmail;
                        $_SESSION['semestre'] = $novoSemestre;
                        $_SESSION['situacao'] = 'Egresso';
                    }
                }
                else {
                    $sqlAtualizar = "UPDATE usuarios SET NOME = '$novoNome', EMAIL = '$novoEmail',
                    SEMESTRE = '$novoSemestre', SENHA = '$novoSenha' WHERE ID_USUARIO = '$id'";
                    if(mysqli_query($mysqli, $sqlAtualizar)){
                        echo "Atualizado com sucesso";
                        $_SESSION['nome'] = $novoNome;
                        $_SESSION['email'] = $novoEmail;
                        $_SESSION['semestre'] = $novoSemestre;
                    }
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
                    $sqlAtualizar = "UPDATE usuarios SET NOME = '$novoNome', EMAIL = '$novoEmail',
                    SEMESTRE = '$novoSemestre' WHERE ID_USUARIO = '$id'";
                    if(mysqli_query($mysqli, $sqlAtualizar)){
                        echo 'Atualizado com sucesso';
                        $_SESSION['nome'] = $novoNome;
                        $_SESSION['email'] = $novoEmail;
                        $_SESSION['semestre'] = $novoSemestre;
                    }
                }
                else {
                    $novoSenha = password_hash($novoSenha, PASSWORD_BCRYPT);
                    $sqlAtualizar = "UPDATE usuarios SET NOME = '$novoNome', EMAIL = '$novoEmail', SENHA = '$novoSenha',
                    SEMESTRE = '$novoSemestre' WHERE ID_USUARIO = '$id'";
                    if(mysqli_query($mysqli, $sqlAtualizar)){
                        echo 'Atualizado com sucesso';
                        $_SESSION['nome'] = $novoNome;
                        $_SESSION['email'] = $novoEmail;
                        $_SESSION['semestre'] = $novoSemestre;
                    }
                }
            }
        }
    }
    
}
if(isset($_POST['deletarConta'])){
    $id = $_SESSION['id'];
    if($_SESSION['situacao'] == 'Aluno' || $_SESSION['situacao'] == 'Egresso'){
        $sqlExcluirConta = "DELETE FROM usuarios WHERE ID_USUARIO = '$id'";
        $queryExcluirConta = mysqli_query($mysqli, $sqlExcluirConta);
        if($queryExcluirConta){
            echo 'Conta excluida';
            session_destroy();
            header('Location: index.php');
            exit;
        }
    }
    else {
        die("Admin pode excluir conta?");
    }
}
//Botões do post
if(isset($_POST['postEditado'])){
    if($_POST['postEditado'] == ''){
        header('Location: forum.php');
        exit();
    }
    $id = $_POST['postId'];
    $publicacao = $_POST['postEditado'];
    $sqlEditarPost = "UPDATE forum SET PUBLICACAO = '$publicacao', EDITADO = 1 WHERE ID_PUBLICACAO = '$id'";
    $queryEditarPost = mysqli_query($mysqli, $sqlEditarPost);
    if($queryEditarPost){
        echo "Editado";
    }
    else {
        echo "Falha ao editar";
    }
}
if(isset($_POST['postComentar'])){
    if($_POST['postComentar'] == ''){
        header('Location: forum.php');
        exit();
    }
    $idAutor = $_SESSION['id'];
    $situacao = $_SESSION['situacao'];
    $id = $_POST['postId'];
    $comentario = $_POST['postComentar'];
    $sqlComentario = "INSERT INTO comentarios (COMENTARIO, AUTOR, SITUACAO, PUBLICACAO) VALUES ('$comentario',
    '$idAutor', '$situacao', '$id')";
    $queryComentario = mysqli_query($mysqli, $sqlComentario);
    if($queryComentario){
        $sqlUpdatePost = "UPDATE forum SET COMENTARIOS = COMENTARIOS + 1 WHERE ID_PUBLICACAO = '$id'";
        $queryUpdatePost = mysqli_query($mysqli, $sqlUpdatePost);
        if($queryUpdatePost){
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
    <script src="public/js/lado_esquerdo.js"></script>
    <script src="public/js/forum-botoes.js"></script>
    <link rel="stylesheet" href="./public/css/menu.css">
    <link rel="stylesheet" href="./public/css/global.css">
    <link rel="stylesheet" href="./public/css/grid.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&family=Sen:wght@400;700&display=swap" rel="stylesheet">
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
                <a href="home.php">
                    <img src="./public/assets/logo-fatec.png" alt="logo fatec">
                </a>
            </div>

            <div class="nav-btn">
                <div class="nav-links">
                    <ul>
                        <li class="nav-link" style="--i: .6s">
                            <a href="home.php">VAGAS</a>
                        </li>
                        <li class="nav-link" style="--i: 1.35s">
                            <a href="#">FORUM</a>
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
            <div class="container-perfil-flex">
                <?php
                include_once("lado_esquerdo.php");
                ?>
                
                <div class="lado-direito">
                    <p class="texto-perfil-hidden">Olá <?= $_SESSION['nome'] ?>, seja bem-vindo!</p>
                    <div class="title">
                        <div class="rect"></div> Fórum
                    </div>

                    <div class="center">
                        <form method="post">
                            <div class="postagem-forum">
                                <textarea name="txtaPublicacao" id="" class="input-postagem" placeholder="No que você está pensando?"></textarea>
                                <div class="buttons-forms">
                                    <button type="submit" name="enviar" class="button">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form id="formForum" method="Post">
                        
                        <?php
                        include_once("bdForum.php");
                        ?>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
