<?php
include_once '../controlador/validar-sesiones.php';
$opc = $_POST['opc'];
switch ($opc) {
    case 1:
        include_once '../modelo/clientes.php';
        $modelo_clientes = new clientes();
        $nombre = utf8_encode($_POST['ctename']);
        $calle = utf8_encode($_POST['calle']);
        $colonia = utf8_encode($_POST['colonia']);
        $numInt = utf8_encode($_POST['n_int']);
        $numExt = utf8_encode($_POST['n_ext']);
        $ciudad = utf8_encode($_POST['ciudad']);
        $cp = $_POST['cp'];
        $telOficina = $_POST['telf'];
        $extension = $_POST['ext'];
        $telCelular = $_POST['t_m'];
        $email = $_POST['mail'];
        $rfc = $_POST['rfc'];
        $cte_new = $modelo_clientes->insert_clientes($nombre, $calle, $colonia, $numInt, $numExt, $ciudad, $cp, $telOficina, $extension, $telCelular, $email, $rfc);
        ?>
        <script>
            window.location.href = "../vista/lista-contactos-cliente.php?cte_new=<?= $cte_new ?>";
        </script>
        <?php
        break;
    case 2:
        $cte = $_POST['cte'];
        ?>
        <div id="modal-contacto" class="modal fade" data-keyboard="false" data-backdrop="static">
            <form id="form-add-conto" onsubmit="registrar_cto('<?= $cte; ?>'); return false;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Registrar Contacto</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ctoname">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-sm" id="ctoname" name="ctoname" placeholder="Nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico <span class="text-danger">*</span></label>
                                <input type="email" class="form-control input-sm" id="email" name="email" placeholder="Correo Electronico" required>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="tel_f">Teléfono de Oficina</label>
                                        <input type="text" class="form-control input-sm" id="tel_f" name="tel_f" placeholder="Teléfono de Oficina" data-inputmask='"mask": "999-999-9999"' data-mask>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="ext_t">Ext</label>
                                        <input type="text" class="form-control input-sm" id="ext_t" name="ext_t" placeholder="Ext" data-inputmask='"mask": "9999"' data-mask>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="tel_m">Telefóno Móvil</label>
                                        <input type="text" class="form-control input-sm" id="tel_m" name="tel_m" placeholder="Telefóno Móvil" data-inputmask='"mask": "999-999-9999"' data-mask>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> Registrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script>
            $("#modal-contacto").modal('show');
            $("[data-mask]").inputmask();
        </script>
        <?php
        break;
    case 3:
        include_once '../modelo/contactos.php';
        $modelo_contactos = new contactos();
        $cte = $_POST['cte'];
        $nombre = utf8_encode($_POST['ctoname']);
        $email = $_POST['email'];
        $tel_oficina = $_POST['tel_f'];
        $ext = $_POST['ext_t'];
        $tel_movil = $_POST['tel_m'];
        $modelo_contactos->registrar_contacto($cte, $nombre, $email, $tel_oficina, $ext, $tel_movil);
        ?>
        <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">Acciones</th>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Telefono de Oficina</th>
            <th>Extención</th>
            <th>Telefono movil</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rs = $modelo_contactos->show_contactos_cliente($cte);
        while (!$rs->EOF) {
            ?>
            <tr id="tr-cto-<?= $rs->fields[0]; ?>">
                <td class="text-center">
                    <a href="#" title="Modificar" class="text-success" onclick="update_cto(<?= $rs->fields[0]; ?>)"><span class="fa fa-pencil"></span></a>
                    <a href="#" title="Eliminar" class="text-danger" onclick="delete_cto(<?= $rs->fields[0]; ?>, '<?= $cte?>')"><span class="fa fa-remove"></span></a>
                    <a href="#" title="Desactivar" class="text-info"><span class="fa fa-eye-slash"></span></a>
                </td>
                <td><?= utf8_decode($rs->fields[2]) ?></td>
                <td><?= utf8_decode($rs->fields[3]) ?></td>
                <td><?= utf8_decode($rs->fields[4]) ?></td>
                <td><?= utf8_decode($rs->fields[5]) ?></td>
                <td><?= utf8_decode($rs->fields[6]) ?></td>
            </tr>
            <?php
            $rs->MoveNext();
        }
        ?>
    </tbody>
</table>
        <script>
            $("#example1").DataTable();
        </script>
        <?php
        break;
    case 4:
        include_once '../modelo/clientes.php';
        $modelo_clientes = new clientes();
        $cte = $_POST['cte'];
        $rs = $modelo_clientes->select_cliente($cte);
        ?>
        <div id="modal-info_cte" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Datos del Cliente</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label class="text-success">Nombre: </label>
                            <label><?= utf8_decode($rs->fields[1]); ?></label>
                        </div>
                        <div class="row">
                            <label class="text-success">Correo Electrónico: </label>
                            <label><?= utf8_decode($rs->fields[11]); ?></label>
                        </div>
                        <div class="row">
                            <label class="text-success">RFC: </label>
                            <label><?= utf8_decode($rs->fields[12]); ?></label>
                        </div>
                        <div class="row">
                            <label class="text-success">Teléfono de Oficina: </label>
                            <label><?= utf8_decode($rs->fields[8]); ?></label>
                        </div>
                        <div class="row">
                            <label class="text-success">EXT: </label>
                            <label>
                                <?php
                                if ($rs->fields[9] != 0) {
                                    utf8_decode($rs->fields[9]);
                                }
                                ?>
                            </label>
                        </div>
                        <div class="row">
                            <label class="text-success">Teléfono Movíl: </label>
                            <label><?= utf8_decode($rs->fields[10]); ?></label>
                        </div>
                        <div class="row">
                            <label class="text-success">Calle: </label>
                            <label><?= utf8_decode($rs->fields[2]); ?></label>
                        </div>
                        <div class="row">
                            <label class="text-success">Número Exterior: </label>
                            <label><?= utf8_decode($rs->fields[5]); ?></label>
                        </div><div class="row">
                            <label class="text-success">Número Interior: </label>
                            <label><?= utf8_decode($rs->fields[4]); ?></label>
                        </div>
                        <div class="row">
                            <label class="text-success">Colonia: </label>
                            <label><?= utf8_decode($rs->fields[6]); ?></label>
                        </div>
                        <div class="row">
                            <label class="text-success">Codigo Postal: </label>
                            <label><?= utf8_decode($rs->fields[7]); ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#modal-info_cte").modal('show');
        </script>
        <?php
        break;
    case 5:
        include_once '../modelo/clientes.php';
        $modelo_clientes = new clientes();
        $cte = $_POST['cte'];
        $rs = $modelo_clientes->select_cliente($cte);
        include_once '../ctr-vistas/editar-cliente.php';
        break;
    case 6:
        include_once '../modelo/clientes.php';
        $modelo_clientes = new clientes();
        $cte = $_POST['cte'];
        $nombre = utf8_encode($_POST['ctename']);
        $calle = utf8_encode($_POST['calle']);
        $colonia = utf8_encode($_POST['colonia']);
        $num_int = utf8_encode($_POST['n_int']);
        $num_ext = utf8_encode($_POST['n_ext']);
        $ciudad = utf8_encode($_POST['ciudad']);
        $cp = $_POST['cp'];
        $tel_oficina = $_POST['telf'];
        $extension = $_POST['ext'];
        $tel_movil = $_POST['t_m'];
        $email = $_POST['mail'];
        $rfc = $_POST['rfc'];
        $modelo_clientes->update_cte($nombre, $calle, $colonia, $num_int, $num_ext, $ciudad, $cp, $tel_oficina, $extension, $tel_movil, $email, $rfc, $cte);
        $rs = $modelo_clientes->select_cliente($cte);
        include_once '../ctr-vistas/show-cte-update.php';
        break;
    case 7:
        include_once '../modelo/clientes.php';
        include_once '../modelo/contactos.php';
        $modelo_clientes = new clientes();
        $modelo_contactos = new contactos();
        $cte = $_POST['cte'];
        $modelo_contactos->delete_contactos_cte($cte);
        $count = $modelo_clientes->delete_cliente($cte)->fields[0];
        if ($count == 0) {
            ?>
            <script>
                $("#tr-" + <?= $cte; ?>).remove();
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("El cliente no fue eliminado, intente nuevamente.");
            </script>
            <?php
        }
        break;
    default:
        break;
}