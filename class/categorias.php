<?php
    require_once 'principal.php';
    class Categorias extends Principal{
        private $categorias;
        private $tCat;
        
        public function __construct(){
            $this->categorias = array();
        }
        //***********************************************************************
        public function getCategorias(){
            parent::Conectar();
            $consulta = sprintf(
                            "select idcategoria, categoria from categoria order by
                            categoria asc;"
                        );
            $result = mysql_query($consulta);
            
            while($reg = mysql_fetch_assoc($result)){
                $this->categorias[] = $reg;
            }
            
            return $this->categorias;
        }
        //***********************************************************************
        public function getCategoriaId($id,$inicio,$cantNot){
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
						n.hora,
						c.categoria
						from
						noticia as n,
						autor as a,
						categoria as c
						where
						n.idcategoria = %s
						and
						n.idautor=a.idautor
						and
						n.idcategoria = c.idcategoria
						order by idnoticia desc
						limit %s,%s;",
						parent::comillas_inteligentes($id),
						parent::comillas_inteligentes($inicio),
						parent::comillas_inteligentes($cantNot)
					);
					
			//echo $query;exit;
			$result = mysql_query($query);
			
			if(!$result)
				die("Regrese más tarde");

			while ($reg = mysql_fetch_assoc($result)) {
				$this->categorias[] = $reg;
			}

			return $this->categorias;	
		}	//fin getCategoriaId
		//*****************************************************************************
		public function TotalCategorias($id){
			parent::Conectar();
			$query = sprintf(
						"select count(*) as total from noticia where idcategoria = %s;",
						parent::comillas_inteligentes($id)
					);
			$result = mysql_query($query,parent::Conectar());
			
			if ($reg = mysql_fetch_array($result)) {
				$this->tCat = $reg["total"];
			}
			
			return $this->tCat;
		}
    }
?>
