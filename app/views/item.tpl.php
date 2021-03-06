<p class="stock" <?= $product->getStatus() == 1 ? 'style= "display: none;"' : '' ?>>Indisponible</p>
<h2 class="section-title"><?= $product->getName() ?></h2>
<div class="product">
    <img class="illustration" src="<?= $product->getPicture() ?>" alt="Photo de <?= $product->getName() ?>">
    <div class="product_details">
        <p class="error"><?= $connectionError ?></p>
        <p class="description"><?= $product->getDescription() ?></p>
        <form action="" method="POST">
            <label for="quantity">QuantitÃ©</label>
            <input type="number" max="5" name="quantity" value="1" <?= $product->getStatus() == 1 ? "" : "disabled" ?>>
            <p class="error"><?= $quantityError ?></p>
            <input type="hidden" name="productId" value="<?= $product->getId() ?>">
            <p>DisponibilitÃ© : <?= $product->getStatus() == 1 ? "En stock" : "Indisponible"; ?></p>
            <button type="submit">Ajouter au panier</button>
        </form>
    </div>
</div>