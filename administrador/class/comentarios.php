<?php
	require_once 'principal.php';
	/**
	 * 
	 */
	class Comentarios extends Principal {
		private $comentarios;
		
		function __construct() {
			$this->comentarios = array();
		}
		
		//******************************************************************************************
		public function getComentarios(){
			parent::Conectar();
			$consulta = sprintf("select
								c.idcomentario, c.nombre, c.email, c.comentario, n.titulo
								from
								noticia as n,
								comentario as c
								where
								
								n.idnoticia=c.idnoticia and
								estado = 'pendiente'");
			$result = mysql_query($consulta);
			while ($reg = mysql_fetch_assoc($result)) {
				$this -> comentarios[] = $reg;
			}
			return $this -> comentarios;
		}

		public function aprobar($id){
			parent::Conectar();
			$consulta = sprintf("
							UPDATE comentario SET estado = 'aprobado' WHERE idcomentario = %s;",
							parent::comillas_inteligentes($id)
							);
			mysql_query($consulta);
			header("Location: " . Principal::ruta() . "comentarios.php?m=1");
		}
		public function del($id){
			parent::Conectar();
			$consulta = sprintf("
							DELETE FROM comentario WHERE idcomentario = %s;",
							parent::comillas_inteligentes($id)
							);
			mysql_query($consulta);
			header("Location: " . Principal::ruta() . "comentarios.php?m=2");
		}

		public function getPorId($id){
			if (!empty($id) and is_numeric($id)) {
				parent::Conectar();
				$consulta = sprintf("select
									idcomentario, nombre,  comentario
									from
									comentario
									where
									idcomentario = %s",
									parent::comillas_inteligentes($id)
									);
				$result = mysql_query($consulta);
				while ($reg = mysql_fetch_assoc($result)) {
					$this -> comentarios[] = $reg;
				}
				return $this -> comentarios;
			} else {
				header("Location: " . Principal::ruta() . "comentarios.php?m=3");
			}
		}







		public function update(){
			if (!empty($_POST["id"]) and is_numeric($_POST["id"])) {
				parent::Conectar();
				$consulta = sprintf("update comentario
									set
									nombre = %s,
									
									comentario = %s,
									estado = %s
									where
									idcomentario = %s",
									parent::comillas_inteligentes($_POST["nombre"]),
									
									parent::comillas_inteligentes($_POST["comentario"]),
									parent::comillas_inteligentes($_POST["estado"]),
									parent::comillas_inteligentes($_POST["id"])
									);
				mysql_query($consulta);
				header("Location: " . Principal::ruta() . "comentarios.php?m=4");
			} else {
				header("Location: " . Principal::ruta() . "comentarios.php?m=3");
			}
		}

		
	}
	
?>