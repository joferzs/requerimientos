<?php
require_once("db/db.php");

class Req extends Conectar{
	public function get_validacion($usuario, $clave){
		$clv=md5($clave);
		$this->conectar();
		$sql="select * from usuarios where usuario='%s' and clave='%s' and activo='S'";
		$sql=sprintf($sql,$usuario,$clv);
		$query=$this->consulta($sql);
		$this->cerrar();
		$num=$this->rows($query);
		if ($num > 0) {
			$res=$this->fetch_assoc($query);
			return $res;
		}else{
			return false;
		}
	}
}