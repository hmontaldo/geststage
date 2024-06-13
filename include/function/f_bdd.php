<?php

// Paramètres de connexion
$host = 'hen-db-geststage.mysql.database.azure.com';
$username = 'henry_admin';
$password = 'Simplon2024@';
$database = 'bdd_geststages';
$certificate = __DIR__ . "/../certificates/DigiCertGlobalRootCA.crt.pem";


function connexionBDD()
{
	try
	{
		$db = mysqli_init();
		mysqli_ssl_set($db,NULL,NULL, $certificate, NULL, NULL);
		mysqli_real_connect($db, $host, $username, $password, $database, 3306, MYSQLI_CLIENT_SSL);
	}
	catch(Exception $e)
	{
		$pdo_error = $e->getMessage();
                return false;
	}
    
}

?>