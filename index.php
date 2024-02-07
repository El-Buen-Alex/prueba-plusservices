<?php
require_once 'config/config.php';
$cont= isset($_REQUEST['c'])?htmlentities($_REQUEST['c']):MAIN_CONTROLER;
$accion =isset($_REQUEST['a'])?htmlentities($_REQUEST['a']):MAIN_ACTION;

$cont= ucwords(strtolower($cont))."Controller";

$archivoCont = 'controllers/' . $cont . '.php';

if (!is_file($archivoCont)) {//verificar q exista
    
    $cont=MAIN_CONTROLER. "Controller";
    $archivoCont = 'controllers/' . MAIN_CONTROLER . 'Controller'.'.php';
    $accion = MAIN_ACTION;
}
require_once  $archivoCont;
$objetoCont = new $cont();
$objetoCont->$accion();
?>