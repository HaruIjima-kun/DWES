var enlace = document.getElementById("enlace_login");
var enlace2 = document.getElementById("registro");
var form_inicio = document.getElementById("form_inicio_sesion");
var form_registro = document.getElementById("form_registro");

enlace.addEventListener("click", function (e) {
    e.preventDefault();
    form_inicio.classList.toggle('opacity');
    form_inicio.classList.toggle('hidden');
    form_registro.classList.toggle('opacity');
    form_registro.classList.toggle('hidden');
});

enlace2.addEventListener("click", function (e) {
    e.preventDefault();
    form_inicio.classList.toggle('opacity');
    form_inicio.classList.toggle('hidden');
    form_registro.classList.toggle('opacity');
    form_registro.classList.toggle('hidden');
});
