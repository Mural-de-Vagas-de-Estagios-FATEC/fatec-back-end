<?php
include("bd.php");
session_start();
if(!isset($_SESSION['nome']) || empty($_SESSION['nome'])){
header('index.php');
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Perfil</title>
</head>
<body>
	<?php 
	echo 'Nome: ' . $_SESSION['nome'] . '<br>' . 'Email: ' . $_SESSION['email'] ./* '<br>' . 'RA: ' . $_SESSION['RA'] */ 
	'<br>' . 'Curso: ' . $_SESSION['curso'] . '<br>' . 'Semestre: ' . $_SESSION['semestre'] . '<br>';
	?>
	<a href="home.php">Inicio</a>
	<a href="sair.php">Logout</a>
</body>
</html>