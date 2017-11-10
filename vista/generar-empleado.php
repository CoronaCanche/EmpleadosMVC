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
        <title>SILAB | EMPLEADOS</title>
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
    <body class="hold-transition skin-blue sidebar-mini fixed"  data-spy="scroll" data-target="#scrollspy">
        <div class="wrapper">
            <?php include_once '../vista/header.php'; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include_once '../vista/side-bar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Agregar Empleado
                        <small>SIASA</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content" id="contenedor_gral">
                    <div class="box box-default">
                        <div class="box-header with-border">
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form id="formAddEmpl" onsubmit="RegistrarEmpl(); return false;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nameempl">Nombre *</label>
                                            <input type="text" class="form-control" id="nameempl" name="nameempl" required placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail">Correo Electrónico *</label>
                                            <input type="email" class="form-control" id="mail" name="mail" required placeholder="Correo Electrónico">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Rol</label>
                                        <div class="input-group" id="empl-slc">
                                            <select class="form-control select2" id="rol_empl" name="slc_empl" required>
                                                <?php
                                                $modelo_empleado->get_rol_select($rs->fields[0]);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Area</label>
                                        <div class="input-group" id="empl1-slc">
                                            <select class="form-control select2" id="area_empl" name="area_empl" required>
                                                <?php
                                                $modelo_empleado->get_area_select($rs->fields[0]);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="titulo">Titulo Academico</label>
                                            <input type="text" class="form-control" id="titulo" name="titulo" required placeholder="Titulo Academico">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Usuario SILAB</label>
                                            <input type="text" class="form-control" id="username" name="username" required placeholder="Usuario SILAB">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contrasena">Contraseña</label>
                                            <input type="text" class="form-control" id="contrasena" name="contrasena" required placeholder="Contraseña SILAB">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Registrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- End Main content-->
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
            <div id="respuesta_post"></div>
            <div id="post-modal"></div>
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
    </body>
</html>
