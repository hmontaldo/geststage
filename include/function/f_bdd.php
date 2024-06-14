﻿<?php

function connexionBDD()
{
    try
    {
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_SSL_CA => __DIR__ . 'DigiCertGlobalRootCA.crt.pem' // Chemin vers le certificat RootCA de Azure
            );
    
            $bdd = new PDO(
            'mysql:host=hen-db-geststage.mysql.database.azure.com;port=3306;dbname=bdd_geststages;charset=utf8',
            'usergs',
            'mdpGS',
            $options
        );
            //array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
            return $bdd;
    }
    catch(Exception $e)
    {
        $pdo_error = $e->getMessage();
                return false;
    }
    
}

?>