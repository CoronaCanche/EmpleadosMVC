function valida_usuario() {
    var pagina = $("#login_form").serialize();
    console.log(pagina);
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: pagina + "&opc=1",
        cache: false,
        success: function (data) {
            console.log(data);
            if (data == "valido")
                window.location.href = "../vista/silab.php";

            //$("#respuesta_post").html(data);
        }
    });
}

function recuperar_password()
{
    var pagina = $("#reset_password").serialize();
    var url = "../controlador/ctr-correos.php";
    $.ajax({
        type: "POST",
        url: url,
        data: pagina + "&opc=1",
        cache: false,
        success: function (data) {
            //console.log(data);
            if (data == "Enviado")
                $("#msjCorreo").html("Tu contraseña se ha enviado al correo");
            else
                $("#msjCorreo").html(data);
        }
    });
}
//$('#btnValidar').click(valida_usuario())

$('.message a').click(function () {
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});

function actualizar_empleados() {
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: "opc=4",
        cache: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            $("#contenedor_gral").html(data);
        }
    });
}

function RegistrarEmpl() {
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: $("#formAddEmpl").serialize() + "&opc=3",
        cache: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            alert('Se Agrego Exitosamente');
            window.history.back()
        }
    });
}

function archivar_empleado(ide) {
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: "ide_archivar=" + ide + "&opc=5",
        cache: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            $("#respuesta_post").html(data);
        }
    });
}

function enviar_actualizar_empleado() {
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: $("#form_empleado_update").serialize() + "&opc=6",
        cache: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            alert('Actualización Exitosa');
            window.history.back()
        }
    });
}

function subir_firma_empleado() {
    var url = "../controlador/ctr-empleados.php";
//    var data = new FormData();
//    jQuery.each(jQuery('#file')[0].files, function (i, file) {
//        data.append('file-' + i, file);
//    });
//    data.append('opc','7');
    var data = new FormData();
    data.append('opc', 7);
    data.append('file', document.getElementById('my-file-selector').files[0]);
    data.append('ide_empl', document.getElementById('ide_empl').value);
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            alert(data);
        }
    });
}

function view_data_area_update(area) {
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: "area=" + area + "&opc=8",
        cache: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            $("#contenedor-post").html(data);
        }
    });
}

function actualizar_area(area) {
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: $("#form-upd-area").serialize() + "&area=" + area + "&opc=9",
        cache: false,
        beforeSend: function () {
            $("#modal-info_area").modal('hide');
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            $("#example1").load(location.href + " #example1");
        }
    });
}

function delete_area(area) {
    var r = confirm("¿Estas seguro de eliminar el area?");
    if (r == true) {
        var url = "../controlador/ctr-empleados.php";
        $.ajax({
            type: "POST",
            url: url,
            data: "area=" + area + "&opc=10",
            cache: false,
            beforeSend: function () {
                $("#ModalCargando").modal("show");
            },
            success: function (data) {
                $("#ModalCargando").modal("hide");
                $("#example1").load(location.href + " #example1");
            }
        });
    }
}

function view_data_rol_update(rol) {
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: "rol=" + rol + "&opc=11",
        cache: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            $("#contenedor-post").html(data);
        }
    });
}

function actualizar_rol(rol) {
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: $("#form-upd-rol").serialize() + "&rol=" + rol + "&opc=12",
        cache: false,
        beforeSend: function () {
            $("#modal-info_rol").modal('hide');
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            $("#example2").load(location.href + " #example2");
        }
    });
}

function delete_rol(rol) {
    var r = confirm("¿Estas seguro de eliminar el rol?");
    if (r == true) {
        var url = "../controlador/ctr-empleados.php";
        $.ajax({
            type: "POST",
            url: url,
            data: "rol=" + rol + "&opc=13",
            cache: false,
            beforeSend: function () {
                $("#ModalCargando").modal("show");
            },
            success: function (data) {
                $("#ModalCargando").modal("hide");
                $("#example2").load(location.href + " #example2");
            }
        });
    }
}

function show_modal_add_area() {
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: "opc=14",
        cache: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            $("#respuesta_post").html(data);
        }
    });
}

function RegistrarArea(){
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: $("#formAddArea").serialize() + "&opc=15",
        cache: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            //$("#tablaPam").load(location.href + " #tablaPam");
            location.reload();
        }
    });
}

function show_modal_add_rol() {
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: "opc=16",
        cache: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            $("#respuesta_post").html(data);
        }
    });
}

function RegistrarRol(){
    var url = "../controlador/ctr-empleados.php";
    $.ajax({
        type: "POST",
        url: url,
        data: $("#formAddRol").serialize() + "&opc=17",
        cache: false,
        beforeSend: function () {
            $("#ModalCargando").modal("show");
        },
        success: function (data) {
            $("#ModalCargando").modal("hide");
            //$("#tablaPam").load(location.href + " #tablaPam");
            location.reload();
        }
    });
}