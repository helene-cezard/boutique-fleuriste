<p class="stock" <?= $product->getStatus() == 1 ? 'style= "display: none;"' : '' ?>>Indisponible</p>
<h2 class="section-title"><?= $product->getName() ?></h2>
<div class="product">
    <img class="illustration" src="<?= $product->getPicture() ?>" alt="Photo de <?= $product->getName() ?>">
    <div class="product_details">
        <p class="description"><?= $product->getDescription() ?></p>
        <form action="">
            <label for="quantity">Quantité</label>
            <input type="number" max="5" <?= $product->getStatus() == 1 ? "" : "disabled" ?>>
            <p>Disponibilité : <?= $product->getStatus() == 1 ? "En stock" : "Indisponible"; ?></p>
            <button>Acheter</button>
        </form>
    </div>
</div>