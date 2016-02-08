var boton = document.getElementsByClassName("borrar");

for (var i = 0; i < boton.length; i++) {
    boton[i].addEventListener("click", function(e) {
        var eliminar = confirm("¿Está seguro de que desea borrar a este usuario?");
        if (!eliminar) {
            e.preventDefault();
        }
        else {
            alert("El usuario no ha sido borrado");
        }
    }, false);
}