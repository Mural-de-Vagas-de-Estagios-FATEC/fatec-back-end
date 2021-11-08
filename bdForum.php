<?php
$sqlForum = "SELECT * FROM forum";
$queryForum = mysqli_query($mysqli,$sqlForum); 

if(mysqli_num_rows($queryForum) > 0) {
    $sqlId = "SELECT ID_PUBLICACAO FROM forum ORDER BY ID_PUBLICACAO";
    $queryId = mysqli_query($mysqli,$sqlId);
    $infoId = mysqli_fetch_all($queryId);
    $j = sizeof($infoId) - 1;
    for ($i=0; $i <= $j; $j--) { 
        $sqlPubli = "SELECT * FROM forum WHERE ID_PUBLICACAO=" . $infoId[$j][0];
        $queryPubli = mysqli_query($mysqli,$sqlPubli);
        $infoForum = mysqli_fetch_row($queryPubli);
        if($infoForum[1] == 'Admin'){
            $sqlAutor = "SELECT NOME, IMAGEM FROM admin LEFT JOIN forum ON forum.AUTOR = admin.ID_admin WHERE ID_PUBLICACAO=" . $infoId[$j][0];
        }
        else{
            $sqlAutor = "SELECT NOME, IMAGEM, usuarios.SITUACAO FROM usuarios LEFT JOIN FORUM ON forum.AUTOR = usuarios.ID_USUARIO WHERE ID_PUBLICACAO=" . $infoId[$j][0];
        }
        $queryAutor = mysqli_query($mysqli,$sqlAutor);
        $infoAutor = mysqli_fetch_row($queryAutor);
        if($infoAutor){
            if(sizeof($infoAutor) < 3){
                array_push($infoAutor,'Admin');
            }
        }

?>
<div class="center">
    <div class="postagem-forum">
        <div class="grid-postagem">
            <div class="img-postagem">
                <div class="imagem-perfil center">
                    <img src="<?php 
                if($infoAutor){echo $infoAutor[1];} else{echo 'imagens/imagem-teste.jpg';}?>" alt="imagem da empresa" width="100px" height="100px">
                </div>
                <p id="" class="nome-postagem"><?php 
                if($infoAutor){echo $infoAutor[0];} else{echo 'DELETADO';}?></p>
                <p id="" class="status-postagem"><?php 
                if($infoAutor){echo $infoAutor[2];} else{echo 'DELETADO';}?></p>
            </div>
            <div class="commentario-postagem">
                <?php
                if($infoForum[3] == 1){
                    echo "(editado)";
                }
                ?>
                <div>
                    <p id="pPostagem<?=$infoForum[5]?>" class="area-de-texto"><?=$infoForum[2]?></p>
                </div>
            </div>
            <div class="elementos-postagem">
                <?php 
                if($_SESSION['id'] == $infoForum[0] && $_SESSION['situacao'] == $infoAutor[2]){
                ?>
                <button type="button" name="editar" id="editar<?= $infoForum[5]?>" value="<?= $infoForum[5]?>" class="link" onclick="editarCampo(<?=$infoForum[5]?>);">
                    <i class="far fa-edit">Editar</i>
                </button>
                <?php 
                }
                ?>
                <?php if($_SESSION['situacao'] == 'Admin' || ($_SESSION['id'] == $infoForum[0] && 
                $_SESSION['situacao'] == $infoAutor[2])) { ?>
                <button type="submit" name="excluir" id="excluir<?= $infoForum[5]?>"value="<?= $infoForum[5]?>" class="link">
                    <i class="far fa-trash-alt">Excluir</i>
                </button>
                <?php
                
                }
                ?>
                <button type="button" class="link" id="comentar<?= $infoForum[5]?>" onclick="comentarPost(<?= $infoForum[5]?>)">
                    <i class="far fa-comment"><?= $infoForum[4] ?></i>
                </button>

            </div>
            <div id="divComentar<?= $infoForum[5]?>" style=""></div>
            <div id="comentarios<?= $infoForum[5]?>" style="display:none;">
                <?php
                    $sqlBuscaComentario = "SELECT * FROM comentarios WHERE PUBLICACAO =" . $infoForum[5];
                    $queryBuscaComentario = mysqli_query($mysqli,$sqlBuscaComentario); 
                    if(mysqli_num_rows($queryBuscaComentario) > 0){   
                        $infoComentario = mysqli_fetch_all($queryBuscaComentario);
                        $n = sizeof($infoComentario) - 1;
                        for ($i=0; $i <= $n; $n--) {
                            if($infoComentario[$n][2] == 'Admin'){
                                $sqlAutorComentario = "SELECT NOME, IMAGEM FROM admin WHERE ID_ADMIN = " . $infoComentario[$n][1];
                            }
                            else{
                                    $sqlAutorComentario = "SELECT NOME, IMAGEM FROM usuarios WHERE ID_USUARIO = " . $infoComentario[$n][1];
                            }
                            $queryAutorComentario = mysqli_query($mysqli,$sqlAutorComentario);
                            $infoAutorComentario = mysqli_fetch_row($queryAutorComentario);
                         
                ?>
                 <div class="center">
                        <div class="">
                            <div class="">
                                <div class="">
                                    <div class="center">
                                        <img src="<?=$infoAutorComentario[1]?>" alt="imagem da empresa" width="50px" height="50px">
                                    </div>
                                    <p id="" class="nome-postagem"><?=$infoAutorComentario[0]?></p>
                                    <p id="" class="status-postagem"><?=$infoComentario[$n][2]?></p>
                                </div>
                                <div class="commentario-postagem">
                                    <div>
                                        <p id= "" class="area-de-texto">
                                            <?=$infoComentario[$n][0]?>
                                        </p>
                                    </div>
                                </div>
                              </div>
                        </div>
                    </div>
                <?php }
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php

    }
}
?>
