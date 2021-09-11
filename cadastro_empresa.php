<?php 
include('bd.php');
session_start();
if(isset($_SESSION['nome'])){//se estiver logado, encaminha para a tela de home
	header("Location: home.php");
}
if(isset($_POST['subCadastrar'])){//se o botão de cadastrar for apertado
	$nome = $_POST['txtNome'];
	$email = $_POST['txtEmail'];
	$cidade = $_POST['cboCidade'];
	$senha = password_hash($_POST['txtSenha'], PASSWORD_BCRYPT);
	$confirmarSenha = password_hash($_POST['txtConfirmaSenha'], PASSWORD_BCRYPT);
	$cnpj = $_POST['txtCnpj'];
	$telefone = $_POST['txtTel'];
	$celular = $_POST['txtCel'];
	

	$sqlEmail = "SELECT * FROM empresas WHERE EMAIL='$email'";
	$queryEmail = mysqli_query($mysqli,$sqlEmail);

	if(mysqli_num_rows($queryEmail)){//verifica se o RA já está em uso
	   	echo 'Email Já registrado';   
	    }	    
	//criar uma área para verificar a senha e para O Código
	else{//se todos os campos forem preenchidos
	    $sql_code = "INSERT INTO empresas (NOME, EMAIL, CIDADE, SENHA, CONFIRMARSENHA, CNPJ, TELEFONE, CELULAR) VALUES('$nome','$email', '$cidade' '$senha', '$confirmarSenha', '$cnpj', '$telefone', '$celular')";//código SQL para inserir os dados
		    
	    if(mysqli_query($mysqli,$sql_code)){//se o banco de dados fizer o registro
	    	$_SESSION['nome'] = $nome;
	    	$_SESSION['email'] = $email;
	    	$_SESSION['cidade'] = $cidade;
	    	$_SESSION['cnpj'] = $cnpj;
			$_SESSION['telefone'] = $telefone;
			$_SESSION['celular'] = $celular
			header("Location: home.php");//redireciona o usuário para a página principal
	        exit();
		}
	    else {
		    echo "Erro";
		    die("Não foi possível registrar no banco de dados, tente novamente mais tarde");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <!-- <script src="public/Jquery/jquery-3.6.0.min.js"></script> -->


    <link rel="stylesheet" href="public/css/cadastro_empresa.css">
    <script src="public/js/cadastro_empresa.js"></script>

    <title>Cadastro Empresa</title>
</head>

<body>
    <nav>
        <img src="public/assets/logo-fatec.png" alt="Logo Fatec de itaquaquecetuba" class="img_logo">
        <a href="index.html">Home</a>
    </nav>
    <div class="conteudo">
        <div class="conteudo_titulo">
            <div class="marcador_vermelho">

            </div>
            <h1>Cadastro Empresa</h1>
        </div>
        <div class="conteudo_cadastro">
            <div class="div1 cadastro_div">
                <label for="txtNome">Nome Empresa</label>
                <input class="input" type="text" name="txtNome" id="txtNome">
            </div>

            <div class="div2 cadastro_div">
                <input type="image" src="public/assets/perfil.png" alt="" id="imgPerfil">
                <input type="button" value="Escolher imagem" id="btnImagem">
            </div>

            <div class="div3 cadastro_div">
                <label for="txtEmail">Email</label>
                <input class="input" type="email" name="txtEmail" id="txtEmail" onblur="validacaoEmail(txtEmail)">
            </div>
            <div class="div4 cadastro_div">
                <label for="cboCidade">Cidade</label>
                <select id="cboCidade" name="cboCidade" class="cbo">
                    <option>Itaquaquecetuba</option>
                </select>
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
            <!-- <div class="termos">
                <label for="checkTermos">Termos</label>
    
                <input type="checkbox" name="checkTermos" id="checkTermos">
            </div> -->
        </div>

    </div>
    <div class="conteudo_botao">
        <input type="submit" name="subCadastrar" class="btn_cadastro" value = "Cadastrar" >
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
</body>


</html>