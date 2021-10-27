<?php
include("verificar_login.php");
require_once('bd.php');
if($_SESSION['situacao'] != 'Admin'){
    header('Location: home.php');
}
$infoPesquisa = false;
$j = 0;
if(isset($_POST['publicar'])){
    $nomeEmpresa = $_POST['txtNomeEmpresa'];
    $nomeVaga = $_POST['txtNomeVaga'];
    $regime = $_POST['txtRegime'];
    $curso = $_POST['curso'];
    $qntd = $_POST['nmbrQntd'];
    $cidade = $_POST['txtCidade'];
    $telefone = $_POST['txtTelefone'];
    if($_FILES['imagem']['size'] != 0){
        $extensao = strtolower(substr($_FILES['imagem']['name'],-4));
        $imagem = 'vagas/' . md5(time()) . $extensao;
    }
    else {
        $imagem = '';
    }
    $perfil = $_POST['txtaPerfil'];
    $data = date('YmdHi');
    $autor = $_SESSION['id'];

    $sql = "INSERT INTO VAGAS_ADMIN (NOME_EMPRESA, NOME_VAGA, REGIME, CURSO, QUANTIDADE, CIDADE, TELEFONE, IMAGEM, PERFIL, DATA, AUTOR) VALUES ('$nomeEmpresa', '$nomeVaga', '$regime', '$curso', '$qntd', '$cidade', '$telefone', '$imagem', '$perfil', '$data', '$autor')";
    $querySql = mysqli_query($mysqli,$sql);
    if($querySql){
        echo 'Enviado para o banco de dados';
        if($imagem != ''){
            move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem);
        }
    }
    else{
        echo 'Erro';
    }
}
if(isset($_POST['pesquisar'])){
    $nomePesquisa = $_POST['pesquisaEmpresa'];
    $sqlPesquisa = "SELECT * FROM VAGAS_ADMIN WHERE NOME_EMPRESA LIKE '%$nomePesquisa%'";
    $queryPesquisa = mysqli_query($mysqli,$sqlPesquisa);
    if($queryPesquisa){
        $infoPesquisa = mysqli_fetch_all($queryPesquisa);
        $j = sizeof($infoPesquisa) - 1;
    }
} 

