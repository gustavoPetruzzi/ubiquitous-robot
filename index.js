$(document).ready(function() {
    $("#bicicletasColor").click(function() {
        var  filtro = 'color';
        var  value = 'azul';
        bicicletas(filtro,value);
    });
	$("#traerBicicleta").click(function() {
        var id = 1;
	    unaBicicleta(id);
	});

	$("#borrarBicicletaButton").click(function() {
		var idBorrar = 6;
		borrarBicicleta(idBorrar);
	});
});

function borrarBicicleta(idBici){
	$.ajax({
		url:'bicicletas/borrar',
		type:'DELETE',
		data: { id : idBici }
	}).then(bien,error); 
}


function unaBicicleta(id){
    $.ajax({
		url: 'bicicletas/traer/' + id,
		type: 'GET',
    }).then(bien, error);
}

function verificarUsuario(){
    var mailUsuario = "admin@admim.com.ar";
    var nombreUsuario = "juan";
    var claveUsuario = "1161a";
    $.ajax({
        url: 'usuarios/verificar',
        type:"POST",
        data: { mail : mailUsuario, nombre: nombreUsuario, clave: claveUsuario},

    }).then(bien, error)
};

function bicicletas(filtroKey, value){
    if(filtroKey!== undefined){
        vrl = 'bicicletas/filtrado/' + filtroKey + '/' +value;
        $.ajax({
            url:vrl,
            type: "GET",
            
        }).then(bien, error);
    }
    
    else{
        $.ajax({
            url:'bicicletas/traer',
            type: "GET",
        }).then(bien, error);
    }
    
}


function bien(data){
    console.info(data);
}
function error(data){
	console.info(data);
}
