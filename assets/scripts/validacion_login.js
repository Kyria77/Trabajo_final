//Recogemos todos los inputs del formulario que queramos validar y los guardamos en variables
const formulario = document.getElementById("form_login");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");

//Funciones para validar formulario
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

//Función para resetear los estados de los campos del formulario.
function resetFormulario(){
    formulario.reset();
    emailInput.classList.remove('valido');
    passwordInput.classList.remove('valido');
}

emailInput.addEventListener('input', validarEmail);
passwordInput.addEventListener('input', validarPassword);

//Comprobamos de nuevo y gestionamos si se envía el formulario o no
formulario.addEventListener('submit', function(event){
    event.preventDefault();
    validarEmail();
    validarPassword();
    if(emailInput.classList.contains('valido') && passwordInput.classList.contains('valido')){
        alert("Formulario enviado correctamente");
        resetFormulario();
        formulario.submit();
    } else {
        alert("Por favor, corrija los errores del formulario");
    }
})