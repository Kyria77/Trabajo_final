//Recogemos todos los inputs del formulario que queramos validar y los guardamos en variables
const formulario = document.getElementById("form_registro");
const nombreInput = document.getElementById("nombre");
const apellidosInput = document.getElementById("apellidos");
const telefonoInput = document.getElementById("telefono");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const fnacInput = document.getElementById("fnac");
const direccionInput = document.getElementById("direccion");
const privacidadInput = document.getElementById("privacidad");

//Funciones para validar formulario
function validarNombre(){
    const nombre = nombreInput.value;
    const nombreVal = /^[a-zA-Z ]{2,30}$/;
    if(nombreVal.test(nombre)){
        nombreInput.classList.add('valido');
        nombreInput.classList.remove('invalido');
        document.getElementById('nombreError').textContent = "";
    }else{
        nombreInput.classList.add('invalido');
        nombreInput.classList.remove('valido');
        document.getElementById('nombreError').textContent = "El nombre solo puede contener letras y tener máximo 25 caracteres";
    }
}
function validarApellidos(){
    const apellidos = apellidosInput.value;
    const apellidosVal = /^[a-zA-Z ]{2,60}$/;
    if(apellidosVal.test(apellidos)){
        apellidosInput.classList.add('valido');
        apellidosInput.classList.remove('invalido');
        document.getElementById('apellidosError').textContent = "";
    }else{
        apellidosInput.classList.add('invalido');
        apellidosInput.classList.remove('valido');
        document.getElementById('apellidosError').textContent = "Los apellidos solo puede contener letras y tener máximo 60 caracteres";
    }
}
function validarTelefono(){
    const telefono = telefonoInput.value;
    const telefonoVal = /^[0-9]{1,12}$/;
    if(telefonoVal.test(telefono)){
        telefonoInput.classList.add('valido');
        telefonoInput.classList.remove('invalido');
        document.getElementById('telefonoError').textContent = "";
    }else{
        telefonoInput.classList.add('invalido');
        telefonoInput.classList.remove('valido');
        document.getElementById('telefonoError').textContent = "El teléfono solo puede contener números y tener como máximo 9 caracteres";
    }
}
function validarEmail(){
    const email = emailInput.value;
    const emailVal = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
    if(emailVal.test(email)){
        emailInput.classList.add('valido');
        emailInput.classList.remove('invalido');
        document.getElementById('emailError').textContent = "";
    }else{
        emailInput.classList.add('invalido');
        emailInput.classList.remove('valido');
        document.getElementById('emailError').textContent = "Introduce un correo electrónico válido";
    }
}
function validarPassword(){
    const password = passwordInput.value;
    const passwordVal = /^(?=.*[A-Z])(?=.*\d)(?=.*[.,_\-])[a-zA-Z\d.,_\-]{4,10}$/;
    if(passwordVal.test(password)){
        passwordInput.classList.add('valido');
        passwordInput.classList.remove('invalido');
        document.getElementById('passwordError').textContent = "";
    }else{
        passwordInput.classList.add('invalido');
        passwordInput.classList.remove('valido');
        document.getElementById('passwordError').textContent = "La contraseña debe ser entre 4 y 10 caracteres y contener mayúscula, minúscula, 1 número y un caracter especial";
    }
}
function validarDireccion(){
    const direccion = direccionInput.value;
    const direccionVal = /^[a-zA-Z0-9 ,º]{1,150}$/;
    if(direccionVal.test(direccion)){
        direccionInput.classList.add('valido');
        direccionInput.classList.remove('invalido');
        document.getElementById('direccionError').textContent = "";
    }else{
        direccionInput.classList.add('invalido');
        direccionInput.classList.remove('valido');
        document.getElementById('direccionError').textContent = "Los apellidos solo puede contener letras y tener máximo 60 caracteres";
    }
}
function validarPrivacidad(){
    if(privacidadInput.checked){
        privacidadInput.classList.add('valido');
        privacidadInput.classList.remove('invalido');
        document.getElementById('privacidadError').textContent = "";
    }else{
        privacidadInput.classList.add('invalido');
        privacidadInput.classList.remove('valido');
        document.getElementById('privacidadError').textContent = "Acepte la política de privacidad";
    }
}
//Función para establecer el máximo de fecha en el día actual
function ponerMaxHoy(input){
    const hoy = new Date();
    const anyo = hoy.getFullYear();
    const mes = String(hoy.getMonth() + 1).padStart(2, '0');
    const dia = String(hoy.getDate()).padStart(2, '0');
    const hoyText = `${anyo}-${mes}-${dia}`;
    input.max = hoyText;
}
function validarFnac(){
    const fecha = fnacInput.value;
    ponerMaxHoy(fnacInput);
    if(!fecha){
        fnacInput.classList.add('invalido');
        fnacInput.classList.remove('valido');
        document.getElementById('fnacError').textContent = "Por favor, introduce una fecha.";
    } else if(fecha > fnacInput.max){
        fnacInput.classList.add('invalido');
        fnacInput.classList.remove('valido');
        document.getElementById('fnacError').textContent = "La fecha no puede ser futura.";
    } else{
        fnacInput.classList.add('valido');
        fnacInput.classList.remove('invalido');
        document.getElementById('fnacError').textContent = "";
    }
}

//Función para resetear los estados de los campos del formulario.
function resetFormulario(){
    formulario.reset();
    nombreInput.classList.remove('valido');
    apellidosInput.classList.remove('valido');
    telefonoInput.classList.remove('valido');
    emailInput.classList.remove('valido');
    passwordInput.classList.remove('valido');
    fnacInput.classList.remove('valido');
    direccionInput.classList.remove('valido');
    privacidadInput.classList.remove('valido');
}

nombreInput.addEventListener('input', validarNombre);
apellidosInput.addEventListener('input', validarApellidos);
telefonoInput.addEventListener('input', validarTelefono);
emailInput.addEventListener('input', validarEmail);
passwordInput.addEventListener('input', validarPassword);
fnacInput.addEventListener('input', validarFnac);
direccionInput.addEventListener('input', validarDireccion);
privacidadInput.addEventListener('input', validarPrivacidad);

//Comprobamos de nuevo y gestionamos si se envía el formulario o no
formulario.addEventListener('submit', function(event){
    event.preventDefault();
    validarNombre();
    validarApellidos();
    validarTelefono();
    validarEmail();
    validarPassword();
    validarFnac();
    validarDireccion();
    validarPrivacidad();
    if(nombreInput.classList.contains('valido') && apellidosInput.classList.contains('valido') && telefonoInput.classList.contains('valido') && emailInput.classList.contains('valido') && passwordInput.classList.contains('valido') && fnacInput.classList.contains('valido') && direccionInput.classList.contains('valido') && privacidadInput.classList.contains('valido')){
        alert("Formulario enviado correctamente");
        resetFormulario();
        formulario.submit();
    } else {
        alert("Por favor, corrija los errores del formulario");
    }
})

