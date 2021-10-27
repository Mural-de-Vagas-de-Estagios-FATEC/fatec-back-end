<?php
include("verificar_login.php");
require_once('bd.php');
if($_SESSION['situacao'] != 'Admin'){
    header('Location: home.php');
}
$cnt = 0;
$infoPesquisa = false;
$j = 0;
$situacao;
$sqlQntd = "SELECT * FROM pendente_usuario";
$queryQntd = mysqli_query($mysqli,$sqlQntd); 

if(mysqli_num_rows($queryQntd) > 0) {
    $infoId = mysqli_fetch_all($queryQntd);
    $cnt = sizeof($infoId);
}
if(isset($_POST['pesquisar'])){
    if($_POST['curso'] == 'Cadastrado'){
        if(!empty($_POST['txtNome'])){
            $nome = $_POST['txtNome'];
            $sqlPesquisa = "SELECT * FROM usuarios WHERE NOME LIKE '%$nome%' AND WHERE SITUACAO = 'Aluno'";
            $queryPesquisa = mysqli_query($mysqli,$sqlPesquisa);
            if($queryPesquisa){
                $infoPesquisa = mysqli_fetch_all($queryPesquisa);
                $j = sizeof($infoPesquisa) - 1;
                $situacao = 'Cadastrado';
            }
        }
        else {
            $sqlPesquisa = 'SELECT * FROM usuarios WHERE SITUACAO = "Aluno"';
            $queryPesquisa = mysqli_query($mysqli,$sqlPesquisa);
            if($queryPesquisa){
                $infoPesquisa = mysqli_fetch_all($queryPesquisa);
                $j = sizeof($infoPesquisa) - 1;
                $situacao = 'Cadastrado';
            }
        }

    } 
    else{
        $nome = $_POST['txtNome'];
        $nomeMae = $_POST['txtNomeMae'];
        $sqlPesquisa = "SELECT * FROM pendente_usuario WHERE NOME  like '%$nome%' AND NOME_MAE like '%$nomeMae%' ORDER BY ID_PEND_USUARIO DESC";
        $queryPesquisa = mysqli_query($mysqli,$sqlPesquisa);
        if($queryPesquisa){
            $infoPesquisa = mysqli_fetch_all($queryPesquisa);
            $j = sizeof($infoPesquisa) - 1;
            $situacao = 'Pendente';
        }

    }
}
if(isset($_POST['aceitar'])){
    $idAceitar = $_POST['aceitar'];
    $sqlAceitar = "INSERT INTO usuarios (NOME, EMAIL, SENHA, CURSO, SEMESTRE, SITUACAO, IMAGEM) SELECT pendente_usuario.NOME, pendente_usuario.EMAIL, pendente_usuario.SENHA, pendente_usuario.CURSO, pendente_usuario.SEMESTRE, 'Aluno', pendente_usuario.IMAGEM FROM pendente_usuario WHERE ID_PEND_USUARIO = '$idAceitar'";
    $queryAceitar = mysqli_query($mysqli,$sqlAceitar);
    if($queryAceitar){
        $sqlExcluir = "DELETE FROM pendente_usuario WHERE ID_PEND_USUARIO = '$idAceitar'";
        $queryExcluir = mysqli_query($mysqli,$sqlExcluir);
        if($queryExcluir){
            $cnt--;
            header('Location: alunos-admin.php');
            exit();
        }
        else{
            die("Erro ao atualizar as tabelas");
        }
    }
    else {
        die("Erro ao aceitar aluno");
    }       
}
    
