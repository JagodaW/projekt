<?php

include_once "polacz.php";
session_start();
$login = $_POST['login'];
$password = $_POST['password'];

$con = polacz();


if(isset ($login))
{
	//czy spełnia warunki
	$wszystko_OK=true;
	//
	//$login=$_POST['login'];
	//sprawdzenie dlugosci
	if(strlen($login)<=3||(strlen($login)>25))
	{
		$wszystko_OK=false;
		$_SESSION['e_login']="Login powinien posiadać od 3 do 25 znaków";
	}
	if(ctype_alnum($login)==false)
		
	{
		$wszystko_OK=false;
		$_SESSION['e_login']="Może składać się tylko z liter i cyfr(bez polskich znaków)";
	}
	
	if ($wszystko_OK==true)
	{
		echo"Udana walidacja!"; 
	}
	else {
		header("Location: adduser.php");
		exit();
	}
}

//przypisnie zmienne wykonnia polecenia
$stid = oci_parse($con, "insert into UZY1055 (login, pass) VALUES (:login,dbms_crypto.hash(utl_raw.cast_to_raw(:password),3))");
 
oci_bind_by_name($stid,':login',$login);  
oci_bind_by_name($stid,':password',$password);

//wykonanie polecenia
if (  oci_execute($stid) )
{
    header("Location: view.php");
}
else
{
	header("Location: login.php");
}

		
?>



  