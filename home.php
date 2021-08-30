<?php
session_start();
if(!isset($_SESSION['nome']) || empty($_SESSION['nome'])){//se não estiver logado, volta para a tela de login/cadastro
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Página inicial</title>
	</head>
	<body>
		<?php echo '<a href=' . '"perfil.php"' . '><div><img src="perfil.png" height="100px" width="100px"><br>Olá ' .
		$_SESSION['nome'] . '<div></a>'; ?>
	<a href="sair.php">Logout</a>
	</body>
</html>