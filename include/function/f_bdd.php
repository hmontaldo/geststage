<?php

// Paramètres de connexion
$host = 'hen-db-geststage.mysql.database.azure.com';
$username = 'henry_admin';
$password = 'Simplon2024@';
$database = 'bdd_geststages';

function connexionBDD($host, $username, $password, $database)
{
    try
    {
        $db = mysqli_init();
        mysqli_ssl_set($db, NULL, NULL, "/geststage/include/certificates/DigiCertGlobalRootCA.crt.pem", NULL, NULL);
        if (!mysqli_real_connect($db, $host, $username, $password, $database, 3306, NULL, MYSQLI_CLIENT_SSL))
        {
            throw new Exception('Erreur de connexion : ' . mysqli_connect_error());
        }
        return $db;
    }
    catch(Exception $e)
    {
        $pdo_error = $e->getMessage();
        error_log('Erreur de connexion : ' . $pdo_error);
        return false;
    }
}

// Test de la connexion
$db = connexionBDD($host, $username, $password, $database);
if ($db === false) {
    echo "La connexion à la base de données a échoué.";
} else {
    echo "Connexion réussie à la base de données.";
}

?>
