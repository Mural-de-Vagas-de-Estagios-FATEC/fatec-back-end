<?php
$sql = 'SELECT * FROM PENDENTE_EMPRESA';
$querySql = mysqli_query($mysqli,$sql);

if(mysqli_num_rows($querySql) > 0){
    $sqlId = "SELECT ID_PEND_EMPRESA FROM PENDENTE_EMPRESA ORDER BY ID_PEND_EMPRESA DESC";
    $queryId = mysqli_query($mysqli,$sqlId);
    $infoId = mysqli_fetch_all($queryId);

    $cnt = sizeof($infoId);
    $j = sizeof($infoId) - 1;?>
    <div class="center">
                <div class="tabela-alunos">
                    <table>
                        <tr>
                            <th>Nome da Empresa</th>
                            <th>Email</th>
                            <th>CNPJ</th>
                            <th>Telefone / Celular</th>
                            <th>Cidade</th>
                            <th>Situação</th>
                            <th></th>
                        </tr>
                        
                    <?php
    for ($i=0; $i <= $j ; $j--) {
        $sqlUser = "SELECT * FROM PENDENTE_EMPRESA WHERE ID_PEND_EMPRESA=" . $infoId[$j][0];
        $queryUser = mysqli_query($mysqli,$sqlUser);
        $infoPendente = mysqli_fetch_row($queryUser);

?>
<tr>
    <td><?=$infoPendente[0]?></td>
    <td><?=$infoPendente[1]?></td>
    <td><?=$infoPendente[4]?></td>
    <td><?=$infoPendente[5]?> / <?=$infoPendente[6]?></td>
    <td><?=$infoPendente[2]?></td>
    <td>Pendente</td>
    <td class="botoes-vagas">
        <button type="submit" name="aceitar" value="<?=$infoPendente[8]?>" form="formEmpresas" class="button-vagas">Aceitar</button>
        <button type="submit" name="excluir" value="<?=$infoPendente[8]?>" form="formEmpresas" class="button-vagas">Excluir</button>
    </td>
</tr>
<?php
    }?>
    </table>
                </div>
            </div><?php
}
?>