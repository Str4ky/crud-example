<?php
    #Inclure la base de données
    include("../../config/database.php");

    #Si au moins une variablle POST est définie
    if(isset($_POST)) {
        #Définir les données
        $name = htmlentities($_POST['name']);
        $description = htmlentities($_POST['description']);
        $price = htmlentities($_POST['price']);

        #Définir la requête d'ajout de données
        $requete = "INSERT INTO second (name, description, price) VALUES ('$name', '$description', '$price')";
        #Exécuter la requête
        $cnn->exec($requete) or die(print_r($bdd->errorInfo()));
    }

    #Rediriger vers la page d'accueil
    header("Location: ../");
?>