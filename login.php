<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset="UTF-8">
<style>
.adduser{
	color:black;
	margin-top:12px;
	margin-bottom: 12px;
}
</style>
</head>


<body style="background-color:lightgrey;">


<td  colspan='2' align='center'><form action="login_h.php" method="post">

<label>
</label>
<table border="0" align="center">
<td ><h1>Logowanie!</h1> </td>
</tr><tr>
<td>Login:</td>
<td><input type="text" name="login"></td>
<tr></tr>
<td>Hasło:</td>
<td><input type="password" name="password"></td>
<tr></tr>

<td  colspan='2' align='center'>
<input type="submit" value="Zaloguj"></td>
<tr></tr>
<td  colspan='2' align='center'><a href="http://localhost/adduser.php"> Rejestracja</a></td>
<tr></tr>
</table>
</form>
</body>
</html> 