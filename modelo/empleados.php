<?php

include_once '../modelo/conexion.php';

class empleados {

    private $db;

    function __construct() {
        $con = new conexo();
        $this->db = $con->conectar();
    }

    public function get_validate_user($user, $pass){
        $sql = "select idEmpleado, nombre, idRol, estatus, usuario from empleado where usuario = ? and pass = ?";
        $prp = $this->db->Prepare($sql);
        return $this->db->Execute($prp, array($user, $pass));
    }

    public function get_validate_email($email)
    {
        $sql = "SELECT * FROM empleado WHERE email = ?";
        $prp = $this->db->Prepare($sql);  
        return $this->db->Execute($prp, array($email));      
    }

    public function upd_pwd_shuffle($email)
    {   
        $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8); 
        $sql = "UPDATE empleado SET pass = SHA1(?) WHERE email = ?";
        $prp = $this->db->Prepare($sql);
        $this->db->Execute($prp, array($password,$email));
        return $password;   
    }
    
    public function show_empleados(){
        $sql = "select idEmpleado, nombre, estatus, idArea from empleado order by nombre";
        return $this->db->Execute($sql);
    }
    
    public function Get_empleado($empl) {
        $sql = "select * from empleado where idEmpleado = ?";
        $infoE = $this->db->Prepare($sql);
        return $this->db->Execute($infoE, array($empl));
    }
    
    public function get_empleado_usr($usr)
    {
        $sql = "select * from empleado where usuario = ?";
        $prp = $this->db->Prepare($sql);
        return $this->db->Execute($prp,array($usr));
    }
    
    function get_empl_update($empl){
        $sql = "select * from empleado where idEmpleado = ?";
        $infoE = $this->db->Prepare($sql);
        return $this->db->Execute($infoE, array($empl));
    }
    
    function get_rol_select($idRol)
    {
        $sql = "select idRol, nombre from rol";
        $rs = $this->db->Execute($sql);
        while (!$rs->EOF) {
            ?>
            <option value="<?php echo $rs->fields[0] ?>" <?php if ($idRol == $rs->fields[0]) {
                echo "selected";
            } ?>><?php echo utf8_decode($rs->fields[1]) ?></option>
            <?php
            $rs->MoveNext();
        }
        return $idRol;
    }
    
    function get_estatus_select($idEstatus, $id)
    {
        $sql = "select estatus from empleado where idEmpleado = '$id'";
        $rs = $this->db->Execute($sql);
       ?>
            <option value="<?php echo $rs->fields[0] ?>" <?php if ($idEstatus == $rs->fields[0]) {
                echo "selected";
            } ?>><?php echo $rs->fields[0] ?></option>
            <?php
            if($rs->fields[0] == 'A')
                {
                    ?>
                        <option>I</option>
                    <?php
                }
            if($rs->fields[0] == 'I')
                {
                    ?>
                        <option>A</option>
                    <?php
                }
        return $idEstatus;
    }
    
    function get_area_select($idArea)
    {
        $sql = "select idArea, nombre from areas";
        $rs = $this->db->Execute($sql);
        while (!$rs->EOF) {
            ?>
            <option value="<?php echo $rs->fields[0] ?>" <?php if ($idArea == $rs->fields[0]) {
                echo "selected";
            } ?>><?php echo utf8_decode($rs->fields[1]) ?></option>
            <?php
            $rs->MoveNext();
        }
        return $idArea;
    }
    
    public function insert_empleados($nombre, $mail, $rol, $titulo, $usuario, $pass, $area) {
        $nombre = utf8_encode($nombre);
        $titulo = utf8_encode($titulo);
        $usuario = utf8_encode($usuario);
        $area = utf8_encode($area);
        $sql = "insert into empleado VALUES ('','$nombre','$mail',$rol,'$titulo','','$usuario',SHA1('$pass'),'A', '$area')";
        $prp = $this->db->Prepare($sql);
        $this->db->Execute($prp);
    }
    
    public function archivar_empleado($ide){
        $sql = "update empleado set estatus = 'I' where idEmpleado = ?";
        $prp = $this->db->Prepare($sql);
        $rs = $this->db->Execute($prp, array($ide));
    }
    
    public function update_empleado($empl, $nombre, $titulo, $slc_rol, $email, $pass, $slc_estatus, $slc_area){
        $nombre = utf8_encode($nombre);
        $titulo = utf8_encode($titulo);
        $usuario = utf8_encode($usuario);
        if($pass!=NULL)
            {
                $sql = "update empleado set nombre = '$nombre', tituloAcademico = '$titulo', idRol = '$slc_rol', email = '$email', pass = SHA1('$pass'), estatus = '$slc_estatus', idArea = '$slc_area' where idEmpleado = $empl;";
                return $this->db->Execute($sql);
            }
        else
            {
                $sql = "update empleado set nombre = '$nombre', tituloAcademico = '$titulo', idRol = '$slc_rol', email = '$email', estatus = '$slc_estatus', idArea = '$slc_area' where idEmpleado = $empl;";
                return $this->db->Execute($sql);
            }
        
    }
    
    public function get_area_name($idArea){
        $sql = "select nombre from areas where idArea = $idArea";
                return $this->db->Execute($sql);
    }
    
    public function get_rol_name($idRol){
        $sql = "select nombre from rol where idRol = $idRol";
                return $this->db->Execute($sql);
    }
    
    function get_empleado_select()
    {
        $sql = "select idEmpleado, nombre from empleado";
        $rs = $this->db->Execute($sql);
        while (!$rs->EOF) {
            ?>
            <option value="<?php echo $rs->fields[0] ?>"><?php echo utf8_decode($rs->fields[1]) ?></option>
            <?php
            $rs->MoveNext();
        }
        return $rs->fields[0];
    }
    
    public function update_signature($empl, $firma){
        $firma = utf8_encode($firma);
        $sql = "update empleado set firma = '$firma' where idEmpleado = $empl;";
        return $this->db->Execute($sql);
        
    }
    
    public function select_areas() {
        $sql = "select idArea, nombre from areas order by nombre";
        $rs = $this->db->Execute($sql);
        return $rs;
    }
    
    public function select_roles() {
        $sql = "select idRol, nombre from rol order by nombre";
        $rs = $this->db->Execute($sql);
        return $rs;
    }
    
    public function update_area($nombre, $area) {
        $sql = "update areas set nombre = ? where idArea = ?";
        $prp = $this->db->Prepare($sql);
        $this->db->Execute($prp, array($nombre, $area));
    }
    
    public function delete_empleados_area($area) {
        $sql = "update empleado set idArea = 5 where idArea = ?";
        $prp = $this->db->Prepare($sql);
        return $this->db->Execute($prp, array($area));
    }
    
    public function delete_area($area) {
        $sql = "delete from areas where idArea = ?";
        $prp = $this->db->Prepare($sql);
        return $this->db->Execute($prp, array($area));
    }
    
    public function update_rol($nombre, $rol) {
        $sql = "update rol set nombre = ? where idRol = ?";
        $prp = $this->db->Prepare($sql);
        $this->db->Execute($prp, array($nombre, $rol));
    }
    
    public function delete_empleados_rol($rol) {
        $sql = "update empleado set idRol = 11 where idRol = ?";
        $prp = $this->db->Prepare($sql);
        return $this->db->Execute($prp, array($rol));
    }
    
    public function delete_rol($rol) {
        $sql = "delete from rol where idRol = ?";
        $prp = $this->db->Prepare($sql);
        return $this->db->Execute($prp, array($rol));
    }
    
    public function insert_area_empleado($namearea) {
        $sql = "INSERT INTO areas (nombre) VALUES (?);";
        $prp = $this->db->Prepare($sql);
        $this->db->Execute($prp, array($namearea));
        return $sql;
    }
    
    public function insert_rol_empleado($namerol) {
        $sql = "INSERT INTO rol (nombre) VALUES (?);";
        $prp = $this->db->Prepare($sql);
        $this->db->Execute($prp, array($namerol));
        return $sql;
    }

}

