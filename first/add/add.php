<?php
    #Inclure la base de données
    include("../../config/database.php");

    #Si au moins une variablle POST est définie
    if(isset($_POST)) {
        #Définir les données
        $last_name = htmlentities($_POST['last_name']);
        $first_name = htmlentities($_POST['first_name']);
        $age = htmlentities($_POST['age']);
        $phone = htmlentities($_POST['phone']);
        $area = htmlentities($_POST['area']);

        #Définir la requête d'ajout de données
        $requete = "INSERT INTO first (last_name, first_name, age, phone, area) VALUES ('$last_name', '$first_name', '$age', '$phone', '$area')";
        #Exécuter la requête
        $cnn->exec($requete) or die(print_r($bdd->errorInfo()));
    }

    #Rediriger vers la page d'accueil
    header("Location: ../");
?>