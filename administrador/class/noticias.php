<?php
	require_once 'principal.php';
	class Noticias extends Principal{
		private $noticia;
		private $tNot;	//total de noticias
		
		public function __construct(){
			$this->noticia = array();
		}
		// Traemos las noticias para el index
		public function getNoticias(){
			parent::Conectar();
			$query = sprintf(
						"select
						n.idnoticia,
						n.titulo,
						n.detalle,
						n.imagen,
						n.idcategoria,
						a.nombre,
						c.categoria,
						n.fecha,
						dayname(n.fecha) as dia,
						n.hora
						from
						noticia as n,
						autor as a,
						categoria as c
						where
						n.idautor=a.idautor 
						and n.idcategoria=c.idcategoria

						order by idnoticia desc;
						");
					
			//echo $query;exit;
			$result = mysql_query($query);
			
			if(!$result)
				die("Regrese más tarde");

			while ($reg = mysql_fetch_assoc($result)) {
				$this->noticia[] = $reg;
			}

			return $this->noticia;	
		}	//fin getNoticias

//********************************************************************
		public function getNoticiasId($id){
			parent::Conectar();
			$consulta = sprintf(
							"select n.idnoticia, n.titulo, n.detalle, n.imagen, n.descarga, c.categoria, c.idcategoria   from
							noticia as n,
							categoria as c 
							where
							n.idcategoria=c.idcategoria and
							idnoticia=%s;",
							parent::comillas_inteligentes($id)
						);
			$result = mysql_query($consulta);
			
			while ($reg = mysql_fetch_assoc($result)) {
				$this->noticias[] = $reg;
			}
			
			return $this->noticias;
		}

//********************************************************************
		public function updateNoticias($id){
			//echo "<pre>";print_r($_POST);exit;
			//verificamos que exista la categoría
			//verificamos que exista la categoría
			parent::Conectar();
			$consulta = sprintf(
							"select idcategoria,categoria,descripcion from categoria where idcategoria = %s;",
							parent::comillas_inteligentes($_POST['categoria'])
						);
			$result = mysql_query($consulta);
			
			if (mysql_num_rows($result) == 0) {
				header('Location: noticias.php?m=4');
			
			} else {
				//echo "La categoría si existe";exit;
				//verificar que la noticia no exista
				/*$consulta = sprintf(
							"select titulo from noticia where titulo = %s;",
							parent::comillas_inteligentes($_POST['titulo'])
						);
				$result = mysql_query($consulta);
				if (mysql_num_rows($result) == 1) {
					header('Location: noticias.php?m=5');
				} else {
					//echo "No existe ese título, por lo tanto actualizo";exit;*/
					$consulta = sprintf(
								"UPDATE noticia SET
								titulo = %s,
								detalle = %s,
								
								idcategoria = %s,
								descarga = %s
								WHERE
								idnoticia = ".$id.";",
								parent::comillas_inteligentes($_POST['titulo']),
								parent::comillas_inteligentes($_POST['detalle']),
								
							
								parent::comillas_inteligentes($_POST['categoria']),
								parent::comillas_inteligentes($_POST['descarga'])
								);
					//echo $consulta;exit;
					mysql_query($consulta);
					header('Location: noticias.php?m=6');
				// }
			}
		}


		//********************************************************************
		public function del($id){
			parent::Conectar();

			$query = sprintf(
						"SELECT idnoticia FROM comentario WHERE  idnoticia = %s;",
						parent::comillas_inteligentes($id)
					);
			$result = mysql_query($query);
			
			//echo mysql_num_rows($result);
			
			if(mysql_num_rows($result) == 0){
				
				$query = sprintf(
						"DELETE FROM noticia WHERE idnoticia = %s;",
						parent::comillas_inteligentes($id)
					);
				mysql_query($query);
				header("Location: noticias.php?m=1");


			}else{

			header("Location: noticias.php?m=2");
				


			}
		}


		public function add(){
			//verificamos que exista la categoría
			parent::Conectar();
			$consulta = sprintf(
							"select idcategoria,categoria,descripcion from categoria where idcategoria = %s;",
							parent::comillas_inteligentes($_POST['categoria'])
						);
			$result = mysql_query($consulta);
			
			if (mysql_num_rows($result) == 0) {
				header('Location: noticias.php?m=4');
			} else {
				//verificar que el noticia no exista
				$consulta = sprintf(
							"select titulo from noticia where titulo = %s;",
							parent::comillas_inteligentes($_POST['titulo'])
						);
				$result = mysql_query($consulta);
				if (mysql_num_rows($result) == 0) {
					$consulta = sprintf(
								"INSERT INTO noticia values(
									null, %s, %s, %s, %s,  ".$_SESSION["id"].", now(), now(), %s
								);",
								parent::comillas_inteligentes($_POST['titulo']),
								parent::comillas_inteligentes($_POST['detalle']),
								parent::comillas_inteligentes($_POST['imagen']),
								
								parent::comillas_inteligentes($_POST['categoria']),
								parent::comillas_inteligentes($_POST['descarga'])
								);
					//echo $consulta;exit;
					mysql_query($consulta);
					header('Location: noticias.php?m=3');
				} else {
					header('Location: noticias.php?m=5');
				}
			}
			
		}






	}
?>