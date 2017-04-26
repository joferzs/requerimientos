<?php

require_once("controllers/LoginController.php");
require_once("controllers/ArticulosController.php");

$mvc = new LoginController();

if (isset($_POST['login'])) {
	$mvc->validar($_POST['usuario'],$_POST['clave']);
}elseif (isset($_GET['page'])) {
	$mvc->page($_GET['page']);
}
else{
	$mvc->login();
}

?>