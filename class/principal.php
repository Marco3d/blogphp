<?php
	session_start();
	class Principal{
		public function Conectar(){
			$servidor="localhost";
			$user = "root";
			$password = "00032064";
			
			$link = mysql_connect($servidor,$user,$password);
			
			if(!$link)
				die("Tenemos problemas, regrese en unos minutos: ".mysql_error());
			
			mysql_query("SET NAMES 'utf8'");
			
			$bd = "cblog";
			
			if(!mysql_select_db($bd))
				die("Tenemos problemas, regrese en unos minutos: ".mysql_error());
			
			return $link;
		}
		//*****************************************************************************
		public function comillas_inteligentes($valor)
		{
			// Retirar las barras
			if (get_magic_quotes_gpc()) {
				$valor = stripslashes($valor);
			}
		
			// Colocar comillas si no es entero
			if (!is_numeric($valor)) {
				$valor = "'" . mysql_real_escape_string($valor) . "'";
			}
			return $valor;
		}
		//*****************************************************************************
		// Obtengo los textos limpios para usarlos como url
        public static function limpiaUrl($entra){
            $traduce=array( 'á' => 'a' , 'é' => 'e' , 'í' => 'i' , 'ó' => 'o' , 'ú' => 'u' , 'Á' => 'A', 'É' => 'E' , 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
                        'ñ' => 'n' , 'Ñ' => 'N' ,
                        'ä' => 'a' , 'ë' => 'e' , 'ï' => 'i' , 'ö' => 'o' , 'ü' => 'u', 'Ä' => 'A', 'Ë' => 'E', 'Ï' => 'I', 'Ö' => 'O', 'Ü' => 'U');
            $sale=strtr( $entra , $traduce );
            
            $texto = str_replace(" ","-",$sale);
            
            return $texto;
        }
        //*****************************************************************************
        public static function ruta(){
            return "http://localhost/rtriana/";
        }
		//*****************************************************************************
		public static function myTruncate($string, $limit, $break=".", $pad="...") {
			// return with no change if string is shorter than $limit
			if(strlen($string) <= $limit)
			return $string;
			// is $break present between $limit and the end of the string?
			if(false !== ($breakpoint = strpos($string, $break, $limit))) {
				if($breakpoint < strlen($string)-1 ){
					$string = substr($string, 0, $breakpoint) . $pad;
				}
			}
			return $string;
		}
		//*****************************************************************************
		//Retorno la fecha en formato legible
      public static function invierteFecha($fecha){
         $dia = substr($fecha, 8, 2);
         $mes = substr($fecha, 5, 2);
         $anho = substr($fecha, 0, 4);
         
         switch ($mes) {
            case '01':
               $mesLetra = 'Enero';
               break;
            case '02':
               $mesLetra = 'Febrero';
               break;
            case '03':
               $mesLetra = 'Marzo';
               break;
            case '04':
               $mesLetra = 'Abril';
               break;
            case '05':
               $mesLetra = 'Mayo';
               break;
            case '06':
               $mesLetra = 'Junio';
               break;
            case '07':
               $mesLetra = 'Julio';
               break;
            case '08':
               $mesLetra = 'Agosto';
               break;
            case '09':
               $mesLetra = 'Septiembre';
               break;
            case '10':
               $mesLetra = 'Octubre';
               break;
            case '11':
               $mesLetra = 'Noviembre';
               break;
            case '12':
               $mesLetra = 'Diciembre';
               break;
            default:
               $mesLetra = NULL;
         }
         
         $correcta = $dia." de ".$mesLetra." de ".$anho;
         return $correcta;
      }
      //***********************************************************************************************************************************************
      public static function diaLetra($dia){
         switch ($dia) {
            case 'Sunday':
               $diaLetra = "Domingo";
               break;
            case 'Monday':
               $diaLetra = "Lunes";
               break;
            case 'Tuesday':
               $diaLetra = "Martes";
               break;
            case 'Wednesday':
               $diaLetra = "Miércoles";
               break;
            case 'Thursday':
               $diaLetra = "Jueves";
               break;
            case 'Friday':
               $diaLetra = "Viernes";
               break;
            case 'Saturday':
               $diaLetra = "Sábado";
               break;
            default:
               $diaLetra = NULL;
         }
         return $diaLetra;
      }
      //***********************************************************************************************************************************************
	  public static function removeIndexUrl(){
            if(preg_match('#(.*)index\.(html|php)$#', $_SERVER['REQUEST_URI'], $captures)){
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: '.$captures[1]);
            }
        }
	  //***********************************************************************************************************************************************
	  public static function validarEmail($email){
			$mail_correcto = filter_var($email, FILTER_VALIDATE_EMAIL);
			if ($mail_correcto)
				return TRUE;
			else
				return FALSE;
		}
	}
?>
