<?php 
include('bd.php');//Inclue a conexão com o banco de dados
session_start();//Inicia a sessão do usuário podendo logar ele
if(isset($_SESSION['nome'])){//se estiver logado, encaminha para a tela de home
    header("Location: home.php");
}
if(isset($_POST['confirmar'])){//se o confirmar for pressionado
    $email = $_POST['login'];//cria uma variavel para o email tirando do form txtEmail
    $senha = $_POST['password'];
    $sql = "SELECT * FROM usuários WHERE EMAIL='$email'";
    $query = mysqli_query($mysqli,$sql);/*realiza o comando SQL, a variavel $mysqli
    está no arquivo do banco de dados*/
    if(mysqli_num_rows($query)){//se tiver alguma linha com a pesquisa efetuada retorna verdadeiro
        $infoUsuario = mysqli_fetch_row($query);
        $senhaBD = $infoUsuario[2];
        if(password_verify($senha, $senhaBD)){
            //$_SESSION['RA'] = $infoUsuario[0];
            $_SESSION['nome'] = $infoUsuario[0];
            $_SESSION['email'] = $infoUsuario[1];
            $_SESSION['curso'] = $infoUsuario[3];
            $_SESSION['semestre'] = $infoUsuario[4];
            header("Location: home.php");
            exit(); 
            }
        else {// se não tiver linha com a pesquisa retorna senha ou email incorreto
            echo 'Senha Incorreta';
        }

    }
    else {
        echo 'Email Incorreto';
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
                <form id="formLogin" action="index.php" method="Post" enctype="multipart/form-data">
                    <input type="email" name="login" id="login-input" placeholder="example@gmail.com" class="input">
                    <input type="password" name="password" id="password-input" placeholder="••••••••••" class="input">
                    <div class="buttons-forms">
                        <button type="submit" name="confirmar" class="button">ENTRAR</button>
                        <a href="#">Esqueci minha Senha</a>
                    </div>
                    <h4>Não possui login? <a href="#">Faça já seu cadastro</a> </h4>
                    
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
                    Adipisicing cupidatat magna culpa id. Do nostrud ea consectetur officia labore adipisicing dolore adipisicing amet irure. Aliquip cillum esse adipisicing deserunt. Non duis elit tempor in adipisicing est reprehenderit Lorem adipisicing.
                    Adipisicing cupidatat magna culpa id. Do nostrud ea consectetur officia labore adipisicing dolore adipisicing amet irure. Aliquip cillum esse adipisicing deserunt. Non duis elit tempor in adipisicing est reprehenderit Lorem adipisicing.
                    Adipisicing cupidatat magna culpa id. Do nostrud ea consectetur officia labore adipisicing dolore adipisicing amet irure. Aliquip cillum esse adipisicing deserunt. Non duis elit tempor in adipisicing est reprehenderit Lorem adipisicing.
                    </p>
                 </details> 
    
                 <details>
                    <summary> Divulgue vagas da sua empresa em nossa plataforma </summary>
                    <p>
                    Adipisicing cupidatat magna culpa id. Do nostrud ea consectetur officia labore adipisicing dolore adipisicing amet irure. Aliquip cillum esse adipisicing deserunt. Non duis elit tempor in adipisicing est reprehenderit Lorem adipisicing.
                    Adipisicing cupidatat magna culpa id. Do nostrud ea consectetur officia labore adipisicing dolore adipisicing amet irure. Aliquip cillum esse adipisicing deserunt. Non duis elit tempor in adipisicing est reprehenderit Lorem adipisicing.
                    Adipisicing cupidatat magna culpa id. Do nostrud ea consectetur officia labore adipisicing dolore adipisicing amet irure. Aliquip cillum esse adipisicing deserunt. Non duis elit tempor in adipisicing est reprehenderit Lorem adipisicing.
                    </p>
                 </details> 
    
                 <details>
                    <summary> Network entre alunos e ex-alunos da Fatec Itaquá </summary>
                    <p>
                    Adipisicing cupidatat magna culpa id. Do nostrud ea consectetur officia labore adipisicing dolore adipisicing amet irure. Aliquip cillum esse adipisicing deserunt. Non duis elit tempor in adipisicing est reprehenderit Lorem adipisicing.
                    Adipisicing cupidatat magna culpa id. Do nostrud ea consectetur officia labore adipisicing dolore adipisicing amet irure. Aliquip cillum esse adipisicing deserunt. Non duis elit tempor in adipisicing est reprehenderit Lorem adipisicing.
                    Adipisicing cupidatat magna culpa id. Do nostrud ea consectetur officia labore adipisicing dolore adipisicing amet irure. Aliquip cillum esse adipisicing deserunt. Non duis elit tempor in adipisicing est reprehenderit Lorem adipisicing.
                    </p>
                 </details>
            </div> 
            <div class="center">
                <a href="#" class="button-dark">CADASTRE-SE</a>
            </div>
            <footer>
                <p>© Todos os direitos Reservados - <a href="#">Fatec Itaquaquecetuba</a></p>
                <div class="social-icon">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                </div>
            </footer>
        </div>
    </div>
    
</body>
</html>