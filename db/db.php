<?php

class Conectar{
	private $conexion;

	/*public function conectar(){
		if (!isset($this->conexion)) {
			$this->conexion=mysqli_connect("10.42.1.73","licitaciones","l1c1t4c10n3s","uci_v2") or die ("Problemas en la conexion".mysqli_error());
		}
	}*/
	public function conectar(){
		if (!isset($this->conexion)) {
			$this->conexion=mysqli_connect("10.42.1.89","root","merlin","requerimientos") or die ("Problemas en la conexion".mysqli_error());
		}
	}
	public function consulta($sql){
		$resultado=mysqli_query($this->conexion,$sql);
		if (!$resultado) {
			echo "Error mysql".mysqli_error();
			exit;
		}
		return $resultado;
	}
	function rows($res){
		if (!is_resource($res)) {
			return mysqli_num_rows($res);
		}
	}
	function fetch_assoc($res){
		if (!is_resource($res)) {
			return mysqli_fetch_assoc($res);
		}
	}
	public function cerrar(){
		mysqli_close();
	}
}