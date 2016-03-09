var boton = document.getElementsByClassName("borrar");
var formulario = document.getElementById("form_delete_user");
for (var i = 0; i < boton.length; i++) {
    boton[i].addEventListener("click", function(e) {

        /*swal({
            title: '¿Estás seguro?',
            text: '¡No podrás recuperar el usuario borrado!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'No, cancelar',
            confirmButtonClass: 'confirm-class',
            cancelButtonClass: 'cancel-class',
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                swal('¡Borrado!', '¡El usuario ha sido borrado!', 'success');
            }
            else {
                e.preventDefault();
                swal('Cancelado', 'El usuario está seguro :)', 'error');
            }
        });*/

        /*swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this imaginary file!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false
        }, function() {
            swal('Deleted!', 'Your file has been deleted.', 'success');
        });*/


        /*var eliminar = confirm("¿Está seguro de que desea borrar a este usuario?");
        if (!eliminar) {
            e.preventDefault();
        }
        else {
            alert("El usuario ha sido borrado");
        }*/
    }, false);
}