$(document).ready(function() {
    $("#bicicletasColor").click(function() {
        
        filtro = 'color';
        value = 'azul';
        bicicletas(filtro,value);
    });
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
        var urlPeticion = 'bicicletas/traer/' + filtroKey;
        $.ajax({
            url:urlPeticion,
            type: "GET",
            data: {filtro: filtroKey, valor: value}
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

}