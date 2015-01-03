<?php
	require_once 'class/noticias.php';
	$noticia = new Noticias();
	$noticia->del($_GET["id"]);
?>