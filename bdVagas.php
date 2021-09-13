<?php

$sqlVagas = "SELECT * FROM vagas ORDER BY ID_VAGA";
$queryVagas = mysqli_query($mysqli, $sqlVagas);
if(mysqli_num_rows($queryVagas) > 0) {
    $sqlId = "SELECT ID_VAGA FROM vagas";
    $queryId = mysqli_query($mysqli, $sqlId);
    $infoId = mysqli_fetch_all($queryId);

    $j = sizeof($infoId) - 1;
    for ($i=0; $i <= $j ; $j--) {
        $sqlPubli = "SELECT empresa.NOME, empresa.EMAIL, empresa.TELEFONE, empresa.CELULAR, empresa.CIDADE, empresa.IMAGEM,
        vagas.NOME_VAGA, vagas.REGIME, vagas.CURSO, vagas.QUANTIDADE, vagas.PERFIL FROM empresa INNER JOIN 
        vagas ON empresa.ID_EMPRESA = vagas.AUTOR WHERE vagas.ID_VAGA=" . $infoId[$j][0];
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
                            </div>
                        </div>
<?php
    }
}
?>
