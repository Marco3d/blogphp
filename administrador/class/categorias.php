<?php
	require_once 'principal.php';
	class Categorias extends Principal {
		private $categorias;
		
		public function __construct(){
			$this->categorias = array();
		}
		
		public function get(){
			parent::Conectar();
			$consulta = sprintf(
							"select idcategoria, categoria from categoria;"
						);
			$result = mysql_query($consulta);
			
			while ($reg = mysql_fetch_assoc($result)) {
				$this->categorias[] = $reg;
			}
			
			return $this->categorias;
		}

		public function getId($id){
			parent::Conectar();
			$consulta = sprintf(
							"select idcategoria, categoria, descripcion from categoria where idcategoria=%s;",
							parent::comillas_inteligentes($id)
						);
			$result = mysql_query($consulta);
			
			while ($reg = mysql_fetch_assoc($result)) {
				$this->categorias[] = $reg;
			}
			
			return $this->categorias;
		}


		
		public function delete($id){
			parent::Conectar();
			
			//verificamos que no existan noticias asociadas
			$consulta = sprintf(
							"select idnoticia from noticia where idcategoria = %s;",
							parent::comillas_inteligentes($id)
						);
			$result = mysql_query($consulta);
			
			if (mysql_num_rows($result) == 0) {
				$consulta = sprintf(
							"delete from categoria where idcategoria = %s",
							parent::comillas_inteligentes($id)
						);
				mysql_query($consulta);
				header("Location: categorias.php?m=2");
			} else {
				header("Location: categorias.php?m=1");
			}
			
			
			
		}

		public function add(){
			parent::Conectar();
			
			//verificar que no exista la categoría
			$consulta = sprintf(
							"SELECT categoria FROM categoria WHERE categoria = %s;",
							parent::comillas_inteligentes($_POST["categoria"])
						);
			$result = mysql_query($consulta);
			
			//echo mysql_num_rows($result);exit;
			
			if (mysql_num_rows($result) == 0) {
				//inserta la categoría en la base de datos
				$consulta = sprintf(
								"INSERT INTO categoria values(null,%s,%s)",
								parent::comillas_inteligentes($_POST["categoria"]),
								parent::comillas_inteligentes($_POST["descripcion"])
							);
				$result = mysql_query($consulta);
				header("Location: insertarCategoria.php?mensaje=2");
			} else {
				header("Location: insertarCategoria.php?mensaje=1");
			}
			
		}

		public function update($id){

			//echo "<pre>";print_r($_POST);exit;
			parent::Conectar();
			
			//verificar que no exista la categoría
			$consulta = sprintf(
							"SELECT categoria FROM categoria WHERE categoria = %s;",
							parent::comillas_inteligentes($_POST["categoria"])
						);
			$result = mysql_query($consulta);
			
			//echo mysql_num_rows($result);exit;
			
			if (mysql_num_rows($result) == 0) {
				//inserta la categoría en la base de datos
				$consulta = sprintf(
								"UPDATE  categoria  SET categoria=%s, descripcion=%s WHERE idcategoria=%s;",
								parent::comillas_inteligentes($_POST["categoria"]),
								parent::comillas_inteligentes($_POST["descripcion"]),
								parent::comillas_inteligentes($_POST["id"])
							);
				$result = mysql_query($consulta);
				header("Location: categorias.php?m=4");
			} else {
				header("Location: categorias.php?m=3");
			}
			
		}
		
	}
	
?>