<!DOCTYPE html>
<html>
<head>
<title>Usuñ u¿ytkownika</title>
<meta charset="UTF-8">
</head>
<body style="background-color:lightgrey;">
<table border="0" align="center">

<td><tr><?php

include_once "polacz.php";
session_start();

$usunid=$_GET['id'];

$con = polacz();	
$admin = oci_parse($con, "select ADMIN from UZY1055 where id=:id");
	
oci_bind_by_name($admin,':id',$_SESSION['id']); 

if (  oci_execute($admin) )
	{
	$a= oci_fetch_all($admin, $rezultat);
	}
																		

$stid = oci_parse($con, "DELETE uzy1055 where ID=:usunid");

oci_bind_by_name($stid,':usunid',$usunid);  

oci_execute($stid) ;
		if ($rezultat['ADMIN'][0]==1)
		{
		header("Location: view.php");
		}
		else 
		{
		echo'<br><br>Konto usuniete!<br><br>';
		echo '<a href="http://localhost/adduser.php"><input type="submit" value="Nowe konto"></a>';
		}	
		
?></td></tr></table>

</form>
</body>
</html> 

  