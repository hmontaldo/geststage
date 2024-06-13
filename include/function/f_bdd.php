<?php

// Paramètres de connexion
$host = 'hen-db-geststage.mysql.database.azure.com';
$username = 'henry_admin';
$password = 'Simplon2024@';
$database = 'bdd_geststages';
$certificate = "/geststage/include/certificates/DigiCertGlobalRootCA.crt.pem";

// Afficher le chemin du certificat pour vérification
echo "Chemin du certificat : " . $certificate . "\n";

// Lire et afficher le contenu du certificat
if (file_exists($certificate)) {
    $cert_content = file_get_contents($certificate);
    echo "Contenu du certificat :\n" . $cert_content;
} else {
    echo "Le certificat n'existe pas au chemin spécifié.";
}

function connexionBDD($host, $username, $password, $database, $certificate)
{
    try
    {
        $db = mysqli_init();
        // Utiliser la variable $certificate correctement
        mysqli_ssl_set($db, NULL, NULL, $certificate, NULL, NULL);
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
$db = connexionBDD($host, $username, $password, $database, $certificate);
if ($db === false) {
    echo "La connexion à la base de données a échoué.";
} else {
    echo "Connexion réussie à la base de données.";
}

?>
