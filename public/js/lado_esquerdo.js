var aluno = false;
function excluirConta(idUsuario){

	var btnEditar = document.getElementById("btnEditarConta");
	var btnExcluir = document.getElementById("btnExcluirConta");

	btnExcluir.setAttribute('onclick','deletarConfirmado(' + idUsuario + ')');

	var subCancelar = document.createElement("input");
	subCancelar.type = 'submit';

	btnExcluir.innerHTML = "Confirmar";
	subCancelar.setAttribute('name','subCancelar');
	subCancelar.setAttribute('form','formPerfil');
	subCancelar.setAttribute('class','botao-perfil');
	subCancelar.setAttribute('value','Cancelar');

	btnEditar.parentNode.replaceChild(subCancelar, btnEditar);
}
function deletarConfirmado(idUsuario){
	var theForm = document.createElement('form');
	if(document.getElementById("pSituacao")){
		theForm.action = 'forum.php';
	}
	else {
		theForm.action = 'inicio.php';
	}
	theForm.method = 'post';
	
	
	var novoInput1 = document.createElement('input');
  	novoInput1.type = 'hidden';
  	novoInput1.name = 'deletarConta';
  	novoInput1.value = idUsuario;


	
	theForm.appendChild(novoInput1);
	document.getElementById('hidden_form_container').appendChild(theForm);

	theForm.submit();
}
function editarConta(){
	var pNome = document.getElementById("pNome");
	var pEmail = document.getElementById("pEmail");
	var spanSenha = document.getElementById("spanSenha");
	var span1 = document.createElement("span");
	var span2 = document.createElement("span");

	if(document.getElementById("pCurso")){
		document.getElementById("spanCurso").remove();
		/*var pCurso = document.getElementById("pCurso");
		var txtCurso = document.createElement("input");
		txtCurso.type = 'text';
		txtCurso.setAttribute('value', pCurso.innerHTML);
		txtCurso.setAttribute('id', 'txtCurso');
		pCurso.parentNode.replaceChild(txtCurso, pCurso);*/
	}
	var sit = document.getElementById("pSituacao").innerHTML;
	if(sit == 'Aluno'){
		aluno = true;
	}
	if(aluno){
		var pSemestre = document.getElementById("pSemestre");
		var slcSemestre = document.createElement("select");
		slcSemestre.setAttribute('id', 'slcSemestre');
		var lista = ["1º Semestre", "2º Semestre", "3º Semestre", "4º Semestre", "5º Semestre", "6º Semestre", "Concluído",];
		for (var i = 0; i < lista.length; i++) {
    		var option = document.createElement("option");
    		option.value = lista[i];
    		option.text = lista[i];
    		slcSemestre.appendChild(option);
		}
		pSemestre.parentNode.replaceChild(slcSemestre, pSemestre);
	}

	var txtNome = document.createElement("input");
	txtNome.type = 'text';
	var txtEmail = document.createElement("input");
	txtEmail.type = 'text';
	var txtSenha = document.createElement("input");
	txtSenha.type = 'password';
	var txtConfSenha = document.createElement("input");
	txtConfSenha.type = 'password';


	txtNome.setAttribute('value', pNome.innerHTML);
	txtNome.setAttribute('id', 'txtNome');
	txtEmail.setAttribute('value', pEmail.innerHTML);
	txtEmail.setAttribute('id', 'txtEmail');
	txtSenha.setAttribute('placeholder','********');
	txtSenha.setAttribute('id','txtSenha');
	txtConfSenha.setAttribute('placeholder','********');
	txtConfSenha.setAttribute('id','txtConfSenha');

	span1.innerHTML = "Senha: ";
	span2.innerHTML = "Confirmar Senha: ";

	pNome.parentNode.replaceChild(txtNome, pNome);
	pEmail.parentNode.replaceChild(txtEmail, pEmail);

	spanSenha.appendChild(span1);
	spanSenha.appendChild(txtSenha);
	spanSenha.appendChild(document.createElement("br"));
	spanSenha.appendChild(document.createElement("br"));
	spanSenha.appendChild(span2);
	spanSenha.appendChild(txtConfSenha);
	spanSenha.appendChild(document.createElement("br"));
	spanSenha.appendChild(document.createElement("br"));


	var btnEditar = document.getElementById("btnEditarConta");
	var btnExcluir = document.getElementById("btnExcluirConta");

	var naoAlterar = document.createElement("input");
	naoAlterar.type = "submit";
	

	btnExcluir.innerHTML = "Salvar Alterações";

	naoAlterar.removeAttribute('onclick');
	btnExcluir.setAttribute('onclick', 'salvarCampos()');

	naoAlterar.setAttribute('name','subNaoAlterar');
	naoAlterar.setAttribute('form','formPerfil');
	naoAlterar.setAttribute('class','botao-perfil');
	naoAlterar.setAttribute('value','Não Salvar Alterações');



	btnEditar.parentNode.replaceChild(naoAlterar, btnEditar);

}

