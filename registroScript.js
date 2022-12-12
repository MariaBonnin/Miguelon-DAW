var primeraVuelta = false;

window.addEventListener("load", (e) => {
    document.getElementById("button-submit").setAttribute('disabled', '');

    Array.from(document.getElementsByClassName("reg-input")).forEach(entrada => {
        entrada.addEventListener("focusout", (event) => {
            gestionarValidaciones(entrada);

            let nombre = document.getElementById("nombre").value;
            let email = document.getElementById("email").value;
            let contrasena = document.getElementById("contrasena").value;
            let confContras = document.getElementById("confContras").value;
            let code = document.getElementById("codigo").value;
            if(nombre !="" && comprobarEmail(email) && contrasena == confContras && contrasena!="" && code !=""){

                document.getElementById("button-submit").removeAttribute('disabled');
            } else {
                document.getElementById("button-submit").setAttribute('disabled', '');
            }
        });
    })


})

function gestionarValidaciones(entrada) {
    let caja;
    let contrasena;
    let comprob;
    switch (entrada.id) {
        case "nombre":
            caja = document.getElementById("nombre-error");
            if (entrada.value == "") {
                entrada.classList.add("input-error");
                caja.removeAttribute("hidden");
                
            } else {
                entrada.classList.remove("input-error");
                caja.hidden = true;
            
            }
            break;
        case "email":
            caja = document.getElementById("email-error");
            if (comprobarEmail(entrada.value)) {
                entrada.classList.remove("input-error");
                caja.hidden = true;
            
            } else {
                entrada.classList.add("input-error");
                caja.removeAttribute("hidden");
                
            }
            break;
        case "contrasena":
            caja = document.getElementById("contrasena-error");
            contrasena = document.getElementById("confContras").value;
            comprob = comprobarContras(entrada.value, contrasena);

            if (comprob != 2) {
                if (!comprob) {
                    entrada.classList.add("input-error");
                    document.getElementById("confContras").classList.add("input-error");
                    caja.removeAttribute("hidden");
                    
                } else if (comprob) {
                    entrada.classList.remove("input-error");
                    document.getElementById("confContras").classList.remove("input-error");
                    caja.hidden = true;
                
                }
            }
            break;
        case "confContras":
            caja = document.getElementById("contrasena-error");
            contrasena = document.getElementById("contrasena").value;
            comprob = comprobarContras(entrada.value, contrasena);

            if (comprob != 2) {
                if (!comprob) {
                    entrada.classList.add("input-error");
                    document.getElementById("contrasena").classList.add("input-error");
                    caja.removeAttribute("hidden");
                    
                } else if (comprob) {
                    entrada.classList.remove("input-error");
                    document.getElementById("contrasena").classList.remove("input-error");
                    caja.hidden = true;
                
                }
            }
            break;
        case "codigo":
            caja = document.getElementById("codigo-error");
            if (entrada.value == "") {
                entrada.classList.add("input-error");
                caja.removeAttribute("hidden");
                
            } else {
                entrada.classList.remove("input-error");
                caja.hidden = true;
            
            }
            break;
        default:
            break;
    }
}

function comprobarEmail(value) {
    return (/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/gm.test(value))
}

function comprobarContras(contrasena, confContras) {

    if (contrasena != confContras && primeraVuelta == false) {
        primeraVuelta = true;
        return 2;
    }
    if (contrasena != confContras && primeraVuelta == true) {
        return false;
    }
    if (contrasena == confContras && contrasena != "" && confContras != "") {
        return true;
    }
    return false;
}
