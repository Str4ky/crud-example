<?php
    #Inclure la base de données
    include("../config/database.php");

    #Rediriger vers la page d'accueil avec une variable de page page si celle-ci n'est pas définie ou si la recherche est vide
    if(!isset($_GET["page"]) && (!isset($_GET["search"]) || $_GET["search"] == "")) {
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
        <a class="active"><i class="fa-solid fa-1 navbar-icon"></i> Premiers éléments</a>
        <a href="../second" class="link"><i class="fa-solid fa-2 navbar-icon"></i>Seconds éléments</a>
    </div>
    <div class="main">
        <h1 class="label"><i class="fa-solid fa-1 title-icon"></i> Premiers éléments</h1>
        <br>
        <div class="search">
            <!-- Afficher le champ de recherche et de filtres avec ceux-ci si on a déja une recherche et un filtre en cours -->
            Filtre : <select id="filter" onchange="updateFilter(this)"><option value="none">Aucun</option><option value="id" <?php if(isset($_GET["filter"]) && $_GET["filter"] == "id") echo "selected"; ?>>ID</option><option value="last_name" <?php if(isset($_GET["filter"]) && $_GET["filter"] == "last_name") echo "selected"; ?>>Nom</option><option value="first_name" <?php if(isset($_GET["filter"]) && $_GET["filter"] == "first_name") echo "selected"; ?>>Prénom</option><option value="age" <?php if(isset($_GET["filter"]) && $_GET["filter"] == "age") echo "selected"; ?>>Âge</option><option value="phone" <?php if(isset($_GET["filter"]) && $_GET["filter"] == "phone") echo "selected"; ?>>N° de téléphone</option><option value="area" <?php if(isset($_GET["filter"]) && $_GET["filter"] == "area") echo "selected"; ?>>Lieu</option></select><input type="text" class="search" placeholder="Rechercher" name="search" id="search" value="<?php if(isset($_GET["search"])) { echo $_GET["search"]; } ?>"><a href="" id="button"><i class="fa-solid fa-search"></i></a>
        </div>
        <br><br>
        <table>
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Âge</th>
            <th scope="col">N° de téléphone</th>
            <th scope="col">Lieu</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <?php
            #Définir le nombre d'éléments par page
            $total = 10;
            if(isset($_GET["search"])) {
                if(isset($_GET["filter"]) && $_GET["filter"] != "none" && $_GET["filter"] != "") {
                    #Définir la requête avec la recherche via le filtre
                    $requete = $cnn->prepare("SELECT * FROM first WHERE {$_GET["filter"]} LIKE :search");
                    #Exécuter la requête
                    $requete->execute(['search' => '%'.$_GET["search"].'%']);
                    #Définir le résultat de la requête
                    $resultat = $requete;
                }
                else {
                    #Définir la requête avec la recherche
                    $requete = $cnn->prepare("SELECT * FROM first WHERE last_name LIKE :search OR first_name LIKE :search OR age LIKE :search OR phone LIKE :search OR area LIKE :search");
                    #Exécuter la requête
                    $requete->execute(['search' => '%'.$_GET["search"].'%']);
                    #Définir le résultat de la requête
                    $resultat = $requete;
                }
            }
            else {
                #Si la page est définie et qu'elle est supérieure à 1
                if(isset($_GET["page"]) && $_GET["page"] > 1) {
                    #Définir l'ID de l'élément à partir duquel la requête va chercher les éléments
                    $id_page = ($total * ($_GET["page"] - 1) ) + 1;
                    #Définir la requête commençant à l'ID défini précédemment et limitée au nombre d'éléments par page
                    $requete = "SELECT * FROM first WHERE id >= $id_page ORDER BY id DESC LIMIT $total";
                }
                else {
                    #Définir la requête limitée au nombre d'éléments par page
                    $requete = "SELECT * FROM first ORDER BY id DESC LIMIT $total";
                }
                #Exécuter la requête
                $resultat = $cnn->query($requete) or die(print_r($bdd->errorInfo()));
            }
            while($row = $resultat->fetch()){
                #Définir les variables à partir des données de la base de données
                $id = html_entity_decode($row['id']);
                $first_name = html_entity_decode($row['first_name']);
                $last_name = html_entity_decode($row['last_name']);
                $age = html_entity_decode($row['age']);
                $phone = html_entity_decode($row['phone']);
                $area = html_entity_decode($row['area']);

                #Afficher les données dans le tableau
                echo "<tbody>
                <tr>
                <td data-label='ID'>$id</td>
                <td data-label='Last Name'>$last_name</td>
                <td data-label='First Name'>$first_name</td>
                <td data-label='Age'>$age</td>
                <td data-label='Phone'>$phone</td>
                <td data-label='Area'>$area</td>
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
                    #Définir la page suivante
                    $page_next = 2;
                }
                else {
                    #Définir la page suivante
                    $page_next = $_GET["page"] + 1;
                }
                #Définir la requête pour compter le nombre d'éléments dans la base de données
                $requete = "SELECT COUNT(*) as total FROM first";
                #Exécuter la requête
                $resultat = $cnn->query($requete) or die(print_r($bdd->errorInfo()));
                while($row = $resultat->fetch()){
                    #Définir le nombre d'éléments à partir de la page
                    $items = $total * $_GET["page"];
                    #Si le nombre d'éléments est supérieur au nombre d'éléments par page
                    if($row['total'] > $items) {
                        #Définir la page suivante
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
<!-- Inclure le script de recherche -->
<script src="../assets/js/query.js"></script>