if(isset($_POST['excluir'])){
    $idExcluir = $_POST['excluir'];
    $sqlImagem = "SELECT IMAGEM FROM pendente_usuario WHERE ID_PEND_USUARIO = '$idExcluir'";
    $queryImagem = mysqli_query($mysqli, $sqlImagem);
    if($queryImagem){
        $infoImagem = mysqli_fetch_row($queryImagem);
        if($infoImagem[0] != 'imagens/imagem-teste.jpg'){
                unlink($infoImagem[0]);
            }
        $sqlExcluir = "DELETE FROM pendente_usuario WHERE ID_PEND_USUARIO = '$idExcluir'";
        $queryExcluir = mysqli_query($mysqli,$sqlExcluir);
        if($queryExcluir){
            $cnt--;
            header('Location: alunos-admin.php');
            exit();
        }
    }
    else{
        die("Erro ao excluir aluno pendente tente novamente");
    }
}
if(isset($_POST['excluirAluno'])){
    $idExcluir = $_POST['excluirAluno'];
    $sqlImagem = "SELECT IMAGEM FROM usuarios WHERE ID_USUARIO = '$idExcluir'";
    $queryImagem = mysqli_query($mysqli, $sqlImagem);
    if($queryImagem){
        $infoImagem = mysqli_fetch_row($queryImagem);
        if($infoImagem[0] != 'imagens/imagem-teste.jpg'){
                unlink($infoImagem[0]);
            }
        $sqlExcluir = "DELETE FROM usuarios WHERE ID_USUARIO = '$idExcluir'";
        $queryExcluir = mysqli_query($mysqli,$sqlExcluir);
        if($queryExcluir){
            header('Location: alunos-admin.php');
            exit();
        }
    }
    else{
        die("Erro ao excluir aluno");
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
    <link rel="stylesheet" href="./public/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&family=Sen:wght@700&display=swap" rel="stylesheet">
    <title>Alunos</title>
</head>

<body>
    <header>
        <div class="container">
            <input type="checkbox" name="" id="check">
            
            <div class="logo-container">
                <img src="./public/assets/logo-fatec.png" alt="logo fatec">
            </div>

            <div class="nav-btn">
                <div class="nav-links">
                    <ul>
                        <li class="nav-link" style="--i: .6s">
                            <a href="home.php">VAGAS</a>
                        </li>
                        <li class="nav-link" style="--i: 1.35s">
                            <a href="forum.php">FORUM</a>
                        </li>
                        <li class="nav-link" style="--i: 1.1s">
                            <a href="#">REGULAMENTO<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="estagio_obrigatorio.php">Estágio Obrigatório</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="dicas_de_curriculo.php" class="last">Dicas de Currículo</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-link" style="--i: 1.1s">
                            <a href="#">PENDENTES<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="#">Alunos</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="egressos-admin.php">Egressos</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="empresas-admin.php" class="last">Empresas</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-link" style="--i: 1.35s">
                            <a href="admin.php">DIVULGAR VAGA</a>
                        </li>
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
            <div class="container-geral-center">
                <div class="notificacao">
                    <p><?= $cnt?> Solicitações pendentes de Cadastro</p>
                </div>
                <div class="title">
                    <div class="rect"></div> Alunos
                </div>
            </div>

            <div class="center">
                <form action="alunos-admin.php" id="formPesquisa" method="Post" class="border center formulario-de-pesquisa">
                    <div class="campo-input">
                        <label for="pesquisar">Aluno</label>
                        <input type="text" name="txtNome" id="pesquisar" class="input" placeholder="Nome do Aluno">
                    </div>
                    <div class="campo-input">
                        <label for="pesquisar">Nome da Mãe</label>
                        <input type="text" name="txtNomeMae" id="pesquisar" class="input" placeholder="Nome da Mãe">
                    </div>
                    <div class="campo-input">
                        <label for="situacao">Situação</label>
                        <select class="input border" aria-label="Default select example" id="situacao" name="curso">
                            <option selected>Selecione uma situação</option>
                            <option value="Pendente">Pendente</option>
                            <option value="Cadastrado">Cadastrado</option>
                        </select>
                    </div>
                    <div class="center">
                        <button type="submit" form="formPesquisa" name="pesquisar" class="button-search">Procurar</button>
                    </div>
                </form> 
                <form method="post" id="formAlunos"></form>
                <?php if($infoPesquisa){?>
                    <div class="tabela-alunos">
                    <table>
                         <tr>
                            <th>Nome do Aluno</th>
                            <th><?php
                                if($situacao == 'Cadastrado'){ 
                                    echo'Email';
                                }
                                else { 
                                    echo'Nome da Mãe';
                                }
                            ?></th>
                            <th>CPF</th>
                            <th>Curso</th>
                            <th>Semestre</th>
                            <th>Situação</th>
                            <th></th>
                        </tr>
                        <?php
                            if($situacao == 'Cadastrado'){
                                for ($i=0; $i <= $j ; $j--) { 
                        ?>  
               
                        <tr>
                            <td><?=$infoPesquisa[$j][0]?></td>
                            <td><?=$infoPesquisa[$j][1]?></td>
                            <td>00000000000</td>
                            <td><?=$infoPesquisa[$j][3]?></td>
                            <td><?=$infoPesquisa[$j][4]?></td>
                            <td>Cadastrado</td>
                            <td class="botoes-vagas">
                                <button type="submit" name="excluirAluno" value="<?=$infoPesquisa[$j][6]?>" form="formAlunos" class="button-vagas">Excluir</button>
                            </td>
                        </tr>
                        <?php
                                }
                            }
                        else{
                                for ($i=0; $i <= $j ; $j--) { 
                        ?>
                            <tr>
                            <td><?=$infoPesquisa[$j][0]?></td>
                            <td><?=$infoPesquisa[$j][6]?></td>
                            <td>00000000000</td>
                            <td><?=$infoPesquisa[$j][3]?></td>
                            <td><?=$infoPesquisa[$j][4]?></td>
                            <td>Pendente</td>
                            <td class="botoes-vagas">
                                <button type="submit" name="aceitar" value="<?=$infoPesquisa[$j][7]?>" form="formAlunos" class="button-vagas">Aceitar</button>
                                <button type="submit" name="excluir" value="<?=$infoPesquisa[$j][7]?>" form="formAlunos" class="button-vagas">Excluir</button>
                            </td>
                        </tr>
                        <?php
                                } 
                            }?>
                    </table>
                    </div>
                <?php }?>
            </div>
             <?php require('bdAlunos-admin.php') ?>
        </section>
    </main>
</body>

</html>
