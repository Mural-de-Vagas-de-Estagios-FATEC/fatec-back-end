<?php {?>
                <div class="lado-esquerdo">
                    <!-- IMAGEM DO PERFIL -->
                    <div class="altera-image">
                        <div class="imagem-perfil center">
                            <img src="./public/assets/imagem-teste.jpg" alt="imagem da empresa">
                        </div>
                        <label class="input-upload center">
                            <input type="file" name="" id="">
                            ALTERAR IMAGEM
                        </label>
                    </div>
                    <!-- QUANTIDADE DE VAGAS -->
                    <div class="texto-perfil">
                        Olá <?= $_SESSION['nome']; ?>, Lorem Ipsum is simply dummy!<br><br>
                    </div>
                    <!-- DADOS DA EMPRESA -->
                    <div class="dados-do-perfil">
                        <h3>Dados da empresa</h3>
                        <div class="dados">
                            <p>Nome: <?= $_SESSION['nome']; ?></p>   
                            <p>E-mail: <?= $_SESSION['email']; ?></p>
                            <hr>
                            <p>Curso: <?= $_SESSION['curso']; ?></p>
                            <hr>
                            <p>Situação: Aluno</p>
                        </div>
                        <div class="botoes-perfil">
                            <button class="botao-perfil">Editar conta</button>
                            <button class="botao-perfil">Excluir conta</button>
                        </div>
                    </div>
                </div>
                <?php }?>