<p class="stock" <?= $product->getStatus() == 1 ? 'style= "display: none;"' : '' ?>>Indisponible</p>
<h2 class="section-title"><?= $product->getName() ?></h2>
<div class="product">
    <img class="illustration" src="<?= $product->getPicture() ?>" alt="Photo de <?= $product->getName() ?>">
    <div class="product_details">
        <?php if(isset($connectionError)) : ?>
            <p class="error"><?= $connectionError ?></p>
        <?php endif ?>
        <p class="description"><?= $product->getDescription() ?></p>
        <form class="order-form" action="" method="POST">
            <label class="quantity-label" for="quantity">Quantité</label>
            <input class="quantity-input" type="number" max="5" name="quantity" value="1" <?= $product->getStatus() == 1 ? "" : "disabled" ?>>
            <p class="error"><?= $quantityError ?></p>
            <input type="hidden" name="productId" value="<?= $product->getId() ?>">
            <p>Disponibilité : <?= $product->getStatus() == 1 ? "En stock" : "Indisponible"; ?></p>
            <button class="submit" type="submit">Ajouter au panier</button>
        </form>
    </div>
</div>