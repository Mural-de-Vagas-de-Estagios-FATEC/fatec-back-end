<?php
$sql = 'SELECT * FROM PENDENTE_USUARIO';
$querySql = mysqli_query($mysqli,$sql);

if(mysqli_num_rows($querySql) > 0){
    $sqlId = "SELECT ID_PEND_USUARIO FROM PENDENTE_USUARIO ORDER BY ID_PEND_USUARIO DESC";
    $queryId = mysqli_query($mysqli,$sqlId);
    $infoId = mysqli_fetch_all($queryId);

    $cnt = sizeof($infoId);
    $j = sizeof($infoId) - 1;?>
    <div class="center">
                <div class="tabela-alunos">
                    <table>
                        <tr>
                            <th>Nome do Aluno</th>
                            <th>Nome da Mãe</th>
                            <th>CPF</th>
                            <th>Curso</th>
                            <th>Semestre</th>
                            <th>Situação</th>
                            <th></th>
                        </tr>
                    <?php
    for ($i=0; $i <= $j ; $j--) {
        $sqlUser = "SELECT * FROM PENDENTE_USUARIO WHERE ID_PEND_USUARIO=" . $infoId[$j][0];
        $queryUser = mysqli_query($mysqli,$sqlUser);
        $infoPendente = mysqli_fetch_row($queryUser);

?>
<tr>
    <td><?=$infoPendente[0]?></td>
    <td><?=$infoPendente[6]?></td>
    <td>00000000000</td>
    <td><?=$infoPendente[3]?></td>
    <td><?=$infoPendente[4]?></td>
    <td>Pendente</td>
    <td class="botoes-vagas">
        <button type="submit" name="aceitar" value="<?=$infoPendente[7]?>" form="formAlunos" class="button-vagas">Aceitar</button>
        <button type="submit" name="excluir" value="<?=$infoPendente[7]?>" form="formAlunos" class="button-vagas">Excluir</button>
    </td>
</tr>
<?php
    }?>
    </table>
                </div>
            </div><?php
}
?>