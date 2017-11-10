<?php
include_once '../herramientas/adodb5/adodb-exceptions.inc.php';
include '../herramientas/adodb5/adodb.inc.php';
class conexo {
    //private $db='mysql',$servidor='localhost', $user='root', $password='crown1990', $based='siasamex_silab';
    private $db='mysql',$servidor='localhost', $user='root', $password='crown1990', $based='siasamex_silab_c';
      //private $db='mysql',$servidor='127.0.0.1', $user='root', $password='p31n3t1n', $based='silab_new';
      
        public function __construct() {
        }
       public function conectar() {
           $db = ADONewConnection($this->db);
           $db->debug = false;
           $db->Connect($this->servidor, $this->user, $this->password, $this->based);
           return $db;
        }
}
?>
