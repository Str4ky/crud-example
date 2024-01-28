<?php
    #Inclure la base de données
    include("../config/database.php");

    #Rediriger vers la page d'accueil avec une variable de page page si celle-ci n'est pas définie
    if(!isset($_GET["page"])) {
        header("Location: ?page=1");
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <meta content="CRUD Example" property="og:title">
    <meta content="Un exemple d'interface CRUD" property="og:description">
    <meta content="" property="og:url">
    <meta content="" property="og:image">
    <meta content="#000000" data-react-helmet="true" name="theme-color">
    <title>CRUD Example</title>
</head>
<body>
    <div class="sidenav">
        <h1><i class="fa-solid fa-wrench title-icon"></i> CRUD Example</h1>
        <a href="../" class="link"><i class="fa-solid fa-house navbar-icon"></i>Accueil</a>
        <a href="../first" class="link"><i class="fa-solid fa-1 navbar-icon"></i> Premiers éléments</a>
        <a class="active"><i class="fa-solid fa-2 navbar-icon"></i>Seconds éléments</a>
    </div>
    <div class="main">
        <h1 class="label"><i class="fa-solid fa-2 title-icon"></i> Seconds éléments</h1>
        <br>
        <table>
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Prix</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <?php
            #Définir le nombre d'éléments par page
            $total = 12;
            #Si la page est définie et qu'elle est supérieure à 1
            if(isset($_GET["page"]) && $_GET["page"] > 1) {
                #Définir l'ID de l'élément à partir duquel la requête va chercher les éléments
                $id_page = ($total * ($_GET["page"] - 1) ) + 1;
                #Définir la requête commençant à l'ID défini précédemment et limitée au nombre d'éléments par page
                $requete = "SELECT * FROM second WHERE id >= $id_page ORDER BY id DESC LIMIT $total";
            }
            else {
                #Définir la requête limitée au nombre d'éléments par page
                $requete = "SELECT * FROM second ORDER BY id DESC LIMIT $total";
            }
            #Exécuter la requête
            $resultat = $cnn->query($requete) or die(print_r($bdd->errorInfo()));
            while($row = $resultat->fetch()){
                #Afficher les éléments
                $id = html_entity_decode($row['id']);
                $name = html_entity_decode($row['name']);
                $description = html_entity_decode($row['description']);
                $price = html_entity_decode($row['price']);

                #Afficher les éléments dans le tableau
                echo "<tbody>
                <tr>
                <td data-label='ID'>$id</td>
                <td data-label='Name'>$name</td>
                <td data-label='Description'>$description</td>
                <td data-label='Price'>$price</td>
                <td data-label='Actions'>
                <a href='edit?id=$id' class='edit'><i class='fa-solid fa-pen table-icon'></i></a>
                <a href='delete?id=$id' class='delete'><i class='fa-solid fa-trash table-icon'></i></a>
                </td>
                </tr>
                </tbody>";
            }
        ?>
        </table>
        <?php
            #Si la page est définie
            if(isset($_GET["page"])) {
                #Si la page est supérieure à 1
                if($_GET["page"] > 1) {
                    #Définir la page précédente
                    $page_prev = $_GET["page"] - 1;
                    #Afficher le bouton de la page précédente
                    echo "<a href='?page={$page_prev}' class='table-button nav'><i class='fa-solid fa-chevron-left'></i> Page précédente</a>";
                }
                
                #Si la page n'est pas définie
                if(!isset($_GET["page"])) {
                    #Définir la page précédente
                    $page_next = 2;
                }
                else {
                    #Définir la page suivante
                    $page_next = $_GET["page"] + 1;
                }
        
                #Définir la requête pour compter le nombre d'éléments dans la base de données
                $requete = "SELECT COUNT(*) as total FROM second";
                #Exécuter la requête
                $resultat = $cnn->query($requete) or die(print_r($bdd->errorInfo()));
                while($row = $resultat->fetch()){
                    #Définir le nombre d'éléments
                    $items = $total * $_GET["page"];
                    #Si le nombre d'éléments est supérieur au nombre d'éléments par page
                    if($row['total'] > $items) {
                        #Afficher le bouton de la page suivante
                        $page_next = $_GET["page"] + 1;
                        #Afficher le bouton de la page suivante
                        echo "<a href='?page={$page_next}' class='table-button nav'>Page suivante <i class='fa-solid fa-chevron-right'></i></a>";
                    }
                }
            }
        ?>
        <!-- Afficher le bouton d'ajout d'élément -->
        <a href="add" class="table-button create"><i class="fa-solid fa-plus"></i> Ajouter un élément</a>
    </div>
</body>
</html>