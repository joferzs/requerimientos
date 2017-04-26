function ir(name,value){
	var body = document.body;
	form = document.createElement('form');
	form.method = 'POST';
	form.action = 'index.php';
	form.name = 'jsform';
	var input = document.createElement('input');
	input.type = 'hidden';
	input.name = name;
	input.id = name;
	input.value = value;
	form.appendChild(input);
	body.appendChild(form);
	form.submit();
}
function mi_alerta_eliminar(section,id){
	confirmar=confirm("El registro ser\u00E1 eliminado. Desea continuar?");
	if (confirmar){
		//alert("eliminarProgAsig.php?id_programa="+x);
		window.location="index.php?section="+section+"&elim="+id;
	}
}
function pagina(y,x){
	$.post("index.php",{pagePaginador:y,pagina:x},function(data){$("#result").html(data);});
}
function serieVal(y,x,w){
	if (w == x) {
		x="123456789qwersadfzxcv";
	}
	$.post("index.php",{jsFunc:y,value:x},function(data){$("#result").html(data);});
}