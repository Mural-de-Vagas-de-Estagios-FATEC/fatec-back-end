<?php

$sqlVagas = "SELECT * FROM vagas";
$queryVagas = mysqli_query($mysqli, $sqlVagas);
if(mysqli_num_rows($queryVagas) > 0) {
    $sqlId = "SELECT ID_VAGA, TABELA, DATA FROM vagas 
    UNION
    SELECT ID_VAGAS_ADMIN, TABELA, DATA FROM VAGAS_ADMIN
    ORDER BY DATA";
    $queryId = mysqli_query($mysqli, $sqlId);
    $infoId = mysqli_fetch_all($queryId);
    $j = sizeof($infoId) - 1;
    for ($i=0; $i <= $j ; $j--) {
        if($infoId[$j][1] == 0){
            $sqlPubli = "SELECT admin.NOME, admin.IMAGEM, vagas_admin.NOME_EMPRESA, vagas_admin.NOME_VAGA, vagas_admin.REGIME, vagas_admin.CURSO, vagas_admin.QUANTIDADE, vagas_admin.CIDADE, vagas_admin.TELEFONE, vagas_admin.PERFIL, vagas_admin.IMAGEM, vagas_admin.ID_VAGAS_ADMIN FROM admin INNER JOIN vagas_admin ON admin.ID_ADMIN = vagas_admin.AUTOR WHERE vagas_admin.ID_VAGAS_ADMIN=" . $infoId[$j][0];
            $queryPubli = mysqli_query($mysqli,$sqlPubli);
            $infoVagas = mysqli_fetch_row($queryPubli);


?>

<div class="container-vaga">
                            <div class="dados-da-vaga">
                                <div class="imagem-empresa">
                                    <img src="<?= $infoVagas[1]?>" alt="imagem da empresa" width="100px" height="100px">
                                </div>
                                <div class="informacao-vaga">
                                    <h3><?= $infoVagas[0]?></h3>
                                    <h4>EMPRESA:<?= $infoVagas[2]?></h4>
                                    <h4>Tel:<?= $infoVagas[8]?></h4>
                                </div>
                            </div>
                            <div class="nome-da-vaga center"><?= $infoVagas[3]?></div>
                            <div class="requisitos-vaga">
                                <h4>Perfil da vaga:</h4>
                                <p><?php if($infoVagas[10] != ''){ ?><img src="<?=$infoVagas[10]?>">
                                    <?php }?><?= $infoVagas[9]?> </p>
                            </div>
                    
                            <div class="info-adicionais-sobre-vaga center">
                                <div>
                                    <i class="fas fa-briefcase"></i>
                                    <?= $infoVagas[5] . ' / ' . $infoVagas[6] . ' Vagas'?>
                                </div>
                                <div>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?= $infoVagas[7]?>
                                </div>
                                <div>
                                    <i class="far fa-clock"></i>
                                    <?= $infoVagas[4]?>
                                </div>
                                <?php if($_SESSION['situacao'] == 'Admin') { ?>
                                    <form method="post" id="formExcluir"></form>
                                <button type="submit" name="excluir" form="formExcluir" value="<?= $infoVagas[11]?>" class="link">
                                    <i class="far fa-trash-alt">Excluir</i>
                                </button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
<?php
        }
        else{
            $sqlPubli = "SELECT empresa.NOME, empresa.EMAIL, empresa.TELEFONE, empresa.CELULAR, empresa.CIDADE, empresa.IMAGEM, vagas.NOME_VAGA, vagas.REGIME, vagas.CURSO, vagas.QUANTIDADE, vagas.PERFIL, vagas.ID_VAGA FROM empresa INNER JOIN vagas ON empresa.ID_EMPRESA = vagas.AUTOR WHERE vagas.ID_VAGA=" . $infoId[$j][0];
            $queryPubli = mysqli_query($mysqli,$sqlPubli);
            $infoVagas = mysqli_fetch_row($queryPubli);
        ?>
        <div class="container-vaga">
                            <div class="dados-da-vaga">
                                <div class="imagem-empresa">
                                    <img src="<?= $infoVagas[5]?>" alt="imagem da empresa" width="100px" height="100px">
                                </div>
                                <div class="informacao-vaga">
                                    <h3><?= $infoVagas[0]?></h3>
                                    <h4><?= $infoVagas[1]?></h4>
                                    <h4>Tel:<?= $infoVagas[2]?> / Cel:<?= $infoVagas[3]?></h4>
                                </div>
                            </div>
                            <div class="nome-da-vaga center"><?= $infoVagas[6]?></div>
                            <div class="requisitos-vaga">
                                <h4>Perfil da vaga:</h4>
                                <p><?= $infoVagas[10]?> </p>
                            </div>
                    
                            <div class="info-adicionais-sobre-vaga center">
                                <div>
                                    <i class="fas fa-briefcase"></i>
                                    <?= $infoVagas[8] . ' / ' . $infoVagas[9] . ' Vagas'?>
                                </div>
                                <div>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?= $infoVagas[4]?>
                                </div>
                                <div>
                                    <i class="far fa-clock"></i>
                                    <?= $infoVagas[7]?>
                                </div>
                                <?php if($_SESSION['situacao'] == 'Admin') { ?>
                                    <form method="post" id="formExcluir"></form>
                                <button type="submit" name="excluir" form="formExcluir" value="<?= $infoVagas[11]?>" class="link">
                                    <i class="far fa-trash-alt">Excluir</i>
                                </button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
        }
    }   
}
?>
