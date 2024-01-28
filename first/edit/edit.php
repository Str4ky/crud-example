<?php
    #Inclure la base de données
    include("../../config/database.php");

    #Si au moins une variablle POST est définie
    if(isset($_POST)) {
        #Définir les données
        $id = $_GET['id'];
        $last_name = htmlentities($_POST['last_name']);
        $first_name = htmlentities($_POST['first_name']);
        $age = htmlentities($_POST['age']);
        $phone = htmlentities($_POST['phone']);
        $area = htmlentities($_POST['area']);

        #Définir la requête de modification de données
        $requete = "UPDATE first SET last_name = '$last_name', first_name = '$first_name', age = '$age', phone = '$phone', area = '$area' WHERE id = $id";
        #Exécuter la requête
        $cnn->query($requete) or die(print_r($bdd->errorInfo()));
    }

    #Rediriger vers la page d'accueil
    header("Location: ../");
?>