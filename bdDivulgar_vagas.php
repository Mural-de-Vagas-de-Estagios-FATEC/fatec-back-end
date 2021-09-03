<?php
$sqlVagas = "SELECT * FROM VAGAS";
$queryVagas = mysqli_query($mysqli,$sqlVagas); 

if(mysqli_num_rows($queryVagas) > 0) {
    $sqlId = "SELECT ID_VAGA FROM VAGAS WHERE AUTOR=" . $_SESSION['id'];
    $queryId = mysqli_query($mysqli,$sqlId);
    $infoId = mysqli_fetch_all($queryId);

    $cnt = sizeof($infoId);
    $j = sizeof($infoId) - 1;
    for ($i=0; $i <= $j ; $j--) {
        $sqlPubli = "SELECT * FROM VAGAS WHERE ID_VAGA=" . $infoId[$j][0];
        $queryPubli = mysqli_query($mysqli,$sqlPubli);
        $infoVagas = mysqli_fetch_row($queryPubli);

?>


<div class="vagas empresa center">
                        <!-- ARÉA PARA RECEBER VAGAS - INICIO TEMPLATE -->
                        <div class="container-vaga">
                            
                            <div class="dados-da-vaga">
                                <div class="imagem-empresa">
                                    <img src="./public/assets/imagem-teste.jpg" alt="imagem da empresa">
                                </div>
                                <div class="informacao-vaga">
                                    <h3><?= $_SESSION['nome'] ?></h3>
                                    <h4><?= $_SESSION['email'] ?></h4>
                                    <h4>Tel: <?= $_SESSION['telefone'] ?> Cel: <?= $_SESSION['celular']?></h4>
                                </div>
                            </div>
                            <div class="nome-da-vaga center"><?= $infoVagas[1] ?></div>
                            <div class="requisitos-vaga">
                                <h4>Perfil da vaga:</h4>
                                <p><?= $infoVagas[5] ?> </p>
                            </div>
                    
                            <div class="info-adicionais-sobre-vaga center">
                                <div>
                                    <i class="fas fa-briefcase"></i>
                                    <?= $infoVagas[4] ?>
                                </div>
                                <div>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?= $_SESSION['cidade']?>
                                </div>
                                <div>
                                    <i class="far fa-clock"></i>
                                    <?= $infoVagas[2] ?>
                                </div>
                            </div>
                        </div>
                        
</div>
<?php
    }
}
?>
