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
                    <div class="connection">Connexion</div>
                    <h1 class="shop-name">La belle plante</h1>
                </div>
                <nav class="navbar">
                    <label for="toggle" class="burger-icon">☰</label>
                    <input type="checkbox" id="toggle">
                    <ul class="navbar__menu">
                        <li class="navbar__element <?= $_SERVER['BASE_URI'] . '/' == $_SERVER['REQUEST_URI'] ? "navbar__element--selected" : "" ?>"><a href="<?= $_SERVER['BASE_URI']; ?>">Page d'accueil</a></li>
                        <li class="navbar__element <?= $_SERVER['BASE_URI'] . '/bouquets' == $_SERVER['REQUEST_URI'] ? "navbar__element--selected" : "" ?>"><a href="<?= $_SERVER['BASE_URI']; ?>/bouquets">Bouquets</a></li>
                        <li class="navbar__element <?= $_SERVER['BASE_URI'] . '/pots' == $_SERVER['REQUEST_URI'] ? "navbar__element--selected" : "" ?>"><a href="<?= $_SERVER['BASE_URI']; ?>/pots">Plantes en pot</a></li>
                        <li class="navbar__element <?= $_SERVER['BASE_URI'] . '/compositions' == $_SERVER['REQUEST_URI'] ? "navbar__element--selected" : "" ?>"><a href="<?= $_SERVER['BASE_URI']; ?>/compositions">Compositions</a></li>
                    </ul>
                </nav>
            </header>
            <main>
