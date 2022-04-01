<?php 

  namespace app\controllers;

use app\models\Product;

  class MainController
  {
    public function home()
    {
      $productModel = new Product;
      $products = $productModel->findAll();
      $this->show('home', ['products' => $products]);
    }

    public function item( $params )
    {
      $productModel = new Product;
      $product = $productModel->find( $params['id'] );
      $this->show('item', ['product' => $product]);
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