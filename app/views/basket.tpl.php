<h2 class="section-title">Panier</h2>
<table class="basketTable">
  <thead>
    <tr>
      <th>Produit</th>
      <th>Quantité</th>
      <th>Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($basket as $item) : ?>
    <tr>
      <td><?= $item['product']->getName() ?></td>
      <td><?= $item['quantity'] ?></td>
      <td class="delete-item"><button><a href="<?= $router->generate('main-item-delete', [ 'id' => $item['product']->getId() ]) ?>">X</a></button></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
