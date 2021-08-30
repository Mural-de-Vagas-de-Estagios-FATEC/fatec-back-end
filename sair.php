<?php 
	session_start();
	session_destroy();//desloga o usuário
	header('Location: index.php');//e encaminha para o link do login/cadastro
	exit;
?>