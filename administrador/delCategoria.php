<?php
	require_once 'class/categorias.php';
	$obj = new Categorias();
	$obj->delete($_GET["id"]);
?>