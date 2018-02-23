<?php
header('Access-Control-Allow-Origin: *');
require_once('./CommunicationUtils.php');
	print_r($_POST);
	$email = $_REQUEST['email'];
	 $name = $_REQUEST['name'];
	 $phone = $_REQUEST['phone_number'];
	$obj =  new CommunicationUtils();
	 $obj->fields = array('phone', 'name','email');
    $obj->values =  array($phone,$name,$email);
    $obj->table = 'test';
    $obj->save();

?>
