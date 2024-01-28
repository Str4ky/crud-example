<?php
    #Inclure la base de données
    include("../../config/database.php");

    #Définir l'ID
    $id = $_GET['id'];

    #Définir la requête de suppression de données
    $requete = "DELETE FROM first WHERE id = '$id'";
    #Exécuter la requête
    $cnn->query($requete) or die(print_r($bdd->errorInfo()));

    #Rediriger vers la page d'accueil
    header("Location: ../");
?>