<?php
require_once 'principal.php';

class Comentarios extends Principal {
	private $comentarios;

	public function __construct() {
		$this -> comentarios = array();
	}

	//***********************************************************************
	// traemos los comentarios de una noticia en particular por el id
	public function comentarioId($id) {
		parent::Conectar();
		$consulta = sprintf("select
							nombre, email, comentario, fecha, dayname(fecha) as dia, hora
							from
							comentario
							where
							idnoticia = %s
							and
							estado = 'aprobado'
							order by
							idcomentario desc;", parent::comillas_inteligentes($id));
		$result = mysql_query($consulta);
		while ($reg = mysql_fetch_assoc($result)) {
			$this -> comentarios[] = $reg;
		}
		return $this -> comentarios;
	}

	//***********************************************************************
	public function totalComentarios($id) {
		parent::Conectar();
		$consulta = sprintf("select count(*) as total
							from comentario
							where idnoticia=%s
							and
							estado = 'aprobado'", parent::comillas_inteligentes($id));
		$result = mysql_query($consulta);
		while ($reg = mysql_fetch_assoc($result)) {
			$total = $reg["total"];
		}
		return $total;
	}

	//***********************************************************************
	public function insertarComentario() {
		//validamos que no vengan datos vacíos
		if (empty($_POST["nombre"]) or empty($_POST["correo"]) or empty($_POST["comentario"]) or empty($_POST["id"]) or Principal::validarEmail($_POST["correo"])==false) {
			header("Location: " . $_POST["url"]);
		} else {
		//echo "<pre>";print_r($_POST);exit;
			parent::Conectar();

			//encripto el correo
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
			$key = "My+Clave@";
			$email1 = MCRYPT_ENCRYPT(MCRYPT_RIJNDAEL_256,$key,$_POST["correo"],MCRYPT_MODE_ECB,$iv);
			$email = base64_encode($email1);
			
			
			//echo $email;exit;
			//echo "<pre>";print_r($_POST);exit;
			
			$consulta = sprintf("select idcomentario from comentario where
							nombre = %s
							and
							email = %s
							and
							comentario = %s
							and
							idnoticia = %s",
							parent::comillas_inteligentes($_POST["nombre"]),
							parent::comillas_inteligentes($email),
							parent::comillas_inteligentes($_POST["comentario"]),
							parent::comillas_inteligentes($_POST["id"])
							);
			$result = mysql_query($consulta);

			//echo mysql_num_rows($result);exit;

			if (mysql_num_rows($result) == 0) {
				//insertamos el comentario
				$consulta = sprintf("
								INSERT INTO comentario VALUES(
								null,%s,%s,%s,now(),now(),%s,'pendiente'
								);",
								parent::comillas_inteligentes($_POST["nombre"]),
								parent::comillas_inteligentes($email),
								parent::comillas_inteligentes($_POST["comentario"]),
								parent::comillas_inteligentes($_POST["id"]));
				mysql_query($consulta);
				echo "<script>
						alert('Gracias por escribir el comentario. Será mostrado cuando sea moderado');
						window.location='" . $_POST["url"] . "';
					</script>";
			} else {
				//redireccionamos
				header("Location: " . $_POST["url"]);
			}
		}
	
	}	//fin función insertarComentario
}
?>

