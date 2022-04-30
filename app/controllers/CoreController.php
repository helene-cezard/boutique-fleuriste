<?php 

  namespace app\controllers;

use app\models\Product;
use app\models\User;

  class CoreController
  {
    public function __construct()
    {
     global $routeInfo;
     $routeName = $routeInfo['name'];

     // Liste des routes pour lesquelles il faut créer un token CSRF
     $csrfTokenToCreate = [
      'user-account',
      ];

      // Création du token
      if (in_array($routeName, $csrfTokenToCreate)) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
      }

      // Liste des routes pour lesquelles il faut vérifier un token CSRF
      $csrfTokenToCheckInPost = [
        'user-account-post',
      ];

      if (in_array($routeName, $csrfTokenToCheckInPost)) {

        $token = isset($_POST['token']) ? $_POST['token'] : '';
        $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';

        if ($token !== $sessionToken || empty($token)) {
            http_response_code(403);
            $this->show('error/err403');
            exit;
        } else {
            unset($_SESSION['token']);
        }
      }
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
      global $router;
      extract( $viewVars );

      // ===== Affichage des vues ========

      require_once __DIR__.'/../views/partials/header.tpl.php';
      require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
      require_once __DIR__.'/../views/partials/footer.tpl.php';
    }
  }