<?php 

  namespace app\controllers;

use app\models\Product;
use app\models\User;

  class UserController extends CoreController
  {
    /**
     * Méthode affichant la page d'enregistrement
     * d'un utilisateur
     *
     * @return void
     */
    public function signup()
    {
      $this->show('signup');
    }

    /**
     * Méthode gérant les informations envoyées par le
     * formulaire d'enregistrement d'un utilisateur
     *
     * @return void
     */
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
        // Affichage des erreurs
        $this->show('signup', [
            'user' => new User(),
            'errorsList' => $errorList,
        ]);
      }
    }

    /**
     * Méthode affichant la page de connexion
     * d'un utilisateur
     */
    public function login()
    {
      $this->show('login');
    }

    public function loginPost()
    {
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

      $user = User::findByEmail($email);

      if ($user instanceof User) {
        if (password_verify($password, $user->getPassword())) {
          $_SESSION['userId'] = $user->getId();
          $_SESSION['userObject'] = $user;

          global $router;
          header('Location: ' . $router->generate('main-home'));
        } else {
          echo 'PAS OK !';
        }
      } else {
        echo 'Utilisateur introuvable';
      }
    }
  }