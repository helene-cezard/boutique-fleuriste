<?php 

  namespace app\controllers;

use app\models\Product;

  class MainController
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

    public function signup()
    {
      $this->show('signup');
    }

    /**
     * Méthode permettant d'afficher une vue (HTML)
     * 
     * @param string $viewName
     * @param array $viewVars
     * @return void
     */
    protected function show( $viewName, $viewVars = [] )
    {      
      // global $router;
      extract( $viewVars );

      // ===== Affichage des vues ========

      require_once __DIR__.'/../views/partials/header.tpl.php';
      require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
      require_once __DIR__.'/../views/partials/footer.tpl.php';
    }
  }