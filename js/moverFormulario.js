const movPag = document.querySelector(".movPag");
const siguiente = document.querySelector(".siguiente");

const atras1 = document.querySelector(".atras1"); 
const siguiente2 = document.querySelector(".siguiente2");

const atras2 = document.querySelector(".atras2"); 
const siguiente3 = document.querySelector(".siguiente3");

const atras3 = document.querySelector(".atras3"); 
const siguiente4 = document.querySelector(".siguiente4");

const atras4 = document.querySelector(".atras4"); 

    /* botones siguiente */

    siguiente.addEventListener("click", function(e){
        e.preventDefault();
    
        movPag.style.marginLeft = "-100%";
    
    });

    siguiente2.addEventListener("click", function(e){
        e.preventDefault();
    
        movPag.style.marginLeft = "-200%";
    
    });

    siguiente3.addEventListener("click", function(e){
        e.preventDefault();
    
        movPag.style.marginLeft = "-300%";
    
    });
    
    siguiente4.addEventListener("click", function(e){
        e.preventDefault();
    
        movPag.style.marginLeft = "-400%";
    
    });


    /* botones atras */

    atras1.addEventListener("click", function(e){
        e.preventDefault();
    
        movPag.style.marginLeft = "0%";
    
    });

    atras2.addEventListener("click", function(e){
        e.preventDefault();
    
        movPag.style.marginLeft = "-100%";
    
    });

    atras3.addEventListener("click", function(e){
        e.preventDefault();
    
        movPag.style.marginLeft = "-200%";
    
    });

    atras4.addEventListener("click", function(e){
        e.preventDefault();
    
        movPag.style.marginLeft = "-300%";
    
    });



