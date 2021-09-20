<?php 
include('bd.php');
session_start();
if(isset($_POST['subCadastrar'])){//se o botão de cadastrar for apertado
    $nome = $_POST['txtNome'];
    $email = $_POST['txtEmail'];
    $senha = password_hash($_POST['txtSenha'], PASSWORD_BCRYPT);
    if($_FILES['imagem']['size'] == 0){
        $imagem = 'imagens/imagem-teste.jpg';
    }
    else {
        $extensao = strtolower(substr($_FILES['imagem']['name'],-4));
        $imagem = 'imagens/' . md5(time()) . $extensao;
    }
    

    $sqlEmail = "INSERT INTO admin (NOME, EMAIL, SENHA, IMAGEM) VALUES ('$nome', '$email', '$senha', '$imagem')";
    $queryEmail = mysqli_query($mysqli,$sqlEmail);

        if($queryEmail){//se o banco de dados fizer o registro
            if($imagem != 'imagens/imagem-teste.jpg'){
                move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem);
            }
            header("Location: index.php?login=sim");//redireciona o usuário para a página principal
            exit();
        }
        else {
            die("Não foi registrar no banco de dados, tente novamente mais tarde");
        }
    

}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/cadastro_aluno.css">
    <script>
        var loadFile = function(event) {
    var output = document.getElementById('imgPerfil');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
  };
    </script>
    <title>Cadastro Aluno</title>
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
            <h1>Cadastro Aluno</h1>
        </div>
        <form action="cadastro_admin.php" method="Post" enctype="multipart/form-data">
            <div class="conteudo_cadastro">
                <div class="div1 cadastro_div" >
                    <label for="txtNome">Nome</label>
                    <input class="input" type="text" name="txtNome" id="txtNome">
                </div>
                <div class="div2 cadastro_div">
                    <input type="image" src="public/assets/perfil.png" width="105px" height="105px" alt="" id="imgPerfil">
                    <input type="file" value="Escolher imagem" name="imagem" accept="image/png, image/jpeg" onchange="loadFile(event)" 
                    id="btnImagem">
                </div>
                <div class="div3 cadastro_div">
                     <label for="txtEmail">Email</label>
                    <input  class="input"type="email" name="txtEmail" id="txtEmail">
                </div>
                <div class="div5 cadastro_div">
                    <label for="txtSenha">Senha</label>
                    <input type="password" name="txtSenha" id="txtSenha" class="input">
                 </div>
                <div class="div7 cadastro_div">
                    <label for="txtConfirmaSenha">Confirmar Senha</label>
                    <input type="password" name="txtConfirmaSenha" id="txtConfirmaSenha" class="input"> 
                </div>
            </div>
            <div class="conteudo_botao">
                <input type="submit" name="subCadastrar" value="Cadastrar" class="btn_cadastro">
            </div>
        </form>

    </div>

    <footer>
        <div class="footer_texto">
            <p class="footer-p"> © Todos os direitos Reservados - Fatec Itaquaquecetuba</p>

        </div>
        <div class="footer_redes">
            <img src="public/assets/instagram.png" alt="" class="logo-footer">
            <img src="public/assets/linkedin.png" alt="" class="logo-footer logo-linkedin" >

        </div>
    </footer>
</body>

</html>