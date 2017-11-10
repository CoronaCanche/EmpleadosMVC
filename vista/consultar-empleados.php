<?php
include_once '../controlador/validar-sesiones.php';
include_once '../modelo/empleados.php';
$modelo_empleado = new empleados();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SILAB | CONSULTAR COTIZACIONES</title>
        <link href="../img/favicon.ico" rel='shortcut icon' type='image/x-icon'>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include_once '../vista/header.php'; ?>
            <?php include_once '../vista/side-bar.php'; ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Consultar
                        <small>SIASA</small>
                    </h1>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <table id="tabla_empl" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>Nombre Empleado</th>
                                                <th>Estatus</th>
                                                <th>Area</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rs = $modelo_empleado->show_empleados();
                                            while (!$rs->EOF) {
                                                ?>
                                                <tr id="tr-<?php echo $rs->fields[0] ?>">
                                                    <td class="text-center">
                                                        <?php
                                                        if ($rs->fields[1]) {
                                                            
                                                        }
                                                        ?>
                                                        <a href="../vista/editar-empleado.php?empl_edit=<?php echo $rs->fields[0] ?>" title="Editar Empleado" class="text-success"><span class="fa fa-pencil pull-left"></span></a>
<!--                                                        <a href="#" title="Archivar Empleado" class="text-danger" onclick="archivar_empleado('<?php echo $rs->fields[0] ?>');"><span class="fa fa-remove"></span></a>-->
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo utf8_decode($rs->fields[1]); ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php 
                                                            if($rs->fields[2] == 'A')
                                                                {
                                                                    echo 'Activo';
                                                                }
                                                            else
                                                                {
                                                                    echo 'Inactivo';
                                                                }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php 
                                                            $rs2 = $modelo_empleado->get_area_name($rs->fields[3]); 
                                                            echo utf8_decode($rs2->fields[0]);
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $rs->MoveNext();
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>Nombre Empleado</th>
                                                <th>Estatus</th>
                                                <th>Area</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="ModalCargando" class="modal fade" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cargando...</h4>
                        </div>
                        <div class="modal-body">
                            <p>Espere un momento, ya que los datos están siendo procesados.</p>
                            <div class="progress progress-striped active">
                                <div class="bar progress-bar progress-bar-success" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.1
                </div>
                <strong>Copyright &copy; 2017 <a href="#">SIASA - SERVICIO INTEGRAL A LA AGROINDUSTRIA S.A. DE C.V</a>.</strong> Todos los Derechos Reservados.
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../plugins/datatables/jquery.dataTables.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="../plugins/fastclick/fastclick.js"></script>
        <script src="../dist/js/app.min.js"></script>
        <script src="../dist/js/demo.js"></script>
        <script src="../js/empleados.js"></script><!--NO LLEGA A ESTA LIGA-->
        <script>
                                                        $(function () {
                                                            $("#tabla_empl").DataTable();
                                                            $('#example2').DataTable({
                                                                "paging": true,
                                                                "lengthChange": false,
                                                                "searching": false,
                                                                "ordering": true,
                                                                "info": true,
                                                                "autoWidth": false
                                                            });
                                                        });
        </script>
        <script>
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
        </script>
        <div id="respuesta_post"></div>
    </body>
</html>