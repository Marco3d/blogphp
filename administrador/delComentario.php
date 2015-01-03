<?php
	//print_r($_GET);
	require_once 'class/comentarios.php';
	$obj = new Comentarios();
	$obj->del($_GET["id"]);
?>