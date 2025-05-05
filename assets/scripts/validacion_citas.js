//Recogemos todos los inputs del formulario que queramos validar y los guardamos en variables
const formulario = document.getElementById("form_citas");
const fcitaInput = document.getElementById("fcita");
const asuntoInput = document.getElementById("asunto");

//Funciones para validar formulario
function validarAsunto(){
    const asunto = asuntoInput.value;
    const asuntoVal = /^[a-zA-Z0-9a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s,º]{1,250}$/;
    if(asuntoVal.test(asunto)){
        asuntoInput.classList.add('valido');
        asuntoInput.classList.remove('invalido');
        document.getElementById('asuntoError').textContent = "";
    }else{
        asuntoInput.classList.add('invalido');
        asuntoInput.classList.remove('valido');
        document.getElementById('asuntoError').textContent = "El asunto debe tener máximo 250 caracteres";
    }
}
//Función para establecer el mínimo de fecha en el día actual
function ponerMinHoy(input){
    const hoy = new Date();
    const anyo = hoy.getFullYear();
    const mes = String(hoy.getMonth() + 1).padStart(2, '0');
    const dia = String(hoy.getDate()).padStart(2, '0');
    const hoyText = `${anyo}-${mes}-${dia}`;
    input.min = hoyText;
}
function validarFcitas(){
    const fecha = fcitaInput.value;
    ponerMinHoy(fcitaInput);
    if(!fecha){
        fcitaInput.classList.add('invalido');
        fcitaInput.classList.remove('valido');
        document.getElementById('fcitaError').textContent = "Por favor, introduce una fecha.";
    } else if(fecha > fnacInput.max){
        fcitaInput.classList.add('invalido');
        fcitaInput.classList.remove('valido');
        document.getElementById('fcitaError').textContent = "La fecha no puede ser pasada.";
    } else{
        fcitaInput.classList.add('valido');
        fcitaInput.classList.remove('invalido');
        document.getElementById('fcitaError').textContent = "";
    }
}

//Función para resetear los estados de los campos del formulario.
function resetFormulario(){
    fcitaInput.classList.remove('valido');
    asuntoInput.classList.remove('valido');
}

fcitaInput.addEventListener('input', validarFcitas);
asuntoInput.addEventListener('input', validarAsunto);

//Comprobamos de nuevo y gestionamos si se envía el formulario o no
formulario.addEventListener('submit', function(event){
    validarFcitas();
    validarAsunto();
    if(fcitaInput.classList.contains('valido') && asuntoInput.classList.contains('valido')){
        alert("Formulario enviado correctamente");
        resetFormulario();
        formulario.submit();
    } else {
        event.preventDefault();
        alert("Por favor, corrija los errores del formulario");
    }
})