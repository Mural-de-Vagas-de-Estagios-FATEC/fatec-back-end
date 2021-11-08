            <form action="forum.php" method="post" id="formPerfil" name="formPerfil"></form>
                <div class="lado-esquerdo">
                    <div class="altera-image">
                        <div class="imagem-perfil center">
                            <img src="<?= $_SESSION['imagem']?>"/>
                            
                        </div>
                        <form enctype="multipart/form-data" method="post" id="formImagem"></form>
                        <label class="input-upload center">
                            <input type="file" name="subImagem" value="Imagem" id="fileImagem" form="formImagem" accept="image/png, image/jpeg" onchange="

                            form.submit();
                            ">
                            ALTERAR IMAGEM
                        </label>
                    </div>
                    <div class="texto-perfil">
                        Olá <?= $_SESSION['nome']; ?>, seja bem-vindo!<br><br>
                    </div>
                    <div class="dados-do-perfil">
                        <h3>Dados do Perfil</h3>
                        <div class="dados">
                            Nome: <span id="pNome" name="pNome" ><?= $_SESSION['nome']; ?></span> <br><br>  
                            E-mail: <span id="pEmail" name="pEmail" ><?= $_SESSION['email']; ?></span><br><br>
                            <span id='spanSenha'></span>
                            <?php 
                            if(isset($_SESSION['curso'])){
                                echo '<span id="spanCurso"><hr>';
                            ?>
                            Curso: <span id="pCurso" name="pCurso" ><?= $_SESSION['curso']; ?></span><br><br></span>
                            <?php
                            }?>
                            <?php 
                            if(isset($_SESSION['semestre'])){
                                echo '<hr>';
                            ?>
                            Semestre: <span id="pSemestre" name="pSemestre" ><?= $_SESSION['semestre']; ?></span><br><br> 
                            <?php
                            }?>

                            <hr>
                            Situação: <span id="pSituacao" name="pSituacao" ><?= $_SESSION['situacao']?></span> 
                        </div>
                        <div class="botoes-perfil">
                            <button class="botao-perfil" name="btnEditarConta" id="btnEditarConta" onclick="editarConta();">Editar conta</button>
                            
                            <button class="botao-perfil" name="btnExcluirConta" id="btnExcluirConta"onclick="excluirConta(<?= $_SESSION['id']?>);">Excluir conta</button>
                        </div>
                        <div id="hidden_form_container" style="display:none;"></div>
                    </div>
                </div>

