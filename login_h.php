<?php

include_once "polacz.php";
session_start();
$login = $_POST['login'];
$password = $_POST['password'];

$con = polacz();

$stid = oci_parse($con, "select * from uzy1055 WHERE login=:login AND
  pass=dbms_crypto.hash(utl_raw.cast_to_raw(:password), 3)");

oci_bind_by_name($stid,':login',$login);  
oci_bind_by_name($stid,':password',$password);
  
oci_execute($stid);  

$n = oci_fetch_all($stid, $rez);

echo $n;

if ($n == 1)
{
    echo "<br> ZALOGOWANO <br>";
    $_SESSION['login'] = $rez['LOGIN'][0];
	$_SESSION['id'] = $rez['ID'][0];
	 header("Location: view.php");
	}
else
{
	("Location: login.php");
	echo "<br> Error, cannot log in!<br>";
}


?>
  