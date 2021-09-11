<?php
require_once("bd.php");
require_once("verificar_login.php");
if(isset($_POST['excluir'])){
    $idExcluir = $_POST['excluir'];
    $sqlExcluir = "DELETE FROM FORUM WHERE ID_PUBLICACAO=$idExcluir";
    $queryExcluir = mysqli_query($mysqli,$sqlExcluir);
    header("forum.php");
}
if(isset($_POST['enviar'])){
	$autor = $_SESSION['id'];
	$publicacao = $_POST['txtaPublicacao'];

	$sqlPublicar = "INSERT INTO FORUM (AUTOR, PUBLICACAO, COMENTARIOS) VALUES ('$autor', '$publicacao','null')";
	if(mysqli_query($mysqli,$sqlPublicar)){
		header("Location: forum.php");//redireciona o usuário para a página principal
	    exit();
	}
	else {
		die("Erro no envio da publicação");
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
