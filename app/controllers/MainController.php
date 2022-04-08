<?php 

  namespace app\controllers;

use app\models\Product;
use app\models\User;

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

    public function signupPost()
    {
      // Récupération des données du formulaire
      $lastname = filter_input(INPUT_POST, 'lastname', FILTER_UNSAFE_RAW);
      $firstname = filter_input(INPUT_POST, 'firstname', FILTER_UNSAFE_RAW);
      $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
      $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

      // Gestion des erreurs
      $errorList = [];
    
      if (empty($firstname) || $firstname === false) {
          $errorList['firstname'] = 'Veuillez renseigner votre prénom';
      }
      if (empty($lastname) || $lastname === false) {
          $errorList['lastname'] = 'Veuillez renseigner votre nom';
      }
      if (empty($email) || $email === false) {
          $errorList['email'] = 'Veuillez renseigner un email valide';
      }
      if (empty($password) || $password === false) {
          $errorList['password'] = 'Veuillez renseigner un MDP valide';
      }


      // Enregistrement en DB
      if (empty($errorList)) {
       
          $user = new User();
          $password = password_hash($password, PASSWORD_ARGON2ID);

          $user->setEmail($email);
          $user->setPassword($password);
          $user->setFirstname($firstname);
          $user->setLastname($lastname);


          if ($user->insert()) {
              global $router;
              header('Location: ' . $router->generate('main-home'));
              exit;

          } else {
              $errorList[] = 'Utilisateur non enregistré';

              $this->show('signup', [
                  'user' => $user,
                  'errorsList' => $errorList,
              ]);
          }

      } else {
          // Si on a une ou plusieurs erreurs
          // On demande à générer une vue avec le même template 
          // auquel on envoie un $user vide, même si les données sont erronnées
          $this->show('signup', [
              'user' => new User(),
              'errorsList' => $errorList,
          ]);
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