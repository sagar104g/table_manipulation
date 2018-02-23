<?php
header('Access-Control-Allow-Origin: *');
	require_once('./CommunicationUtils.php');
	print_r($_POST);
	$id = $_REQUEST['phone'];
	echo $id;
	$obj =  new CommunicationUtils();
	$obj->id=$id;
       $obj->table = 'test';
        $obj->delete();
?>