if(isset($_POST['excluir'])){
    $idExcluir = $_POST['excluir'];
    $sqlImagem = "SELECT IMAGEM FROM VAGAS_ADMIN WHERE ID_VAGAS_ADMIN = '$idExcluir'";
    $queryImagem = mysqli_query($mysqli, $sqlImagem);
    if($queryImagem){
        $infoImagem = mysqli_fetch_row($queryImagem);
        if($infoImagem[0] != ''){
                unlink($infoImagem[0]);
            }
        $sqlExcluir = "DELETE FROM VAGAS_ADMIN WHERE ID_VAGAS_ADMIN = '$idExcluir'";
        $queryExcluir = mysqli_query($mysqli, $sqlExcluir);
        if($queryExcluir){
            echo 'Excluido';
        }
    }
}
if(isset($_POST['editar'])){
    $idEditar = $_POST['editar'];
    $editarNomeEmpresa = $_POST['nomeEmpresa' . $idEditar];
    $editarNomeVaga = $_POST['nomeVaga' . $idEditar];
    $editarRegime = $_POST['regime' . $idEditar];
    $editarCurso = $_POST['curso' . $idEditar];
    $editarQntd = $_POST['qntd' . $idEditar];
    $editarCidade = $_POST['cidade' . $idEditar];
    $editarTelefone = $_POST['telefone' . $idEditar];
    if($_FILES['imagem' . $idEditar]['size'] != 0){
        $extensao = strtolower(substr($_FILES['imagem' . $idEditar]['name'],-4));
        $editarImagem = 'vagas/' . md5(time()) . $extensao;
        move_uploaded_file($_FILES['imagem' . $idEditar]['tmp_name'], $editarImagem);
        $sqlImagem = "SELECT IMAGEM FROM VAGAS_ADMIN WHERE ID_VAGAS_ADMIN = '$idEditar'";
        $queryImagem = mysqli_query($mysqli, $sqlImagem);
        if($queryImagem){
            $infoImagem = mysqli_fetch_row($queryImagem);
            unlink($infoImagem[0]);
            $sqlNovaImagem = "UPDATE VAGAS_ADMIN SET IMAGEM = '$editarImagem'";
            $queryNovaImagem = mysqli_query($mysqli, $sqlNovaImagem);
        }
    }
    $editarPerfil = $_POST['perfil' . $idEditar];
    $sqlEditar = "UPDATE VAGAS_ADMIN SET NOME_EMPRESA = '$editarNomeEmpresa', NOME_VAGA = '$editarNomeVaga', REGIME = 
    '$editarRegime', CURSO = '$editarCurso', QUANTIDADE = '$editarQntd', CIDADE = '$editarCidade', TELEFONE = '$editarTelefone', PERFIL = '$editarPerfil'";
    $queryEditar = mysqli_query($mysqli, $sqlEditar);
    if($queryEditar){
        echo 'Editado';
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
    <link rel="stylesheet" href="./public/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&family=Sen:wght@700&display=swap" rel="stylesheet">
    <script>
        var loadFile = function(event) {
    var output = document.getElementById('imgVaga');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.value = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src);
      URL.revokeObjectURL(output.value);
    }
  };
    </script>
    <title>Área de Vagas</title>
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
                                            <a href="alunos-admin.php">Alunos</a>
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
                            <a href="#">DIVULGAR VAGA</a>
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
                <div class="title">
                    <div class="rect"></div> Divulgar Vagas
                </div>

                <div class="formulario-divulgar-vaga">
                    <form action="admin.php" method="post" enctype="multipart/form-data">
                        <table class="border-table">
                            <tr>
                                <td colspan="2">
                                    <label for="nome-da-empresa">Nome da Empresa</label>
                                    <br><input type="text" name="txtNomeEmpresa" id="nome-da-empresa" class="input">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label for="nome-da-vaga">Nome da Vaga</label>
                                    <br><input type="text" name="txtNomeVaga" id="nome-da-vaga" class="input">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label for="horario">Regime do Estágio (Horário e dias da Semana)</label>
                                    <br><input type="text" name="txtRegime" id="horario" class="input">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="select-curso">Curso de Interesse</label>
                                    <br><select class="input" aria-label="Default select example" id="select-curso" name="curso"></select>
                                </td>
                                <td>
                                    <label for="">Quantidade de Vagas</label>
                                    <div class="quantidade">
                                        <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                        <input type="number" id="number" value="1" name="nmbrQntd" />
                                        <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label for="cidade">Cidade</label>
                                    <br><input type="text" name="txtCidade" id="cidade" class="input">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label for="telefone">Telefone</label>
                                    <br><input type="text" name="txtTelefone" id="telefone" class="input">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label for="imagem">Imagem</label><br>
                                    <label class="input-upload center">
                                        <input type="file" name="imagem" id=""> <!-- ENTRADA DE IMAGEM -->
                                        ESCOLHER IMAGEM
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label for="">Perfil da Vaga</label><br>
                                    <textarea name="txtaPerfil" id="" class="input" placeholder="Descreva sobre o perfil da vaga."></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="buttons-forms center">
                                        <button type="submit" name="publicar" class="button">Publicar</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form> 
                </div>

                <div class="title">
                    <div class="rect"></div> Vagas Divulgadas
                </div>
                <form action="admin.php" method="post" id="formPesquisa"></form>
                <div class="center">
                    <div class="pesquisar-empresas">
                        <label for="pesquisar">Empresa</label>
                        <input type="text" name="pesquisaEmpresa" form="formPesquisa" id="pesquisar" class="input" placeholder="Nome da Empresa">
                        <button type="submit" name="pesquisar" form="formPesquisa">Procurar</button>
                    </div>
                    <div class="input-categoria">
                        <select class="input" aria-label="Default select example" id="select-curso" name="curso">
                            <option value="todas as vagas">Todas as Vagas</option>
                            <option value="gestão comercial">Gestão Comercial</option>
                            <option value="gestão da T.I">Gestão da T.I</option>
                            <option value="secretariado">Secretariado</option>
                            <option value="gestão empresarial">EAD - Gestão Empresarial</option>
                        </select>
                    </div>
                </div>
                <?php if($infoPesquisa){
                        for ($i=0; $i <= $j ; $j--) { 
                ?>
                    <div class="vaga-empresa">
                        <form method="post" enctype="multipart/form-data">
                            <div class="tabela">
                                <table>
                                    <tr>
                                        <th>Empresa</th>
                                        <th>Vaga</th>
                                        <th>Regime de Estágio</th>
                                        <th>Qts Vagas</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="nomeEmpresa<?=$infoPesquisa[$j][12]?>" value="<?=$infoPesquisa[$j][0]?>" class="input"></td>
                                        <td><input type="text" name="nomeVaga<?=$infoPesquisa[$j][12]?>" value="<?=$infoPesquisa[$j][1]?>" class="input"></td>
                                        <td><input type="text" name="regime<?=$infoPesquisa[$j][12]?>" value="<?=$infoPesquisa[$j][2]?>" class="input"></td>
                                        <td><input type="text" name="qntd<?=$infoPesquisa[$j][12]?>" value="<?=$infoPesquisa[$j][4]?>" class="input"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Cidade</th>
                                        <th colspan="2">Telefone</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="text" name="cidade<?=$infoPesquisa[$j][12]?>" value="<?=$infoPesquisa[$j][5]?>" class="input"></td>
                                        <td colspan="2"><input type="text" name="telefone<?=$infoPesquisa[$j][12]?>" value="<?=$infoPesquisa[$j][6]?>" class="input"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="1">Curso de destino</th>
                                        <th colspan="3">Requisitos da Vaga</th>
                                    </tr>
                                    <tr>
                                        <td colspan="1"><input type="text" name="curso<?=$infoPesquisa[$j][12]?>" value="<?=$infoPesquisa[$j][3]?>" class="input"></td>
                                        <td colspan="3"><textarea name="perfil<?=$infoPesquisa[$j][12]?>" class="input-requisito"><?=$infoPesquisa[$j][8]?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Imagem</th>
                                        <th colspan="1">Trocar Imagem</th>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <?php if(substr($infoPesquisa[$j][7], -3) == 'jpg' || substr($infoPesquisa[$j][7], -3) == 'png'){?>
                                                <img src="<?=$infoPesquisa[$j][7]?>" alt="" id="imgVaga" width="100px" height="100px">
                                            <?php }?>
                                                
                                            
                                        </td>
                                        <td colspan="1">
                                            <label class="input-upload center">
                                                <input type="file" name="imagem<?=$infoPesquisa[$j][12]?>" onchange="loadFile(event)" id="btnImagem">
                                                Trocar Imagem/Arquivo
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="botoes-vagas">
                                <button class="button-vagas" name="editar" value="<?=$infoPesquisa[$j][12]?>">Editar</button>
                                <button class="button-vagas" name="excluir" value="<?=$infoPesquisa[$j][12]?>">Excluir</button>
                            </div>
                        </form>
                    </div>
                <?php }
                }?>
                <div class="center">
                <?php require_once('bdAdmin.php'); ?>
                </div>
            </div>
        </section>
    </main>
    <script src="./public/js/divulgar-vagas.js"></script>
</body>

</html>
