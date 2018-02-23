<?php
header('Access-Control-Allow-Origin: *');
	require_once('./CommunicationUtils.php');
	print_r($_POST);
	$email = $_REQUEST['email'];
	 $name = $_REQUEST['name'];
	 $phone = $_REQUEST['phone'];
	$obj =  new CommunicationUtils();
	$obj->values =  array($phone,$name,$email);
       $obj->table = 'test';
        $obj->update();
?>