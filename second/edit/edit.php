<?php
    #Inclure la base de données
    include("../../config/database.php");

    #Si au moins une variablle POST est définie
    if(isset($_POST)) {
        #Définir les données
        $id = $_GET['id'];
        $name = htmlentities($_POST['name']);
        $description = htmlentities($_POST['description']);
        $price = htmlentities($_POST['price']);

        #Définir la requête de modification de données
        $requete = "UPDATE second SET name = '$name', description = '$description', price = '$price' WHERE id = $id";
        #Exécuter la requête
        $cnn->query($requete) or die(print_r($bdd->errorInfo()));
    }

    #Rediriger vers la page d'accueil
    header("Location: ../");
?>