function salvarCampos(){

	var theForm = document.createElement('form');
	theForm.action = 'forum.php';
	theForm.method = 'post';

	var txtNome = document.getElementById("txtNome").value;
	var txtEmail = document.getElementById("txtEmail").value;
	var txtSenha = document.getElementById("txtSenha").value;
	if(aluno){
		var slcSemestre = document.getElementById("slcSemestre").value;
		var novoInput4 = document.createElement('input');
  		novoInput4.type = 'hidden';
  		novoInput4.name = 'slcSemestre';
  		novoInput4.value = slcSemestre;
  		theForm.appendChild(novoInput4);
	}

	var novoInput1 = document.createElement('input');
  	novoInput1.type = 'hidden';
  	novoInput1.name = 'txtNome';
  	novoInput1.value = txtNome;
  	var novoInput2 = document.createElement('input');
  	novoInput2.type = 'hidden';
  	novoInput2.name = 'txtEmail';
  	novoInput2.value = txtEmail;
  	var novoInput3 = document.createElement('input');
  	novoInput3.type = 'hidden';
  	novoInput3.name = 'txtSenha';
  	novoInput3.value = txtSenha;

	
	theForm.appendChild(novoInput1);
	theForm.appendChild(novoInput2);
	theForm.appendChild(novoInput3);

	document.getElementById('hidden_form_container').appendChild(theForm);

	theForm.submit();
}
// Funções para Empresa

