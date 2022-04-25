<h2 class="section-title">Nos bouquets</h2>
<div class="flower-cards">

    <?php foreach($products as $product) : ?>
        <a href="<?= $router->generate('main-item', [ 'id' => $product->getId() ]) ?>">
            <div class="flower-cards__element">
                <img src="<?= $product->getPicture() ?>" alt="Images de <?= $product->getName() ?>">
                <p><?= $product->getName() ?></p>
            </div>
        </a>
    <?php endforeach; ?>
</div>
