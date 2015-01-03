function validaComentario(){
	form = document.Fcomentarios;
	
	if(form.nombre.value==0){
		//alert("El campo nombre está vacío");
		document.getElementById("error").innerHTML = "<h4>El campo nombre está vacío</h4>";
		form.nombre.value="";
		form.nombre.focus();
		return false;
	}
	
	if(valida_correo(form.correo.value)==false){
		document.getElementById("error").innerHTML = "<h4>Debe ingresar un correo válido</h4>";
		form.correo.value="";
		form.correo.focus();
		return false;
	}
	
	form.submit();
}
//******************************************************
function valida_correo(correo) {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(correo)){
	   return (true)
  } else {
	   return (false);
  }
}
//******************************************************
//función para validar cadenas de solo letras
function valida_cadena(texto){
	var RegExPattern = "[1-9]";
		if (texto.match(RegExPattern))
		{
			return false;
		}else{
			return true;
		}
}