
                <div class="lado-esquerdo">
                    <div class="altera-image">
                        <div class="imagem-perfil center">
                            <img src="<?= $_SESSION['imagem']?>"/>
                            
                        </div>
                        <label class="input-upload center">
                            <input type="file" name="" id="">
                            ALTERAR IMAGEM
                        </label>
                    </div>
                    <div class="texto-perfil">
                        Olá <?= $_SESSION['nome']; ?>, seja bem-vindo!<br><br>
                    </div>
                    <div class="dados-do-perfil">
                        <h3>Dados do Perfil</h3>
                        <div class="dados">
                            <p>Nome: <?= $_SESSION['nome']; ?></p>   
                            <p>E-mail: <?= $_SESSION['email']; ?></p>
                            <?php 
                            if(isset($_SESSION['curso'])){
                                echo '<hr>';
                            ?>
                            <p>Curso: <?= $_SESSION['curso']; ?></p>
                            <?php
                            }?>
                            <?php 
                            if(isset($_SESSION['semestre'])){
                                echo '<hr>';
                            ?>
                            <p>Curso: <?= $_SESSION['semestre']; ?></p>
                            <?php
                            }?>

                            <hr>
                            <p>Situação: <?= $_SESSION['situacao']?></p>
                        </div>
                        <div class="botoes-perfil">
                            <button class="botao-perfil">Editar conta</button>
                            <button class="botao-perfil">Excluir conta</button>
                        </div>
                    </div>
                </div>
