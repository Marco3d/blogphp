<?php
	require_once 'principal.php';
	class Noticias extends Principal{
		private $noticia;
		private $tNot;	//total de noticias
		
		public function __construct(){
			$this->noticia = array();
		}
		// Traemos las noticias para el index
		public function getNoticias($inicio,$cantNot){
			parent::Conectar();
			$query = sprintf(
						"select
						n.idnoticia,
						n.titulo,
						n.detalle,
						n.imagen,
						n.idcategoria,
						a.nombre,
						n.fecha,
						dayname(n.fecha) as dia,
						n.hora
						from
						noticia as n,
						autor as a
						where
						n.idautor=a.idautor
						order by idnoticia desc
						limit %s,%s;",
						parent::comillas_inteligentes($inicio),
						parent::comillas_inteligentes($cantNot)
					);
					
			//echo $query;exit;
			$result = mysql_query($query);
			
			if(!$result)
				die("Regrese más tarde");

			while ($reg = mysql_fetch_assoc($result)) {
				$this->noticia[] = $reg;
			}

			return $this->noticia;	
		}	//fin getNoticias
		//*****************************************************************************
		public function TotalNoticias(){
			$query = "select count(*) as total from noticia";
			$result = mysql_query($query,parent::Conectar());
			
			if ($reg = mysql_fetch_array($result)) {
				$this->tNot = $reg["total"];
			}
			
			return $this->tNot;
		}
		//*****************************************************************************
		public function noticiaPorId($id){
			parent::Conectar();
			$consulta = sprintf(
						"select
						n.idnoticia, n.titulo, n.detalle,  n.imagen,  n.fecha, dayname(n.fecha) as dia,
						n.hora,n.descarga,
						a.nombre
						from
						noticia as n,
						autor as a
						where
						idnoticia = %s
						and
						a.idautor = n.idautor",
						parent::comillas_inteligentes($id)
						);
			$result = mysql_query($consulta);
			while ($reg = mysql_fetch_assoc($result)) {
				$this->noticia[] = $reg;
			}
			return $this->noticia;
		}
	}	//Fin clase
?>