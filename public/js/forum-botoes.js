function editarCampo(id){

	var pPost = document.getElementById("pPostagem" + id);

	var txtaPost = document.createElement("textarea");
	txtaPost.setAttribute("class","input-postagem");
	txtaPost.setAttribute("id","txtaPost" + id);
	txtaPost.innerHTML = pPost.innerHTML;


	pPost.parentNode.replaceChild(txtaPost, pPost);

	var btnEditar = document.getElementById("editar" + id);
	var btnExcluir = document.getElementById("excluir" + id);
	var btnComentar = document.getElementById("comentar" + id);

	var btnCancelar = document.createElement("input");
	btnCancelar.type = 'submit';
	btnCancelar.setAttribute("value","Cancelar");
	var btnConfirmar = document.createElement("button");
	btnConfirmar.type = 'button'
	btnConfirmar.innerHTML = "Confirmar";
	btnConfirmar.setAttribute("onclick","enviarEditado(" + id + ")");

	btnEditar.parentNode.replaceChild(btnCancelar, btnEditar);
	btnExcluir.parentNode.replaceChild(btnConfirmar, btnExcluir);
	btnComentar.parentNode.removeChild(btnComentar);
}

function enviarEditado(id){

	var theForm = document.createElement('form');
	theForm.action = 'forum.php';
	theForm.method = 'post';

	var txtaPost = document.getElementById("txtaPost" + id).value;

	var novoInput1 = document.createElement('input');
  	novoInput1.type = 'hidden';
  	novoInput1.name = 'postEditado';
  	novoInput1.value = txtaPost;
  	var novoInput2 = document.createElement('input');
  	novoInput2.type = 'hidden';
  	novoInput2.name = 'postId';
  	novoInput2.value = id;
	
	theForm.appendChild(novoInput1);
	theForm.appendChild(novoInput2);

	document.getElementById('hidden_form_container').appendChild(theForm);

	theForm.submit();
}

function comentarPost(id){

	var btnComentar = document.getElementById("comentar" + id);
	btnComentar.setAttribute("onclick","escondeComentario("+ id +")");

	var comentarios = document.getElementById("comentarios" + id);
	comentarios.style = "";

	var divComentario = document.getElementById("divComentar" + id);

	var txtaComent = document.createElement("textarea");
	txtaComent.cols = "104";
	txtaComent.setAttribute("id","txtaComent" + id);

	divComentario.appendChild(txtaComent);

	var btnCancelar = document.createElement("input");
	btnCancelar.type = 'submit';
	btnCancelar.setAttribute("value","Cancelar");
	var btnConfirmar = document.createElement("button");
	btnConfirmar.type = 'button'
	btnConfirmar.innerHTML = "Confirmar";
	btnConfirmar.setAttribute("onclick","enviarComentario(" + id + ")");

	divComentario.appendChild(btnCancelar);
	divComentario.appendChild(btnConfirmar);
}

function enviarComentario(id){

	var theForm = document.createElement('form');
	theForm.action = 'forum.php';
	theForm.method = 'post';

	var txtaPost = document.getElementById("txtaComent" + id).value;

	var novoInput1 = document.createElement('input');
  	novoInput1.type = 'hidden';
  	novoInput1.name = 'postComentar';
  	novoInput1.value = txtaPost;
  	var novoInput2 = document.createElement('input');
  	novoInput2.type = 'hidden';
  	novoInput2.name = 'postId';
  	novoInput2.value = id;
	
	theForm.appendChild(novoInput1);
	theForm.appendChild(novoInput2);

	document.getElementById('hidden_form_container').appendChild(theForm);

	theForm.submit();
}