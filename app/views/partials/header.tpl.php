<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleuriste</title>
    <link rel="stylesheet" href="<?= $_SERVER['BASE_URI']; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?= $_SERVER['BASE_URI']; ?>/assets/css/styles.css">
</head>
<body>
    <div class="page-container">
        <div class="content-wrap">
            <header>
                <div class="title-connection">
                    <h1 class="shop-name">La belle plante</h1>
                    <div class="connection">Connexion</div>
                </div>
                <nav class="navbar">
                    <label for="toggle" class="burger-icon">☰</label>
                    <input type="checkbox" id="toggle">
                    <ul class="navbar__menu">
                        <li class="navbar__element navbar__element--connection">Connexion</li>
                        <li class="navbar__element navbar__element--selected">Page d'accueil</li>
                        <li class="navbar__element">Bouquets</li>
                        <li class="navbar__element">Plantes en pot</li>
                        <li class="navbar__element">Compositions</li>
                        <li class="navbar__element">Catégories</li>
                    </ul>
                </nav>
            </header>
            <main>
