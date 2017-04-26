<?php

require_once("controllers/Controller.php");

class LoginController extends Controller{
	function login($val=""){
		$page = $this->load_page("views/page.html");
		$page=$this->replace_content("/\#USUARIO\#/ms", "", $page);
		$login = $this->load_page("views/login/login.html");
		$login = $this->replace_content("/\#ERROR\#/ms", $val, $login);
		$html =	$this->replace_content("/\#CONTENIDO\#/ms", $login, $page);
		$this->view_page($html);
	}
	function validar($usuario, $clave){
		$usr=$this->limpiarCadena($usuario);
		$clv=$this->limpiarCadena($clave);
		$validar= new Req();
		$validar=$validar->get_validacion($usr, $clv);
		if ($validar != 0) {
			$session = $this->session_var($validar);
			if ($session['tipoUsuarioReq'] == 1) {
				header("location: index.php?page=menuAdmin");
			}else{
				header("location: index.php?page=menuUsuario");
			}
		}else{
			$val="EL usuario o contrase&ntilde;a con incorrectos";
			$header = $this->load_page("views/page.html");
			$header=$this->replace_content("/\#USUARIO\#/ms", "", $header);
			$login = $this->load_page("views/login/login.html");
			$login = $this->replace_content("/\#ERROR\#/ms", $val, $login);
			$html =	$this->replace_content("/\#CONTENIDO\#/ms", $login, $header);
			$this->view_page($html);
		}
	}
}