<?php

function polacz()
{
	$dbstr ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)
	(HOST=dbserver.mif.pg.gda.pl)(PORT = 1521))
	(CONNECT_DATA = (SERVER=DEDICATED)
	(SERVICE_NAME = ORACLEMIF)
	))"; 

	$charenc = 'AL32UTF8';

	$conn = oci_connect('JWILK_P','e2T7H',$dbstr, $charenc);

	if (!$conn) {
		$e = oci_error();
		echo $e['message'];
		die();
	}
	else
	{
	    echo "database connection";
		return $conn;
	}
}
?>