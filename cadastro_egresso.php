<?php 
include('bd.php');
session_start();
if(isset($_SESSION['nome'])){//se estiver logado, encaminha para a tela de home
    header("Location: home.php");
}
if(isset($_POST['subCadastrar'])){//se o botão de cadastrar for apertado
    $nome = $_POST['txtNome'];
    $email = $_POST['txtEmail'];
    $senha = password_hash($_POST['txtSenha'], PASSWORD_BCRYPT);
    $confirmarSenha = password_hash($_POST['txtConfirmaSenha'], PASSWORD_BCRYPT);
    $curso = $_POST['cboCurso'];
    $cpf = $_POST['txtCpf'];
    if($_FILES['imagem']['size'] == 0){
        $imagem = 'imagens/imagem-teste.jpg';
    }
    else {
        $extensao = strtolower(substr($_FILES['imagem']['name'],-4));
        $imagem = 'imagens/' . md5(time()) . $extensao;
    }

    $sqlEmail = "SELECT * FROM usuários WHERE EMAIL='$email'";
    $queryEmail = mysqli_query($mysqli,$sqlEmail);
    $sqlEmailEgresso = "SELECT * FROM egresso WHERE EMAIL='$email'";
    $queryEmailEgresso = mysqli_query($mysqli,$sqlEmailEgresso);
    $sqlEmailEmpresa = "SELECT * FROM empresa WHERE EMAIL='$email'";
    $queryEmailEmpresa = mysqli_query($mysqli,$sqlEmailEmpresa);
    if(mysqli_num_rows($queryEmail)){//verifica se o Email já está em uso
        echo 'Email Já registrado';   
        }
    elseif(mysqli_num_rows($queryEmailEgresso)){//verifica se o Email já está em uso no banco de dados do egresso
        echo 'Email Já registrado';   
        }
    elseif(mysqli_num_rows($queryEmailEmpresa)){//verifica se o Email já está em uso no banco de dados da empresa (pois é)
        echo 'Email Já registrado';   
        }       
    //criar uma área para verificar a senha e para O Código
    else{//se todos os campos forem preenchidos
        $sql_code = "INSERT INTO egresso (NOME, EMAIL, SENHA, CURSO, CPF, IMAGEM) VALUES('$nome','$email', '$senha', '$curso', '$cpf', '$imagem')";//código SQL para inserir os dados
            
        if(mysqli_query($mysqli,$sql_code)){//se o banco de dados fizer o registro
            if($imagem != 'imagens/imagem-teste.jpg'){
                move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem);
            }
            header("Location: index.php");//redireciona o usuário para a página principal
            exit();
        }
        else {
            echo "Erro";
            die("Não foi registrar no banco de dados, tente novamente mais tarde");
        }
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
    <title>Cadastro Egresso</title>
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
            <h1>Cadastro Ex-Aluno</h1>
        </div>
        <form action="cadastro_egresso.php" id="formEgresso" method="Post" enctype="multipart/form-data">
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
            <div class="div4 cadastro_div">
                <label for="cboCurso">Curso</label>
                <select id="cboCurso" name="cboCurso" class="cbo">
                    <option>GTI</option>
                    <option>Secretariado</option>
                    <option>Gestão Comercial</option>
                    <option>Gestão Empresarial</option>
                </select>
            </div>
            <div class="div5 cadastro_div">
                <label for="txtSenha">Senha</label>
                <input type="password" name="txtSenha" id="txtSenha" class="input">
             </div>
            <div class="div7 cadastro_div">
                <label for="txtConfirmaSenha">Confirmar Senha</label>
                <input type="password" name="txtConfirmaSenha" id="txtConfirmaSenha" class="input"> 
            </div>


            <div class="div6 cadastro_div">
                <label for="txtCpf">CPF</label>
                <input type="text" name="txtCpf" id="txtCpf" class="input">
            </div>

        </div>
        </form>

    </div>
    <div class="conteudo_botao">
        <input type="submit" name="subCadastrar" form="formEgresso" class="btn_cadastro" value = "Cadastrar" >
    </div>

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