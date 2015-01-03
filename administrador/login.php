<?php

	//print_r($_POST);exit;
	//echo sha1($_POST["password"]);
	require_once 'class/sesion.php';
	$obj = new Sesion();
	$obj->logueo();
?>