<?php 

  namespace app\controllers;

use app\models\Product;
use app\models\User;

  class MainController extends CoreController
  {
    public function home()
    {
      $productModel = new Product;
      $products = $productModel->findForHomepage();
      $this->show('home', ['products' => $products]);
    }

    public function item( $params )
    {
      $productModel = new Product;
      $product = $productModel->find( $params['id'] );
      $this->show('item', ['product' => $product]);
    }

    public function itemPost () {

      global $router;

      $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
      $productId = filter_input(INPUT_POST, 'productId', FILTER_VALIDATE_INT);

      $productModel = new Product;
      $product = $productModel->find( $productId );

      if (isset($_SESSION['userObject'])) {
        if (!empty($quantity) && $quantity > 0)  {
          $productName = $product->getName();
          $_SESSION['basket'][$productName] = [
            'product' => $product,
            'quantity' => $quantity,
          ];
          header('Location: ' . $router->generate('user-basket'));
        } else {
          $this->show('item', [
            'product' => $product,
            'quantityError' => 'Veuillez entrer une quantité de 1 minimum.'
          ]);
        }
      } else {
        $this->show('item', [
          'product' => $product,
          'connectionError' => 'Veuillez vous connecter'
        ]);
      }
    }

    public function itemDelete ( $params ) {

      global $router;

      $productModel = new Product;
      $product = $productModel->find( $params['id'] );
      $productName = $product->getName();

      unset($_SESSION['basket'][$productName]);

      header('Location: ' . $router->generate('user-basket'));
    }

    public function bouquets()
    {
      $productModel = new Product;
      $products = $productModel->findByCategory( 1 );
      $this->show('bouquets', ['products' => $products]);
    }

    public function pots()
    {
      $productModel = new Product;
      $products = $productModel->findByCategory( 2 );
      $this->show('pots', ['products' => $products]);
    }

    public function compositions()
    {
      $productModel = new Product;
      $products = $productModel->findByCategory( 3 );
      $this->show('compositions', ['products' => $products]);
    }

    public function contact()
    {
      $this->show('contact');
    }

    public function legal()
    {
      $this->show('legal');
    }
  }