<?php

// Paramètres de connexion
$host = 'bdd-geststages-anna.mysql.database.azure.com';
$username = 'adarda';
$password = 'Simplon2024@';
$database = 'bdd_geststages';

// Utiliser __DIR__ pour construire le chemin absolu du certificat
$certificate = __DIR__ . "/../certificates/DigiCertGlobalRootCA.crt.pem";

/*   // Afficher le chemin du certificat pour vérification
echo "Chemin du certificat : " . $certificate . "\n"; 

 // Lire et afficher le contenu du certificat
if (file_exists($certificate)) {
    $cert_content = file_get_contents($certificate);
    echo "Contenu du certificat :\n" . $cert_content;
} else {
    echo "Le certificat n'existe pas au chemin spécifié.\n";
}   */

function connexionBDD($host, $username, $password, $database, $certificate)
{
    try
    {
        $db = mysqli_init();
        // Utiliser la variable $certificate correctement
        if(!mysqli_ssl_set($db, NULL, NULL, $certificate, NULL, NULL)) {
			echo "certificate not found : " . $certificate;
		}
		if(!mysqli_real_connect($db, $host, $username, $password, $database, 3306, MYSQLI_CLIENT_SSL)) {
			echo "connexion failededed : " . $db;
		}
		if (mysqli_connect_errno()) {
            die('Failed to connect to MySQL: '.mysqli_connect_error());
            }

            // Vérifier la connexion
        if ($db->connect_error) {
                die("La connexion a échoué: " . $db->connect_error);
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

/* // Test de la connexion
$db = connexionBDD($host, $username, $password, $database, $certificate);
if ($db === false) {
    echo "La connexion à la base de données a échoué.";
} else {
    echo "Connexion réussie à la base de données.";
} */

?>
