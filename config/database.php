<?php
    #Définir les paramètres de connexion à la base de données
    $host = "localhost";
    $bdd = "crud";
    $user = "root";
    $passwd = "";
    
    #Se connecter à la base de données
    try{
        $cnn = new PDO("mysql:host=$host;dbname=$bdd;charset=utf8",$user,$passwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));  
    }
    catch(PDOException $e){
        echo "Erreur : ".$e->getMessage();
    }
?>