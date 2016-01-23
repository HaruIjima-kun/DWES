$('.toggle').on('click', function () {
    $('.container').stop().addClass('active');
});

$('.close').on('click', function () {
    $('.container').stop().removeClass('active');
});

var email = document.getElementById("email");
var password = document.getElementById("password");
var confirm_password = document.getElementById("confirm_password");
var boton = document.getElementById("boton_registrar");

function validatePassword() {
    var pass1 = password.value;
    var pass2 = confirm_password.value;

    if (pass1 === pass2) {
        confirm_password.setCustomValidity('');

    } else {
        confirm_password.setCustomValidity("Las contraseñas no coinciden");

    }
}
function validarEmail() {
    var exp = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
    if (exp.test(email.value)) {
        alert("La dirección de email " + email.value + " es correcta.")
        return (true)
    } else {
        alert("La dirección de email es incorrecta.");
        return (false);
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;


