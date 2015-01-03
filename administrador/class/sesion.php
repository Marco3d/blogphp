<?php
	require_once 'principal.php';
	class Sesion extends Principal{
		private $login;
		
		public function __construct(){
			$this->login = array();
		}
		
		public function logueo(){
			$pass = sha1($_POST["password"]);
			parent::Conectar();
			$consulta = sprintf(
							"select
							idautor, nombre
							from
							autor
							where
							nick = %s
							and
							password = %s",
							parent::comillas_inteligentes($_POST["usuario"]),
							parent::comillas_inteligentes($pass)
						);
			$result = mysql_query($consulta);
			
			while ($reg = mysql_fetch_assoc($result)) {
				$this->login[] = $reg;
			}
			
			if (sizeof($this->login)>0) {
				foreach ($this->login as $key) {
					$_SESSION["id"] = $key["idautor"];
					$_SESSION["nombre"] = $key["nombre"];
					header("Location: home.php");
				}
			} else {
				header("Location: index.php?m=1");
			}
			
		}
	}
?>