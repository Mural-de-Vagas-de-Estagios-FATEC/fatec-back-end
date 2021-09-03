<?php

$sqlVagas = "SELECT * FROM VAGAS";
$queryVagas = mysqli_query($mysqli, $sqlVagas);

if(mysqli_num_rows($queryVagas) > 0) {
	$sqlId = "SELECT ID_VAGA FROM VAGAS";
	$queryId = mysqli_query($mysqli, $sqlId);
	$infoId = mysqli_fetch_all($queryId);

	$j = sizeof($infoId) - 1;
	for ($i=0; $i <= $j ; $j--) {
        $sqlPubli = "SELECT EMPRESA.NOME, EMPRESA.EMAIL, EMPRESA.TELEFONE, EMPRESA.CELULAR, EMPRESA.CIDADE,
        VAGAS.NOME_VAGA, VAGAS.REGIME, VAGAS.CURSO, VAGAS.QUANTIDADE, VAGAS.PERFIL FROM EMPRESA INNER JOIN 
        VAGAS ON EMPRESA.ID_EMPRESA = VAGAS.AUTOR WHERE VAGAS.ID_VAGA=" . $infoId[$j][0];
        $queryPubli = mysqli_query($mysqli,$sqlPubli);
        $infoVagas = mysqli_fetch_row($queryPubli);

?>

<div class="container-vaga">
                            <div class="dados-da-vaga">
                                <div class="imagem-empresa">
                                    <img src="./public/assets/imagem-teste.jpg" alt="imagem da empresa">
                                </div>
                                <div class="informacao-vaga">
                                    <h3><?= $infoVagas[0]?></h3>
                                    <h4><?= $infoVagas[1]?></h4>
                                    <h4>Tel:<?= $infoVagas[2]?> / Cel:<?= $infoVagas[3]?></h4>
                                </div>
                            </div>
                            <div class="nome-da-vaga center"><?= $infoVagas[5]?></div>
                            <div class="requisitos-vaga">
                                <h4>Perfil da vaga:</h4>
                                <p><?= $infoVagas[9]?> </p>
                            </div>
                    
                            <div class="info-adicionais-sobre-vaga center">
                                <div>
                                    <i class="fas fa-briefcase"></i>
                                    <?= $infoVagas[7] . ' / ' . $infoVagas[8] . ' Vagas'?>
                                </div>
                                <div>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?= $infoVagas[4]?>
                                </div>
                                <div>
                                    <i class="far fa-clock"></i>
                                    <?= $infoVagas[6]?>
                                </div>
                            </div>
                        </div>
<?php
	}
}
?>