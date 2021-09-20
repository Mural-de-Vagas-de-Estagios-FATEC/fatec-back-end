<?php
$sqlVagas = 'SELECT ID_VAGAS_ADMIN FROM VAGAS_ADMIN ORDER BY ID_VAGAS_ADMIN';
$queryVagas = mysqli_query($mysqli,$sqlVagas);

if( mysqli_num_rows($queryVagas) > 0){
    $infoId = mysqli_fetch_all($queryVagas);
    $j = sizeof($infoId) - 1;
    for ($i=0; $i <= $j ; $j--) { 
        $sqlPubli = "SELECT * FROM VAGAS_ADMIN WHERE ID_VAGAS_ADMIN=" . $infoId[$j][0];
        $queryPubli = mysqli_query($mysqli,$sqlPubli);
        $infoVagas = mysqli_fetch_row($queryPubli);
    
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
                	<td><input type="text" name="nomeEmpresa<?=$infoVagas[12]?>" value="<?=$infoVagas[0]?>" class="input"></td>
                	<td><input type="text" name="nomeVaga<?=$infoVagas[12]?>" value="<?=$infoVagas[1]?>" class="input"></td>
                	<td><input type="text" name="regime<?=$infoVagas[12]?>" value="<?=$infoVagas[2]?>" class="input"></td>
                	<td><input type="text" name="qntd<?=$infoVagas[12]?>" value="<?=$infoVagas[4]?>" class="input"></td>
                </tr>
                <tr>
                    <th colspan="2">Cidade</th>
                    <th colspan="2">Telefone</th>
                </tr>
                <tr>
                    <td colspan="2"><input type="text" name="cidade<?=$infoVagas[12]?>" value="<?=$infoVagas[5]?>" class="input"></td>
                    <td colspan="2"><input type="text" name="telefone<?=$infoVagas[12]?>" value="<?=$infoVagas[6]?>" class="input"></td>
                </tr>
                <tr>
                    <th colspan="1">Curso de destino</th>
                    <th colspan="3">Requisitos da Vaga</th>
                </tr>
                <tr>
                    <td colspan="1"><input type="text" name="curso<?=$infoVagas[12]?>" value="<?=$infoVagas[3]?>" class="input"></td>
                    <td colspan="3"><textarea name="perfil<?=$infoVagas[12]?>" class="input-requisito"><?=$infoVagas[8]?></textarea></td>
                </tr>
                <tr>
                    <th colspan="3">Imagem</th>
                    <th colspan="1">Trocar Imagem</th>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php if(substr($infoVagas[7], -3) == 'jpg' || substr($infoVagas[7], -3) == 'png'){?>
                            <img src="<?=$infoVagas[7]?>" name="" value="<?=$infoVagas[7]?>" alt="" id="imgVaga" width="100px" height="100px">
                        <?php }?>
                            
                        
                    </td>
                    <td colspan="1">
                        <label class="input-upload center">
                            <input type="file" name="imagem<?=$infoVagas[12]?>" onchange="loadFile(event)" id="btnImagem">
                            Trocar Imagem/Arquivo
                        </label>
                    </td>
                </tr>
            </table>
        </div>
        <div class="botoes-vagas">
            <button class="button-vagas" name="editar" value="<?=$infoVagas[12]?>">Editar</button>
            <button class="button-vagas" name="excluir" value="<?=$infoVagas[12]?>">Excluir</button>
        </div>
    </form>
</div>
<?php
    }
}
?>