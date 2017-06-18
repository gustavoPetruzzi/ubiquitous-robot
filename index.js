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

function bicicletas(filtro){
    if(filtro!== undefined){
        
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