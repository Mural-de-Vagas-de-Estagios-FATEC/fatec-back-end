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

	$sqlEmail = "SELECT * FROM exalunos WHERE EMAIL='$email'";
	$queryEmail = mysqli_query($mysqli,$sqlEmail);

	if(mysqli_num_rows($queryEmail)){//verifica se o RA já está em uso
	   	echo 'Email Já registrado';   
	    }	    
	//criar uma área para verificar a senha e para O Código
	else{//se todos os campos forem preenchidos
	    $sql_code = "INSERT INTO exalunos (NOME, EMAIL, SENHA, CURSO, CPF) VALUES('$nome','$email', '$senha', '$confirmarSenha' '$curso', '$cpf')";//código SQL para inserir os dados
		    
	    if(mysqli_query($mysqli,$sql_code)){//se o banco de dados fizer o registro
			//$_SESSION['RA'] = $RA;// RA removido até o momento
	    	$_SESSION['nome'] = $nome;
	    	$_SESSION['email'] = $email;
	    	$_SESSION['curso'] = $curso;
	    	$_SESSION['cpf'] = $cpf;
			header("Location: home.php");//redireciona o usuário para a página principal
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
    <title>Cadastro Ex-Aluno</title>
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
            <h1>Cadastro Ex-Aluno</h1>
        </div>
        <div class="conteudo_cadastro">
            <div class="div1 cadastro_div" >
                <label for="txtNome">Nome</label>
                <input class="input" type="text" name="txtNome" id="txtNome">
            </div>

            <div class="div2 cadastro_div">
                <input type="image" src="public/assets/perfil.png" alt="" id="imgPerfil">
                <input type="button" value="Escolher imagem" id="btnImagem">
            </div>

            <div class="div3 cadastro_div">
                 <label for="txtEmail">Email</label>
                <input  class="input"type="email" name="txtEmail" id="txtEmail">
            </div>
            <div class="div4 cadastro_div">
                <label for="cboCurso">Curso</label>
                <select id="cboCurso" name="cboCurso" class="cbo">
                    <option>GTI</option>
                </select>
            </div>
            <div class="div5 cadastro_div">
                <label for="txtSenha">Senha</label>
                <input type="password" name="txtSenha" id="txtSenha" class="input">
             </div>
             <!-- <div class="div6 cadastro_div">
                <label for="cboSemestre">Semestre</label>
                <select id="cboSemestre" name="cboSemestre" class="cbo">
                    <option>5º Semestre</option>
                </select>
            </div> -->
            <div class="div7 cadastro_div">
                <label for="txtConfirmaSenha">Confirmar Senha</label>
                <input type="password" name="txtConfirmaSenha" id="txtConfirmaSenha" class="input"> 
            </div>


            <div class="div6 cadastro_div">
                <label for="txtCpf">CPF</label>
                <input type="text" name="txtCpf" id="txtCpf" class="input">
            </div>

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
            <img src="public/assets/linkedin.png" alt="" class="logo-footer logo-linkedin" >

        </div>
    </footer>
</body>

</html>