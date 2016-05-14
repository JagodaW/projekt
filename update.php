<?php

include_once "polacz.php";
session_start();
$pobierzid=$_GET['id'];

$con = polacz();

$stid = oci_parse($con, "select * from uzy1055 where ID=:pobierzid");
oci_bind_by_name($stid,':pobierzid',$pobierzid);  

oci_execute($stid) ;
$n=oci_fetch_all($stid,$r);  
?>

<!DOCTYPE html>
<html>
<head>
<title>Zmiana hasła</title>
<meta charset="UTF-8">
</head>
<body style="background-color:lightgrey;">
<form action="update_h.php" method="post">

<table border="0" align="center">
<td ><h1>Zmiana hasła</h1> </td>
</tr><tr>

<input  type="hidden" name="id" value ="<?php echo $pobierzid;?>">

<td>Login:</td>
<td><input  type="text" name="login" value ="<?php echo $r['LOGIN'][0];?>"></td>
</tr><tr>

<td>Podaj nowe hasło :
</td>
<td>
<input type="password" name="password">
</td>
</tr><tr>

<td  colspan='2' align='right'>
<input type="submit" value="Zmień hasło">
</tr></table>
</form>
</body>
</html> 