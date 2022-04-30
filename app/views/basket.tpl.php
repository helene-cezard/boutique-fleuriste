<h2 class="section-title">Panier</h2>
<table class="basketTable">
  <thead>
    <tr>
      <th>Produit</th>
      <th>Quantité</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($basket as $item) : ?>
    <tr>
      <td><?= $item['product']->getName() ?></td>
      <td><?= $item['quantity'] ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>