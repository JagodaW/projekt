
<?php

include_once "polacz.php";
session_start();
$con = polacz();

if(isset ($_POST['login']))
{   
  	
	$wszystko_OK=true;
	$login=$_POST['login'];

	if(strlen($login)<=3||(strlen($login)>25))
		{
			$wszystko_OK=false;
			$_SESSION['e_login']="Login powinien posiadać od 3 do 25 znaków!";
		}
	
	if(ctype_alnum($login)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_login']="Login może składać się tylko z liter i cyfr (bez polskich znaków)!";
		}
	
		//Sprawdź poprawność hasła
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		
		if ((strlen($password)<8) || (strlen($password)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_password']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($password!=$password2)
		{
			$wszystko_OK=false;
			$_SESSION['e_password']="Podane hasła nie są identyczne!";
		}
			
	if ($wszystko_OK==true)
	{
			//sprawdzenie czy uzytkownik istenieje w bazie
			$rezultat = oci_parse($con,"SELECT id FROM uzy1055 WHERE login=:login");
				
				oci_bind_by_name($rezultat,':login',$login); 
				if (  oci_execute($rezultat) )
					{
						$s= oci_fetch_all($rezultat, $rez);
					}
						
				if ($s ==0)
					{
					//jesli brak loginu w bazie to uzytkownik zostaje dodany do bazy
					$stid = oci_parse($con, "insert into UZY1055 (login, pass, admin) VALUES (:login,dbms_crypto.hash(utl_raw.cast_to_raw(:password),3),0)");
					 //wykonanie polecenia
					oci_bind_by_name($stid,':login',$login);  
					oci_bind_by_name($stid,':password',$password);
					
					$adduser=$_POST['adduser'];
						if (oci_execute($stid))
							{
							unset($_SESSION['login']);
							unset($_SESSION['password']);
							//$_SESSION['adduser']="Rejestracja przebiegła pomyślnie. <br>Zaloguj się!</br> ";
							//print_r($_SESSION);							
							//header("Location: login.php");
							header("Location: hellou.php");
							}
						/*else
							{
							//header("Location: login.php");
							}*/
					}
					
	}
	else
						{
						$_SESSION['e_login']="Podany login juz instnieje w bazie.";
						}
	
	/*else {
		header("Location: adduser.php");
		
	}*/
}
?>

<!DOCTYPE html>
<html>
<head>
<title>DODAJ UŻYTKOWNIKA</title>
<meta charset="UTF-8">

<style>
.error{
	color:red;
	margin-top:10px;
	margin-bottom: 10px;
}
</style>
</head>
<body style="background-color:lightgrey;">

<!--<form action="adduser_h.php" method="post">-->

<form action="adduser.php" method="post">
<table border="0" align="center">

<td ><h1>Zarejestruj się !</h1> </td>

<tr>
<td>Nazwa uzytkownika:</td>
<td><input type="text" name="login"><br><?php
if(isset($_SESSION['e_login']))
{
	echo'<div class="error">'.$_SESSION['e_login'].'</div>';
	unset($_SESSION['e_login']);
}
?> </td></tr>

<tr>
<td>Podaj hasło:</td>
<td><input type="password"  " name="password" /><br /><?php
			if (isset($_SESSION['e_password']))
			{
				echo '<div class="error">'.$_SESSION['e_password'].'</div>';
				unset($_SESSION['e_password']);
			}
?></td></tr>
</td>
</tr>

<tr>
<td>Powtórz hasło: </td>
<td> <input type="password2"   name="password2" /></br></td></tr>

<td  colspan='2' align='right'>
<input type="submit" value="Dodaj">
</td>
</tr></table>

</form>
</body>
</html> 

