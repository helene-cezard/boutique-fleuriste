<p class="stock" <?= $product->getStatus() == 1 ? 'style= "display: none;"' : '' ?>>Indisponible</p>
<h2 class="section-title"><?= $product->getName() ?></h2>
<div class="product">
    <img class="illustration" src="<?= $product->getPicture() ?>" alt="Photo de <?= $product->getName() ?>">
    <div class="product_details">
        <p class="description"><?= $product->getDescription() ?></p>
        <form action="" method="POST">
            <label for="quantity">Quantité</label>
            <input type="number" max="5" name="quatity" <?= $product->getStatus() == 1 ? "" : "disabled" ?>>
            <input type="hidden" name="productId" value="<?= $product->getId() ?>">
            <p>Disponibilité : <?= $product->getStatus() == 1 ? "En stock" : "Indisponible"; ?></p>
            <button type="submit">Ajouter au panier</button>
        </form>
    </div>
</div>