function editarContaE(){
	var pNome = document.getElementById("pNome");
	var pEmail = document.getElementById("pEmail");
	var pTel = document.getElementById("pTel");
	var pCel = document.getElementById("pCel");
	var pCidade = document.getElementById("pCidade");
	var spanSenha = document.getElementById("spanSenha");
	var span1 = document.createElement("span");
	var span2 = document.createElement("span");

	
	var txtNome = document.createElement("input");
	txtNome.type = 'text';
	var txtEmail = document.createElement("input");
	txtEmail.type = 'text';
	var txtTel = document.createElement("input");
	txtTel.type = 'text';
	var txtCel = document.createElement("input");
	txtCel.type = 'text';
	var txtCidade = document.createElement("input");
	txtCidade.type = 'text';
	var txtSenha = document.createElement("input");
	txtSenha.type = 'password';
	var txtConfSenha = document.createElement("input");
	txtConfSenha.type = 'password';


	txtNome.setAttribute('value', pNome.innerHTML);
	txtNome.setAttribute('id', 'txtNome');
	txtEmail.setAttribute('value', pEmail.innerHTML);
	txtEmail.setAttribute('id', 'txtEmail');
	txtTel.setAttribute('value', pTel.innerHTML);
	txtTel.setAttribute('id', 'txtTel');
	txtCel.setAttribute('value', pCel.innerHTML);
	txtCel.setAttribute('id', 'txtCel');
	txtCidade.setAttribute('value', pCidade.innerHTML);
	txtCidade.setAttribute('id', 'txtCidade');
	txtSenha.setAttribute('placeholder','********');
	txtSenha.setAttribute('id','txtSenha');
	txtConfSenha.setAttribute('placeholder','********');
	txtConfSenha.setAttribute('id','txtConfSenha');

	span1.innerHTML = "Senha: ";
	span2.innerHTML = "Confirmar Senha: ";

	pNome.parentNode.replaceChild(txtNome, pNome);
	pEmail.parentNode.replaceChild(txtEmail, pEmail);
	pTel.parentNode.replaceChild(txtTel, pTel);
	pCel.parentNode.replaceChild(txtCel, pCel);
	pCidade.parentNode.replaceChild(txtCidade, pCidade);

	for (var i = 1; i < 7; i++) {
		document.getElementById("remove" + i).remove();
	}

	spanSenha.appendChild(span1);
	spanSenha.appendChild(txtSenha);
	spanSenha.appendChild(document.createElement("br"));
	spanSenha.appendChild(span2);
	spanSenha.appendChild(txtConfSenha);
	spanSenha.appendChild(document.createElement("br"));


	var btnEditar = document.getElementById("btnEditarConta");
	var btnExcluir = document.getElementById("btnExcluirConta");

	var naoAlterar = document.createElement("input");
	naoAlterar.type = "submit";
	

	btnExcluir.innerHTML = "Salvar Alterações";

	naoAlterar.removeAttribute('onclick');
	btnExcluir.setAttribute('onclick', 'salvarCamposE()');

	naoAlterar.setAttribute('name','subNaoAlterar');
	naoAlterar.setAttribute('form','formPerfil');
	naoAlterar.setAttribute('class','botao-perfil');
	naoAlterar.setAttribute('value','Não Salvar Alterações');



	btnEditar.parentNode.replaceChild(naoAlterar, btnEditar);

}

function salvarCamposE(){

	var theForm = document.createElement('form');
	theForm.action = 'inicio.php';
	theForm.method = 'post';

	var txtNome = document.getElementById("txtNome").value;
	var txtEmail = document.getElementById("txtEmail").value;
	var txtSenha = document.getElementById("txtSenha").value;
	var txtTel = document.getElementById("txtTel").value;
	var txtCel = document.getElementById("txtCel").value;
	var txtCidade = document.getElementById("txtCidade").value;


	var novoInput1 = document.createElement('input');
  	novoInput1.type = 'hidden';
  	novoInput1.name = 'txtNome';
  	novoInput1.value = txtNome;
  	var novoInput2 = document.createElement('input');
  	novoInput2.type = 'hidden';
  	novoInput2.name = 'txtEmail';
  	novoInput2.value = txtEmail;
  	var novoInput3 = document.createElement('input');
  	novoInput3.type = 'hidden';
  	novoInput3.name = 'txtSenha';
  	novoInput3.value = txtSenha;
  	var novoInput4 = document.createElement('input');
  	novoInput4.type = 'hidden';
  	novoInput4.name = 'txtTel';
  	novoInput4.value = txtTel;
  	var novoInput5 = document.createElement('input');
  	novoInput5.type = 'hidden';
  	novoInput5.name = 'txtCel';
  	novoInput5.value = txtCel;
  	var novoInput6 = document.createElement('input');
  	novoInput6.type = 'hidden';
  	novoInput6.name = 'txtCidade';
  	novoInput6.value = txtCidade;

	
	theForm.appendChild(novoInput1);
	theForm.appendChild(novoInput2);
	theForm.appendChild(novoInput3);
	theForm.appendChild(novoInput4);
	theForm.appendChild(novoInput5);
	theForm.appendChild(novoInput6);

	document.getElementById('hidden_form_container').appendChild(theForm);

	theForm.submit();
}