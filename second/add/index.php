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
        <a href="../../first" class="link"><i class="fa-solid fa-1 navbar-icon"></i> Premiers éléments</a>
        <a href="../" class="link"><i class="fa-solid fa-2 navbar-icon"></i>Seconds éléments</a>
    </div>
    <div class="main">
        <h1 class="label">Ajouter un élément</h1>
        <br>
        <form action="add.php" method="POST">
            <label>Nom</label><br>
            <input type="text" name="name" placeholder="Nom" required><br>
            <label>Description</label><br>
            <input type="text" name="description" placeholder="Description" required><br>
            <label>Prix</label><br>
            <input type="number" name="price" placeholder="Prix" min="0" required><br>
            <button type="submit" class="table-button add"><i class="fa-solid fa-plus"></i> Ajouter l'élément</button>
        </form>
    </div>
</body>
</html>