<!DOCTYPE html>
<html>
<head>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>

<?php
include_once "polacz.php";
session_start();

if (isset($_SESSION['id']))
{

	$con = polacz();
	$admin = oci_parse($con, "select ADMIN from UZY1055 where id=:id");
	
							oci_bind_by_name($admin,':id',$_SESSION['id']); 
							if (  oci_execute($admin) )
								{
									$a= oci_fetch_all($admin, $rezultat);
								}
							
							if ($rezultat['ADMIN'][0]==1)
						
							{
								$admin= oci_parse($con, "select id, login, admin from UZY1055");
								oci_execute($admin);  
								echo "<p><h1>Witaj ".$_SESSION['login'].'! </h1></p>';
								echo "<table><tr><th>ID</th><th>Login</th><th>Akcja</th></tr>";
								while ($row = oci_fetch_row($admin))
								{
									$id = $row[0];
									$login = $row[1];
									$usun= '<a href="http://localhost/delete_user.php?id='.$id.'"><img src="kosz.jpg" alt="kosz" width="30" height="30"></a>';
									$zmien_haslo='<a href="http://localhost/update.php?id='.$id.'">Zmieñ has³o</a>';
									echo "<tr><td>$id</td><td>$login</td><td>$usun<br/>$zmien_haslo</td></tr>";
								}	
								echo "</table>";	
								//echo "dla zalogowanych ";
								
								echo '<a href="http://localhost/logout.php"><input type="submit" value="Wyloguj siê"></a>';
								
								//print_r($_SESSION);
							}
									// usuwanie !!!!!!! nie  nie dzia³a
							else
							{							
										$not_admin= oci_parse($con, "select id, login from UZY1055 where id=:id");
									
										oci_bind_by_name($not_admin,':id',$_SESSION['id']); 
													if (  oci_execute($not_admin) )
												{
													$a= oci_fetch_all($not_admin, $rezultat);
												}									
								echo "<p><h1>Witaj ".$_SESSION['login'].'! </h1></p>';
								echo "<table><tr><th>ID</th><th>Login</th><th>Akcja</th></tr>";
								
									$id = $rezultat['ID'][0];
									$login = $rezultat['LOGIN'][0];
									$usun= '<a href="http://localhost/delete_user.php?id='.$id.'">Usuñ</a>';
									$zmien_haslo='<a href="http://localhost/update.php?id='.$id.'">Zmieñ has³o</a>';
									echo "<tr><td>$id</td><td>$login</td><td>$usun<br/>$zmien_haslo</td></tr>";
								
								echo "</table>";	
								echo '<a href="http://localhost/logout.php"><input type="submit" value="Wyloguj siê"></a>';
								//print_r($_SESSION);
								
							}
}
	else
{
header("Location: login.php");
die();
}
?>

</body>
</html>