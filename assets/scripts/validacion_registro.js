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
    const nombreVal = /^[a-zA-Z ]{1,30}$/;
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
    const apellidosVal = /^[a-zA-Z ]{1,60}$/;
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
    const telefonoVal = /^[0-9\+]{1,12}$/;
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
    const passwordVal = "/^(?=.*[A-Z])(?=.*\d)(?=.*[.,_\-])[a-zA-Z\d.,_\-]{4,10}$/";
    if(passwordVal.test(password)){
        passwordInput.classList.add('valido');
        passwordInput.classList.remove('invalido');
        document.getElementById('passwordError').textContent = "";
    }else{
        passwordInput.classList.add('invalido');
        passwordInput.classList.remove('valido');
        document.getElementById('passwordError').textContent = "Introduce un correo electrónico válido";
    }
}
function validarFnac(){
    const fnac = fnacInput.value;
    const fnacVal = "/^([0][1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/\d{4}$/";
    if(fnacVal.test(fnac)){
        fnacInput.classList.add('valido');
        fnacInput.classList.remove('invalido');
        document.getElementById('fnacError').textContent = "";
    }else{
        fnacInput.classList.add('invalido');
        fnacInput.classList.remove('valido');
        document.getElementById('fnacError').textContent = "La fecha deberá constar de 2 dígitos para el día, primero. 2 dígitos para el mes, segundo. Y por último 4 dígitos para el año";
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
















function resetFormulario(){
    formulario.reset();
    nombreInput.classList.remove('valido');
    apellidosInput.classList.remove('valido');
    telefonoInput.classList.remove('valido');
    emailInput.classList.remove('valido');
    mensajeInput.classList.remove('valido');
    pagoInput.classList.remove('valido');
    privacidadInput.classList.remove('valido');
}

nombreInput.addEventListener("input", validarNombre);
apellidosInput.addEventListener("input", validarApellidos);
telefonoInput.addEventListener("input", validarTelefono);
emailInput.addEventListener("input", validarEmail);
mensajeInput.addEventListener("input", validarMensaje);
pagoInput.addEventListener("input", validarPago);
privacidadInput.addEventListener("input", validarPrivacidad);

//Calcular presupuesto
document.addEventListener('DOMContentLoaded', function(){
    const formacionSelect = document.getElementById("selectFormacion");
    const pagosSelect = document.getElementById("pago");
    const extraPrueba = document.querySelectorAll(".extra");
    const resultadoInput = document.getElementById("presupuesto");

    function calcularPresupuesto(){
        let totalFormacion = 0;

        const formacion = parseFloat(formacionSelect.value);
        if(!isNaN(formacion)){
            totalFormacion += formacion;
        }

        const pagos = parseFloat(pagosSelect.value);
        let pagoDescuento = 0;
        if(!isNaN(pagos)){
            switch(pagos){
                case 3:
                    pagoDescuento = 0.10;
                    break;
                case 6:
                    pagoDescuento = 0.15;
                    break;
                default:
                    pagoDescuento = 0;
            }
        }

        let extraResultado = 0;
        extraPrueba.forEach(function(extra){
            if(extra.checked){
                extraResultado += parseFloat(extra.value);
            }
        });

        let temporalSuma = totalFormacion + extraResultado;
        let temporalDescuento = temporalSuma * pagoDescuento;
        let presupuestoTotal = temporalSuma - temporalDescuento;
        if(pagos === 3){
            resultadoInput.value = presupuestoTotal*3 + "€ cada 3 meses";
        }else if(pagos === 6){
            resultadoInput.value = presupuestoTotal*6 + "€ cada 6 meses";
        }else{
            resultadoInput.value = presupuestoTotal + "€ cada mes";
        }
    };

    formacionSelect.addEventListener('change', calcularPresupuesto);
    pagosSelect.addEventListener('change', calcularPresupuesto);
    
    extraPrueba.forEach(function(extra){
        extra.addEventListener("change", calcularPresupuesto);
    })
})

//Envío formulario una vez que hayamos comprobado de nuevo.
formulario.addEventListener("submit", function(event){
    event.preventDefault();
    validarNombre();
    validarApellidos();
    validarTelefono();
    validarEmail();
    validarMensaje();
    validarPago();
    validarPrivacidad();
     if(nombreInput.classList.contains('valido') && apellidosInput.classList.contains('valido') && telefonoInput.classList.contains('valido') && emailInput.classList.contains('valido') && mensajeInput.classList.contains('valido') && pagoInput.classList.contains('valido') && privacidadInput.classList.contains('valido')){
        alert("Formulario enviado correctamente");
        resetFormulario();
        formulario.submit();
     }else{
        alert("Por favor, corrija los errores en el formulario");
     }
})
