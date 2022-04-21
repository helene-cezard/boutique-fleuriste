<?php 

  namespace app\controllers;

use app\models\Product;
use app\models\User;

  class CoreController
  {
    /**
     * Méthode permettant d'afficher une vue (HTML)
     * 
     * @param string $viewName
     * @param array $viewVars
     * @return void
     */
    protected function show( $viewName, $viewVars = [] )
    {      
      global $router;
      extract( $viewVars );

      // ===== Affichage des vues ========

      require_once __DIR__.'/../views/partials/header.tpl.php';
      require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
      require_once __DIR__.'/../views/partials/footer.tpl.php';
    }
  }