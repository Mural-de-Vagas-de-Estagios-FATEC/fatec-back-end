<?php
require_once("bd.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sqlVerificar = "SELECT * FROM recuperar WHERE ID_RECUPERAR=$id"; 
    $queryVerificar = mysqli_query($mysqli,$sqlVerificar);
    if($queryVerificar){
        global $infoVerificar;
        $infoVerificar = mysqli_fetch_row($queryVerificar);
        if(!(password_verify($_GET['codigo'], $infoVerificar[2]))){
            header("Location: index.php");
            exit();
        }
    }
    else{
        header("Location: index.php");
        exit();
    }
}
else {
    header("Location: index.php");
    exit();
}
if(isset($_POST['enviarSenha'])){
    if($infoVerificar[1] == 'Aluno'){
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        $sqlUpdate = "UPDATE usuários SET SENHA='$senha' WHERE ID_USUARIO= " . $infoVerificar[0];
        $queryUpdate = mysqli_query($mysqli,$sqlUpdate);
        if($queryUpdate){
            $sqlExcluir = "DELETE FROM recuperar WHERE ID_USER=" . $infoVerificar[0];
            $queryExcluir = mysqli_query($mysqli,$sqlExcluir);
            if($queryExcluir){
                header("Location: index.php");
                exit();
            }
            else {
                echo 'Erro ao atualizar senha tente novamente!';
            }
        }
        else {
            echo 'Erro ao atualizar senha tente novamente!';
        }
    }
    elseif($infoVerificar[1] == 'Egresso'){
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        $sqlUpdate = "UPDATE egresso SET SENHA='$senha' WHERE ID_EGRESSO= " . $infoVerificar[0];
        $queryUpdate = mysqli_query($mysqli,$sqlUpdate);
        if($queryUpdate){
            $sqlExcluir = "DELETE FROM recuperar WHERE ID_USER=" . $infoVerificar[0];
            $queryExcluir = mysqli_query($mysqli,$sqlExcluir);
            if($queryExcluir){
                header("Location: index.php");
                exit();
            }
            else {
                echo 'Erro ao atualizar senha tente novamente!';
            }
            
        }
        else {
            echo 'Erro ao atualizar senha tente novamente!';
        }
    }
    elseif($infoVerificar[1] == 'Empresa'){
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        $sqlUpdate = "UPDATE empresa SET SENHA='$senha' WHERE ID_EMPRESA= " . $infoVerificar[0];
        $queryUpdate = mysqli_query($mysqli,$sqlUpdate);
        if($queryUpdate){
            $sqlExcluir = "DELETE FROM recuperar WHERE ID_USER=" . $infoVerificar[0];
            $queryExcluir = mysqli_query($mysqli,$sqlExcluir);
            if($queryExcluir){
                header("Location: index.php");
                exit();
            }
            else {
                echo 'Erro ao atualizar senha tente novamente!';
            }
            
        }
        else {
            echo 'Erro ao atualizar senha tente novamente!';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./public/css/global.css">
    <link rel="stylesheet" href="./public/css/novasenha.css">
    <script src="https://kit.fontawesome.com/ac3cf98fe0.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&family=Sen:wght@700&display=swap" rel="stylesheet">
    <script src="./public/js/validacao.js"></script>
    <script type="text/javascript">
        function validarSenha(){


            var senha = formsenha.senha.value;
            var confirmarsenha = formsenha.confirmarsenha.value;
                        
            if(senha == "" || senha.length <= 5){
                alert('Preencha o campo senha com minimo 6 caracteres');
                formsenha.senha.focus();
                return false;
            }
                        
            if (senha != confirmarsenha) {
                alert('Senhas diferentes');
                formsenha.senha.focus();
                return false;
            }
        }
    </script>

    <title>Nova senha</title>
</head>
<body>
<div class="container">
    <nav>
        <a href="index.php">
            <img src="./public/assets/logo_fatec.jpeg" alt="Logo Fatec de itaquaquecetuba" class="img_logo">
        </a>
        <a href="index.php" class="home">Home</a>
    </nav>

    <div class="containercentral">



        <div class="definirsenha">

                <figure class="cadeado">
                    <img src="./public/assets/cadeado.png" width="130px" alt="">
                </figure>

                <p>Redefinir Senha</p>
                
                <form name="formsenha" id="formsenha" method="POST">
                    <h5>Nova Senha</h5>
                    <input  type="password" name="senha" id="senha" placeholder="••••••••••" class="input">
                    <h5>Confirme a Senha</h5>
                    <input type="password" name="confirmarsenha" id="confirmarsenha" placeholder="••••••••••" class="input">
                </form>
                <button type = "submit" form="formsenha" name="enviarSenha" class="confirmar" onclick= "return validarSenha()">Confirmar</button>

        </div>        
    </div>
</div>
</div>
<footer>
    <p>© Todos os direitos Reservados - <a href="#" class="fatecitaqua">Fatec Itaquaquecetuba</a></p>
    <div class="social-icon">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin"></i></a>
    </div>
</footer>
</body>
</html>
