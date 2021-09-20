<?php
$sqlForum = "SELECT * FROM FORUM";
$queryForum = mysqli_query($mysqli,$sqlForum); 

if(mysqli_num_rows($queryForum) > 0) {
    $sqlId = "SELECT ID_PUBLICACAO FROM FORUM ORDER BY ID_PUBLICACAO";
    $queryId = mysqli_query($mysqli,$sqlId);
    $infoId = mysqli_fetch_all($queryId);
    $j = sizeof($infoId) - 1;
    for ($i=0; $i <= $j; $j--) { 
        $sqlPubli = "SELECT * FROM FORUM WHERE ID_PUBLICACAO=" . $infoId[$j][0];
        $queryPubli = mysqli_query($mysqli,$sqlPubli);
        $infoForum = mysqli_fetch_row($queryPubli);
        if($infoForum[1] == 'Aluno'){
            $sqlAutor = "SELECT NOME, IMAGEM FROM usuários LEFT JOIN FORUM ON FORUM.AUTOR = usuários.ID_USUARIO WHERE ID_PUBLICACAO=" . $infoId[$j][0];
        }
        elseif($infoForum[1] == 'Egresso') {
            $sqlAutor = "SELECT NOME, IMAGEM FROM egresso LEFT JOIN forum ON forum.AUTOR = egresso.ID_EGRESSO WHERE ID_PUBLICACAO=" . $infoId[$j][0];
        }
        else{
            $sqlAutor = "SELECT NOME, IMAGEM FROM admin LEFT JOIN forum ON forum.AUTOR = admin.ID_admin WHERE ID_PUBLICACAO=" . $infoId[$j][0];
        }
        $queryAutor = mysqli_query($mysqli,$sqlAutor);
        $infoAutor = mysqli_fetch_row($queryAutor);

?>
<div class="center">
    <div class="postagem-forum">
        <div class="grid-postagem">
            <div class="img-postagem">
                <div class="imagem-perfil center">
                    <img src="<?= $infoAutor[1]?>" alt="imagem da empresa" width="100px" height="100px">
                </div>
                <p id="" class="nome-postagem"><?= $infoAutor[0]?></p>
                <p id="" class="status-postagem"><?= $infoForum[1]?></p>
            </div>
            <div class="commentario-postagem">
                <div>
                    <p id= "" class="area-de-texto">
                        <?= $infoForum[2]?> 
                    </p>
                </div>
            </div>
            <div class="elementos-postagem">
                <?php 
                if($_SESSION['id'] == $infoForum[0] && $_SESSION['situacao'] == $infoForum[1]){
                ?>
                <button type="submit" name="editar" value="<?= $infoForum[3]?>" class="link">
                    <i class="far fa-edit">Editar</i>
                </button>
                <?php 
                }
                ?>
                <?php if($_SESSION['situacao'] == 'Admin' || ($_SESSION['id'] == $infoForum[0] && 
                $_SESSION['situacao'] == $infoForum[1])) { ?>
                <button type="submit" name="excluir" value="<?= $infoForum[4]?>" class="link">
                    <i class="far fa-trash-alt">Excluir</i>
                </button>
                <?php
                
                }
                ?>
                <button type="submit" class="link">
                    <i class="far fa-comment"><?= $infoForum[3] ?></i>
                </button>
            </div>
        </div>
    </div>
</div>


<?php
    }
}
?>
