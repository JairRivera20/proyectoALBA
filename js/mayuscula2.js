let inputs = document.getElementsByClassName("mayuscula");

    // Iterar sobre los inputs con la clase "uppercase-input"
    for(let i = 0; i < inputs.length; i++) {
        // Verificar si la primera letra de cada palabra es minúscula al ingresar caracteres
        inputs[i].addEventListener("input", function() {
            inputs[i].value = inputs[i].value.replace(/\b[a-z]/g,function(f){return f.toUpperCase();});
        });
    }