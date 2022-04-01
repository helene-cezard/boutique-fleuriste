<h2 class="section-title"><?= $product->getName() ?></h2>
<p class="description"><?= $product->getDescription() ?></p>
<img class="illustration" src="<?= $product->getPicture() ?>" alt="Photo de cyclamens">
<form action="">
    <label for="quantity">Quantité</label>
    <input type="number" max="5">
    <label for="availablity">Disponibilité</label>
    <select name="availablity" id="availablity">
        <option value="in-stock">en stock</option>
        <option value="pre-order">disponible en pré-commande</option>
        <option value="unavailable">rupture de stock</option>
    </select>
</form>