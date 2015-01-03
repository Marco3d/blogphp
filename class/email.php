<?php
	require_once 'principal.php';
	
	class Email extends Principal{
		public function enviarEmail(){
			//envío el correo
			$remitente = $_POST["nombre"] . "<info@MiWeb.com>";
			$asunto = "Contacto desde mi Web";
			$cuerpo = "
				<html>
					<head>
						<body>
							<strong>Nombre</strong>:
							<br />
							" . $_POST["nombre"] . "
							<br />
							<br />
							<strong>E-mail</strong>:
							<br />
							" . $_POST["correo"] . "
							<br />
							<br />
							<strong>Mensaje</strong>:
							<br />
							" . $_POST["mensaje"] . "
						</body>
					</head>
				<html>
					";
			
				//personalizar el mensaje
				$sheader = "From:" . $remitente . "\nReply-To:" . $remitente . "\n";
				$sheader = $sheader . "X-Mailer:PHP/" . phpversion() . "\n";
				$sheader = $sheader . "Mime-Version: 1.0\n";
				$sheader = $sheader . "Content-Type: text/html";
			
				mail("MiCorreo@LoQueSea.com", $asunto, $cuerpo, $sheader);
			
				echo "
					<script language='javascript' type='text/javascript'>
						window.location='contacto.php?m=1';
					</script>
					";
		}	//cierre enviarEmail
	}	//cierre clase
?>