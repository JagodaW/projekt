<?php

include_once "polacz.php";
session_start();

$id=$_POST['id'];
$login=$_POST['login'];
$password=$_POST['password'];

$con = polacz();
$stid = oci_parse($con, "update uzy1055 SET PASS=dbms_crypto.hash(utl_raw.cast_to_raw(:password),3) where id=:id");

oci_bind_by_name($stid,':id',$id);  
oci_bind_by_name($stid,':password',$password);  

 oci_execute($stid) ;
 header("Location: view.php");


?>



  