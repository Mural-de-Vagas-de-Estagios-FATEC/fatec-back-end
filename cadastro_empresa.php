<?php 
include('bd.php');
session_start();
if(isset($_SESSION['nome'])){//se estiver logado, encaminha para a tela de home
    header("Location: home.php");
}
if(isset($_POST['subCadastrar'])){//se o botão de cadastrar for apertado
    $nome = $_POST['txtNome'];
    $email = $_POST['txtEmail'];
    $cidade = $_POST['txtCidade'];
    $senha = password_hash($_POST['txtSenha'], PASSWORD_BCRYPT);
    $cnpj = $_POST['txtCnpj'];
    $telefone = $_POST['txtTel'];
    $celular = $_POST['txtCel'];
    if($_FILES['imagem']['size'] == 0){
        $imagem = 'imagens/imagem-teste.jpg';
    }
    else {
        $extensao = strtolower(substr($_FILES['imagem']['name'],-4));
        $imagem = 'imagens/' . md5(time()) . $extensao;
    }
    
    $sqlEmail = "INSERT INTO pendente_empresa (NOME, EMAIL, CIDADE, SENHA, CNPJ, TELEFONE, CELULAR, IMAGEM)
                SELECT '$nome', '$email', '$cidade', '$senha', '$cnpj', '$telefone', '$celular', '$imagem'
                WHERE 
                    NOT EXISTS ( SELECT EMAIL FROM pendente_empresa WHERE EMAIL = '$email' ) AND
                    NOT EXISTS ( SELECT EMAIL FROM pendente_egresso WHERE EMAIL = '$email' ) AND
                    NOT EXISTS ( SELECT EMAIL FROM pendente_usuario WHERE EMAIL = '$email' ) AND
                    NOT EXISTS ( SELECT EMAIL FROM empresa WHERE EMAIL = '$email' ) AND
                    NOT EXISTS ( SELECT EMAIL FROM usuarios WHERE EMAIL = '$email' )";
    $queryEmail = mysqli_query($mysqli,$sqlEmail);
      
        if($queryEmail){//se o banco de dados fizer o registro
            if($imagem != 'imagens/imagem-teste.jpg'){
                move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem);
            }
            header("Location: cadastrado.php");//redireciona o usuário para a página principal
            exit();
        }
        else {
            die("Não foi possível registrar no banco de dados, tente novamente mais tarde");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <!-- <script src="public/Jquery/jquery-3.6.0.min.js"></script> -->
    <script>
        var loadFile = function(event) {
    var output = document.getElementById('imgPerfil');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
  };
    </script>

    <link rel="stylesheet" href="public/css/cadastro_empresa.css">
    <script src="public/js/cadastro_empresa.js"></script>
    <link rel="stylesheet" href="./public/css/arq_de_mudancas.css">

    <title>Cadastro Empresa</title>
</head>

<body>
    <nav>
        <img src="public/assets/logo-fatec.png" alt="Logo Fatec de itaquaquecetuba" class="img_logo">
        <a href="index.php">Home</a>
    </nav>
    <div class="conteudo">
        <div class="conteudo_titulo">
            <div class="marcador_vermelho">

            </div>
            <h1>Cadastro Empresa</h1>
        </div>
        <form action="cadastro_empresa.php" id="formEmpresa" method="Post" enctype="multipart/form-data">
        <div class="conteudo_cadastro">
            <div class="div1 cadastro_div">
                <label for="txtNome">Nome Empresa</label>
                <input class="input" type="text" name="txtNome" id="txtNome">
            </div>

            <div class="div2 cadastro_div">
                <input type="image" src="public/assets/perfil.png" width="105px" height="105px" alt="" id="imgPerfil">
                <label class="input-upload center">
                    <input type="file"  name="imagem" accept="image/png, image/jpeg" onchange="loadFile(event)" 
                    id="btnImagem">
                    ESCOLHER IMAGEM
                </label>
            </div>

            <div class="div3 cadastro_div">
                <label for="txtEmail">Email</label>
                <input class="input" type="email" name="txtEmail" id="txtEmail" onblur="validacaoEmail(txtEmail)">
            </div>
            <div class="div4 cadastro_div">
                <label for="cboCidade">Cidade</label>
                <input type="input" type="text" name="txtCidade" id="cboCidade" class="input">
            </div>
            <div class="div5 cadastro_div">
                <label for="txtSenha">Senha</label>
                <input type="password" name="txtSenha" id="txtSenha" class="input">
            </div>
            <div class="div6 cadastro_div">
                <label for="txtCnpj">CNPJ</label>
                <input type="text" name="txtCnpj" id="txtCnpj" class="input ">
            </div>
            <div class="div7 cadastro_div">
                <label for="txtConfirmaSenha">Confirmar Senha</label>
                <input type="password" name="txtConfirmaSenha" id="txtConfirmaSenha" class="input">
            </div>


            <div class="div8 cadastro_div">
                <label for="txtTel">Telefone</label>
                <input type="tel" name="txtTel" id="txtTel" class="input">
            </div>


            <div class="div9 ">
                <label for="txtCel">Celular</label>
                <input type="text" name="txtCel" id="txtCel" class="input" data-contato>
            </div>
        </div>
        <div class="center">
                <div class="termos-e-privacidade">
                    <input type="checkbox" name="" id="politicas">
                    <label for="politicas">
                        Eu li e concordo com os <a href="#politica-de-privacidade">Termos de Uso e Política de Privacidade</a>.
                </div>
            </div>
        </form>
    </div>
    <div class="conteudo_botao">
        <input type="submit" name="subCadastrar" form="formEmpresa" class="btn_cadastro" value = "Cadastrar" >
    </div>

    </div>
    <footer>
        <div class="footer_texto">
            <p class="footer-p"> © Todos os direitos Reservados - Fatec Itaquaquecetuba</p>

        </div>
        <div class="footer_redes">
            <img src="public/assets/instagram.png" alt="" class="logo-footer">
            <img src="public/assets/linkedin.png" alt="" class="logo-footer logo-linkedin">

        </div>
    </footer>
    <div class="modal" id="politica-de-privacidade">
        <div>
          <a href="#" class="close">x</a>
          <div id="texto-politica"></div>
        </div>
    </div>
    <script src="./public/js/politica.js"></script>
    <script src="./public/js/mascara_empresa.js"></script>
</body>


</html>
