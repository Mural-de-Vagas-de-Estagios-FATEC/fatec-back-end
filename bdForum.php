<?php
require_once("bd.php");
require_once("verificar_login.php");
$sqlForum = "SELECT * FROM FORUM";
$queryForum = mysqli_query($mysqli,$sqlForum); 

if(mysqli_num_rows($queryForum) > 0) {
    $sqlId = "SELECT ID_PUBLICACAO FROM FORUM";
    $queryId = mysqli_query($mysqli,$sqlId);
    $infoId = mysqli_fetch_all($queryId);

    $j = sizeof($infoId) - 1;
    for ($i=0; $i <= $j; $j--) { 
        $sqlPubli = "SELECT * FROM FORUM WHERE ID_PUBLICACAO=" . $infoId[$j][0];
        $queryPubli = mysqli_query($mysqli,$sqlPubli);
        $infoForum = mysqli_fetch_row($queryPubli);

?>
<div class="center">
    <div class="postagem-forum">
        <div class="grid-postagem">
            <div class="img-postagem">
                <div class="imagem-perfil center">
                    <img src="./public/assets/imagem-teste.jpg" alt="imagem da empresa">
                </div>
                <p id="" class="nome-postagem"><?= $infoForum[1]?></p>
                <p id="" class="status-postagem"><?= $infoForum[2]?></p>
            </div>
            <div class="commentario-postagem">
                <div>
                    <p id= "" class="area-de-texto">
                        <?= $infoForum[3]?> 
                    </p>
                </div>
            </div>
            <div class="elementos-postagem">
                <?php 
                if($_SESSION['email'] == $infoForum[0]){
                ?>
                <button type="button" name="editar" onclick="">
                    <i class="far fa-edit">Editar</i>
                </button>
                <?php if('adicionar situação no session' == 'admin' || $_SESSION['email'] == $infoForum[0]) { ?>
                <button type="submit" name="excluir" value="<?= $infoForum[5]?>">
                    <i class="far fa-trash-alt">Excluir</i>
                </button>
                <?php
                    }
                }
                ?>
                <button type="submit">
                    <i class="far fa-comment"><?= $infoForum[4] ?></i>
                </button>
            </div>
        </div>
    </div>
</div>


<?php
    }
}
?>