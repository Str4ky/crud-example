<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png" />
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
        <a href="../../" class="link"><i class="fa-solid fa-house navbar-icon"></i>Accueil</a>
        <a href="../" class="link"><i class="fa-solid fa-1 navbar-icon"></i> Premiers éléments</a>
        <a href="../../second" class="link"><i class="fa-solid fa-2 navbar-icon"></i>Seconds éléments</a>
    </div>
    <div class="main">
        <h1 class="label">Ajouter un élément</h1>
        <br>
        <form action="add.php" method="POST">
            <label>Nom</label><br>
            <input type="text" name="last_name" placeholder="Nom" required><br>
            <label>Prénom</label><br>
            <input type="text" name="first_name" placeholder="Prénom" required><br>
            <label>Âge</label><br>
            <input type="number" name="age" placeholder="Âge" min="1" required><br>
            <label>N° de téléphone</label><br>
            <input type="text" name="phone" placeholder="N° de téléphone" required><br>
            <label>Lieu</label><br>
            <input type="text" name="area" placeholder="Lieu" required><br>
            <button type="submit" class="table-button add"><i class="fa-solid fa-plus"></i> Ajouter l'élément</button>
        </form>
    </div>
</body>
</html>