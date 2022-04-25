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

    public function itemPost ( $params ) {
      dump($_POST);
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
  }