$(document).ready(function() {
    $("#venta").submit(function(e){
        e.preventDefault();
    });
    $("#bicicletasColor").click(function() {
        
        filtro = 'color';
        value = 'azul';
        bicicletas(filtro,value);
    });

    $("#altaVenta").click(function(){
        var datos = new FormData();
        var foto = $("#imagenBici")[0];
        datos.append('id', $("#idBici").val());
        datos.append('nombre', $("#nombreBici").val());
        datos.append('fecha', $("#fechaBici").val());
        datos.append('precio', $("#precioBici").val());
        datos.append('imagen', foto.files[0]);
        

        $.ajax({
            url:'operaciones/alta',
            type: "POST",
            processData: false,
            contentType: false,
            async: true,
            data: datos,
        }).then(bien, error);
    })
    $("#modificarVenta").click(function(){
        
        
        var id = $("#idBici").val();
        var nombre = $("#nombreBici").val();
        var fecha  = $("#fechaBici").val();
        var precio = $("#precioBici").val();
        
        var urlPut = 'operaciones/modificar/' + id + '/' + nombre + '/' + fecha + '/' + precio

        $.ajax({
            url: urlPut,
            type: "PUT",
        }).then(bien, error);
    })
});
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
        var urlPeticion = 'bicicletas/traer/' + filtroKey + "/" + value;
        $.ajax({
            url:urlPeticion,
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

function altaBicicleta(){
    var colorBici ="trucho";
    var marcaBici ="patito";
    var rodadoBici = 99;
    $.ajax({
        url:'bicicletas/nueva',
        type: "POST",
        data: {color: colorBici, marca: marcaBici, rodado: rodadoBici },
    }).then(bien, error);
}


function borrarBicicleta(){
    var idBici = 8;
    $.ajax({
        url:'bicicletas/borrar',
        type: "DELETE",
        data: {id: idBici},
    }).then(bien, error);
}


function bien(data){
    console.info(data);
}
function error(data){
    console.info(data);
}