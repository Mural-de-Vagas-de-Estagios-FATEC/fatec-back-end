# fatec-back-end

Documentos do Front-end junto dos códigos do Back-end

31/08

Fórum{

lado esquerdo separado para futuramente também ser usado no perfil do usuário (trazer esse assunto)

lado esquerdo dados do aluno funcionado com exceção da situação (aluno ou ex-aluno)

Página fórum ficará vazia caso não tenha publicação

arquivo bdForum trará as publicações no banco de dados uma por uma usando suas ID, publicações recentes sempre no início

alterado tag <a> para <button>
  
Publicações - funcionando
  
Excluir publicação - funcionando
  
  (A fazer){
  
  botão editar 
  
  botão comentar
  
  talvez botão excluir publicação
  
  perfil (editar conta e excluir conta)
  
  necessita HTML DOM Javascript, permitir alterações no campo para depois serem enviados para o servidor com submit
  
  }
  
}
  
01/09
  
  Divulgar vagas funcionando
  
  (a fazer){
  
    perfil empresa (editar conta e excluir conta)
  
  }
  
  
03/09
  Área de vagas funcionando
  
  removido bug do divulgar vagas, onde só aparecia a primeira vaga divulgada pela empresa no lugar das novas publicações

11/09
  
  Issues feito
  
  Adicionado cadastros: André
  
  Funcionalidade, empresas não tem acesso a área dos alunos(forum, vagas divulgadas, e regulamentos), e alunos não tem acesso a área das empresas
 
12/09
  
  Upload de imagens no cadastro
  
  Imagens no site todo
  
  Todos os códigos foram atualizados para adequar ao novo cadastro e imagens

  
19/09
  
  
  index foi adicionado login para administradores 

  cadastros agora encaminham para o banco de dados de pendencias, as pesquisas nas 6 tabelas agora são feitas em um comando só, é brilante (mas dá um bug no site de testes);

  cadastro admin ( página temporaria só para enviar o cadastro dos admin com uma senha segura no banco de dados)

  forum, bdforum, e lado_esquerdo atualizados para aceitar o admin e as novas mudanças do banco de dados

  inicio agora armazena a data das vagas publicadas pela empresa (** detalhe)

  dicas_curriculo e estagio_obrigatorio, só mostra para os administradores as suas novas áreas, pendencias e divulgar vaga (isso foi adicionado em todos)

  novas páginas para administradores, pendencia aluno, egresso e empresa, também divulgar vagas

  home atualizado para receber vagas de empresas e administradores, (** agora elas vão ser ordenadas pela data de publicação, antes era pelo id(mas bugaria ao juntar as duas))

26/10
  
  Todos os botões do fórum funcionais e mudanças no banco de dados

