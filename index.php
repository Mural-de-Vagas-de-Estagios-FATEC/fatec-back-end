<?php 
include('bd.php');//Inclue a conexão com o banco de dados
session_start();//Inicia a sessão do usuário podendo logar ele
if(isset($_SESSION['nome'])){//se estiver logado, encaminha para a tela de home
    header("Location: home.php");
}
if(isset($_POST['confirmar'])){//se o confirmar for pressionado
    $email = $_POST['login'];//cria uma variavel para o email tirando do form txtEmail
    $senha = $_POST['password'];
    if(true){
        $sql = "SELECT * FROM admin WHERE EMAIL = '$email'";
        $query = mysqli_query($mysqli,$sql);
        if(mysqli_num_rows($query)){
            $infoAdmin = mysqli_fetch_row($query);
            $senhaBD = $infoAdmin[2];
            if(password_verify($senha, $senhaBD)){
                $_SESSION['nome'] = $infoAdmin[0];
                $_SESSION['email'] = $infoAdmin[1];
                $_SESSION['situacao'] = 'Admin';
                $_SESSION['imagem'] = $infoAdmin[3];
                $_SESSION['id'] = $infoAdmin[4];
                header("Location: home.php");
                exit();
            }
            else {
                echo 'Senha Incorreta';
                exit();
            }
        }
    }
    if(true){//executa primeiro a busca dos alunos (evitar lentidão rodando 3 querys antes de procurar)
        $sql = "SELECT * FROM usuarios WHERE EMAIL='$email'";
        $query = mysqli_query($mysqli,$sql);/*realiza o comando SQL, a variavel $mysqli
        está no arquivo do banco de dados*/
        if(mysqli_num_rows($query)){//se tiver alguma linha com a pesquisa efetuada retorna verdadeiro
            $infoUsuario = mysqli_fetch_row($query);
            $senhaBD = $infoUsuario[2];
            if(password_verify($senha, $senhaBD)){
                $_SESSION['nome'] = $infoUsuario[0];
                $_SESSION['email'] = $infoUsuario[1];
                $_SESSION['curso'] = $infoUsuario[3];
                $_SESSION['semestre'] = $infoUsuario[4];
                $_SESSION['situacao'] = $infoUsuario[5];
                $_SESSION['imagem'] = $infoUsuario[6];
                $_SESSION['id']= $infoUsuario[7];
                header("Location: home.php");
                exit(); 
                }
            else {// se não tiver linha com a pesquisa retorna senha ou email incorreto
                echo 'Senha Incorreta';
                exit();
            }
        }
    }
    if(true){
        $sqlEmpresa = "SELECT * FROM empresa WHERE EMAIL='$email'";
        $queryEmpresa = mysqli_query($mysqli,$sqlEmpresa);
        if (mysqli_num_rows($queryEmpresa)){
            $infoEmpresa = mysqli_fetch_row($queryEmpresa);
            $senhaBD = $infoEmpresa[3];
            if(password_verify($senha, $senhaBD)){

                $_SESSION['nome'] = $infoEmpresa[0];
                $_SESSION['email'] = $infoEmpresa[1];
                $_SESSION['cidade'] = $infoEmpresa[2];
                $_SESSION['cnpj'] = $infoEmpresa[4];
                $_SESSION['telefone'] = $infoEmpresa[5];
                $_SESSION['celular'] = $infoEmpresa[6];
                $_SESSION['imagem'] = $infoEmpresa[7];
                $_SESSION['id'] = $infoEmpresa[8];
                $_SESSION['situacao'] = "Empresa";
                header("Location: inicio.php");
                exit();
            }
            else {
                echo 'Senha Incorreta';
                exit();
            }
        }
    }
    else {
         echo 'Email não registrado ou em espera de avaliação!';
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
    <link rel="stylesheet" href="./public/css/index.css">
    <script src="https://kit.fontawesome.com/ac3cf98fe0.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&family=Sen:wght@700&display=swap" rel="stylesheet">

    <title>Home</title>
</head>
<body>
    <div class="container">
        <div class="grid-area-login center">
            <div class="container-login">
                <div id="logo-fatec">
                    <img src="./public/assets/logo-fatec.png" alt="logo" width="120">
                </div>
                <h3 class="login-h3">Login</h3>
                <form id="formLogin" action="index.php" method="post" enctype="multipart/form-data">
                    <input type="email" name="login" id="login-input" placeholder="example@gmail.com" class="input">
                    <input type="password" name="password" id="password-input" placeholder="••••••••••" class="input">
                    <div class="buttons-forms">
                        <button type="submit" name="confirmar" class="button">ENTRAR</button>
                        <a href="recuperar_senha.php">Esqueci minha Senha</a>
                    </div>
                    <h4>Não possui login? <a href="cadastros.html">Faça já seu cadastro</a> </h4>
                    
                </form>
            </div>
        </div>

        <div class="grid-imagem-login">
            <div></div>
        </div>

        <div class="grid-content">
            <div class="title">
                <div class="rect"></div> Conheça a Plataforma
            </div>
            
            <div class="info">
                <details>
                    <summary> Vagas de estágio para alunos da Fatec Itaquá </summary>
                    <p>
                    Na plataforma, como função principal é possível usar um mural de vagas para estágios onde permite que qualquer usuário possa visualizar as vagas com seus dados e requisitos assim permitindo aos alunos que identifiquem vagas com os seus perfis e melhor divulgação das vagas.
                    </p>
                 </details> 
    
                 <details>
                    <summary> Divulgue vagas da sua empresa em nossa plataforma </summary>
                    <p>
                    Para empresas  interessadas em anunciar vagas temos a área de solicitação de cadastro de vaga , é recomendado que a empresa faça o cadastro da conta e entre na página de solicitação de divulgação de vagas para que elas possam aparecer no mural de vagas, é possível também solicitar para a instituição de ensino através de telefone e a própria instituição cadastrará a vaga.
                    </p>
                 </details> 
    
                 <details>
                    <summary> Network entre alunos e ex-alunos da Fatec Itaquá </summary>
                    <p>
                    Para uma melhor interação e compartilhamento de experiencias entre alunos interessados em estágios e os egressos, existe o fórum que permite que a comunicação seja publica e proporciona que pessoas com experiencia na área possam dar conselhos ou apresentar novas oportunidade de crescimento na área.
                    </p>
                 </details>
            </div> 
            <div class="center">
                <a href="cadastros.html" class="button-dark">CADASTRE-SE</a>
            </div>
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
    
</body>
</html>
