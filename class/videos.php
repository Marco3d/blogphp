<?php
	require_once 'principal.php';
	class Videos extends Principal{
		private $noticia;
		private $tNot;	//total de noticias
		
		public function __construct(){
			$this->noticia = array();
		}
		// Traemos las noticias para el index
		public function getVideos($inicio,$cantNot){
			parent::Conectar();
			$query = sprintf(
						"select
						n.idnoticia,
						n.titulo,
						n.detalle,
						n.idcategoria,
						a.nombre,
						n.fecha,
						dayname(n.fecha) as dia,
						n.hora
						from
						noticia as n,
						autor as a
						where
						video = 1
						and
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
		public function TotalVideos(){
			$query = "select count(*) as total from noticia where video=1";
			$result = mysql_query($query,parent::Conectar());
			
			if ($reg = mysql_fetch_array($result)) {
				$this->tNot = $reg["total"];
			}
			
			return $this->tNot;
		}
	}	//Fin clase
?>