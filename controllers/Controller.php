<?php

require_once("models/model.php");

class Controller{
	public function principalIndex(){
		echo "controller principal";
	}
	public function page($pageUrl){
		$this->session_activa();
		$page = $this->load_page("views/page.html");
		$page =	$this->replace_content("/\#USUARIO\#/ms", $_SESSION['nombreUci'], $page);
		//$view = $this->load_page("views/".$page.".html");
		switch ($pageUrl) {
			case 'menuAdmin':
				$this->session_admin();
				$view = $this->load_page("views/menus/".$pageUrl.".html");
				break;
			case 'menuUsuario':
				$this->session_usuario();
				$view = $this->load_page("views/menus/".$pageUrl.".html");
				break;
			case 'salir':
				$this->session_delete();
				header("location: index.php");
				break;
			default:
				header("location: index.php");
				break;
		}
		$html = $this->replace_content("/\#CONTENIDO\#/ms", $view, $page);
		$this->view_page($html);
	}
	function session_var($session=""){
		session_start();
		if ($session != "") {
			$_SESSION['nombreReq']=$session["nombre"]." ".$session["ap_paterno"]." ".$session["ap_materno"];
			$_SESSION['tipoUsuarioReq']=$session["id_tipo_usuario"];
		}
		return $_SESSION;
	}
	public function session_activa(){
		session_start();
		if (!isset($_SESSION['nombreReq'])) {
			header("location: index.php");
		}
	}
	public function session_admin(){
		session_start();
		if ($_SESSION['tipoUsuarioReq'] != 1) {
			header("location: index.php");
		}
	}
	public function session_usuario(){
		session_start();
		if ($_SESSION['tipoUsuarioReq'] != 2) {
			header("location: index.php");
		}
	}
	public function session_delete(){
		session_start();
		unset($_SESSION['nombreReq']);
		unset($_SESSION['tipoUsuarioReq']);
	}
	public function load_page($page){
  		return file_get_contents($page);
 	}
 	public function view_page($html){
  		echo $html;
 	}
	public function replace_content($pattern = '/\#CONTENIDO\#/ms', $replacement,$subject){
   		return preg_replace($pattern, $replacement, $subject);
 	}
	public function limpiarCadena($string) {
		// ----- remueve los TAG's HTML----- 
		//$string = htmlspecialchars($string,NO_QUOTES);
		$string = strip_tags($string);
		//$string = preg_replace ('/<[^>]*>/', ' ', $string); 		
		 
		// ----- remueve los caracteres de control ----- 
		/*$string = str_replace("\r", '', $string);    // --- replace with empty space
		$string = str_replace("\n", ' ', $string);   // --- replace with space
		$string = str_replace("\t", ' ', $string);   // --- replace with space*/
		
		// ----- remueve los espacios multiples ----- 
		//$string = trim(preg_replace('/ {2,}/', ' ', $string));		
			
		// ----- remueve los caracteres raros ----- 
		$string = str_replace("/",'',$string);    // --- replace with empty space
		$string = str_replace("\\",'',$string);    // --- replace with empty space
		$string = str_replace("*",'',$string);    // --- replace with empty space
		$string = str_replace("!",'',$string);    // --- replace with empty space
		$string = str_replace("¿",'',$string);    // --- replace with empty space
		$string = str_replace('"','',$string);    // --- replace with empty space
		$string = str_replace("#",'',$string);    // --- replace with empty space
		$string = str_replace("%",'',$string);    // --- replace with empty space
		$string = str_replace("$",'',$string);    // --- replace with empty space
		$string = str_replace("&",'',$string);    // --- replace with empty space
		$string = str_replace("(",'',$string);    // --- replace with empty space
		$string = str_replace(")",'',$string);    // --- replace with empty space
		$string = str_replace("=",'',$string);    // --- replace with empty space
		$string = str_replace("?",'',$string);    // --- replace with empty space
		$string = str_replace("'",'',$string);    // --- replace with empty space
		$string = str_replace("{",'',$string);    // --- replace with empty space
		$string = str_replace("}",'',$string);    // --- replace with empty space
		$string = str_replace("[",'',$string);    // --- replace with empty space
		$string = str_replace("]",'',$string);    // --- replace with empty space
		$string = str_replace(";",'',$string);    // --- replace with empty space
		//$string = str_replace(".",'',$string);    // --- replace with empty space
		$string = str_replace(",",'',$string);    // --- replace with empty space
		//$string = str_replace("-",'',$string);    // --- replace with empty space
		//$string = str_replace("_",'',$string);    // --- replace with empty space
		$string = str_replace("*",'',$string);    // --- replace with empty space
		$string = str_replace("<",'',$string);    // --- replace with empty space
		$string = str_replace(">",'',$string);    // --- replace with empty space
		
		//  -------------- CBM  ------------------------

		//$string = str_replace("--","",$string);
		$string = str_replace("^","",$string);

		// ----- remueve palabras reservadas SQL -------
		$string = str_ireplace("SELECT","",$string);
		$string = str_ireplace("COPY","",$string);
		$string = str_ireplace("DELETE","",$string);
		$string = str_ireplace("DROP","",$string);
		$string = str_ireplace("DUMP","",$string);
		//$string = str_ireplace(" OR ","",$string);
		$string = str_ireplace("%","",$string);
		$string = str_ireplace("LIKE","",$string);
		$string = str_ireplace("FROM","",$string);		
		$string = str_ireplace("DISTINCT","",$string);				
		//$string = str_ireplace("ALL","",$string);	
		$string = str_ireplace("FILE","",$string);					
		$string = str_ireplace("OUTFILE","",$string);					
		$string = str_ireplace("HAVING","",$string);
		$string = str_ireplace("INTO","",$string);	
		$string = str_ireplace("GROUP","",$string);	
		$string = str_ireplace("ORDER","",$string);		
		$string = str_ireplace("WHERE","",$string);	
		// ------------- FIN CBM  ---------------------

		$string = addslashes($string);
		return $string;
	}
}