<h2 class="section-title">Panier</h2>

<div class="basket">
  <?php if(empty($basket)) : ?>
    <p>Le panier est vide.</p>
    <button><a href="<?= $router->generate('main-home') ?>">Retourner à la page d'accueil</a></button>
    <?php else : ?>
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
  <form action="" method="POST">
    <button class="delete-button" type="submit">Supprimer le panier</button>
  </form>
  <?php endif ?>
</div>