<?php
header('Access-Control-Allow-Origin: *');
require_once('./CommunicationUtils.php');
$obj = new CommunicationUtils();
$obj->table="test";
$obj->retrieve();
?>
