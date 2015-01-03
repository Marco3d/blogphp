function eliminiar(url,id){
	if(confirm("Desea eliminar este registro?")){
		window.location=url+"?id="+id;
	}
}
function aprobar(url,id){
	if(confirm("Desea aprobar este comentario?")){
		window.location=url+"?id="+id;
	}


}
