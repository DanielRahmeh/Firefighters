<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: http://".$_SERVER['SERVER_NAME']."/Firefighters/pages/index.php");
?>