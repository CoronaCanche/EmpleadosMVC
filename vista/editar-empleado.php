<?php
include_once '../controlador/validar-sesiones.php';
include_once '../modelo/empleados.php';
$modelo_empleado = new empleados();
$empl = $_GET['empl_edit'];
$_SESSION['empl'] = $empl;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SILAB | EDITAR EMPLEADOS</title>
        <link href="../img/favicon.ico" rel='shortcut icon' type='image/x-icon'>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="../css/te/AdminLTE.min.css">
        <link rel="stylesheet" href="../css/te/_all-skins.min.css">
        <link rel="stylesheet" href="../css/te/iCheck/flat/blue.css">
        <link rel="stylesheet" href="../css/te/morris.css">
        <link rel="stylesheet" href="../css/te/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="../css/te/datepicker/datepicker3.css">
        <link rel="stylesheet" href="../css/te/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="actualizar_empleados()">
        <div class="wrapper">

            <?php include_once '../vista/header.php'; ?>
            <?php include_once '../vista/side-bar.php'; ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <?php
                    $rs = $modelo_empleado->Get_empleado($empl);
                    ?>
                    <h1>
                        Editar Información de <?= utf8_decode($rs->fields[1]); ?>
                        <small>SIASA</small>
                    </h1>
                </section>
                <section class="content" id="contenedor_gral">

                    <div class="box box-default">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div onload="actualizar_empleados()">

                            </div>
                        </div>
                        <div class="box-footer" id="detalle_empl_contenedor">
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
        <script src="../js/te/jquery-2.2.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script>
                                $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../plugins/select2/select2.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../js/te/morris.min.js"></script>
        <script src="../js/te/jquery.sparkline.min.js"></script>
        <script src="../js/te/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="../js/te/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../js/te/jquery.knob.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="../js/te/bootstrap3-wysihtml5.all.min.js"></script>
        <script src="../js/te/jquery.slimscroll.min.js"></script>
        <script src="../js/te/fastclick.min.js"></script>
        <script src="../js/te/app.min.js"></script>
        <script src="../js/te/dashboard.js"></script>
        <script src="../js/te/demo.js"></script>
        <script src="../js/funciones_gral.js"></script>
        <script src="../js/empleados.js"></script>
        <div id="respuesta_post"></div>
    </body>
</html>