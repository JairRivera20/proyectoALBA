var ojo = document.getElementById('ojo');
var input = document.getElementById('contraseña');

ojo.addEventListener('click', mostrarContraseña);

function mostrarContraseña(){
    if (input.type == "password") {
        
        input.type = "text";
        
        setTimeout("ocultar()", 2000);
    }else{

        input.type = "password";

    }


}

function ocultar(){
    input.type = "password";
}