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
      $user = new User;
      $this->show('signup', [
        'user' => $user
      ]);
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

      // Gestion des erreurs
      $errorList = [];
    
      if (empty($email) || $email === false) {
          $errorList['email'] = 'Veuillez renseigner votre e-mail';
      }
      if (empty($password) || $password === false) {
          $errorList['password'] = 'Veuillez renseigner votre mote de passe';
      }


      // Enregistrement en DB
      if (empty($errorList)) {
        $user = User::findByEmail($email);
  
        if ($user instanceof User) {
          if (password_verify($password, $user->getPassword())) {
            $_SESSION['userId'] = $user->getId();
            $_SESSION['userObject'] = $user;
  
            global $router;
            header('Location: ' . $router->generate('main-home'));
          } else {
            $errorList['password'] = "Mot de passe incorrect";
            $this->show('login', [
              'errorsList' => $errorList,
          ]);
          }
        } else {
          $errorList['email'] = "Utilisateur introuvable";
            $this->show('login', [
              'errorsList' => $errorList,
          ]);
        }
      } else {
        // Affichage des erreurs
        $this->show('login', [
            'errorsList' => $errorList,
        ]);
      }

    }

    /**
     * Méthode affichant la page de modification
     * du compte d'un utilisateur
     *
     * @return void
     */
    public function account()
    {
      if (isset($_SESSION['userObject'])) {
        $this->show('signup', [
          'user' => $_SESSION['userObject']
        ]);
      } else {
        global $router;
        header('Location: ' . $router->generate('main-home'));
      }
    }

    /**
     * Méthode affichant la page de modification
     * du compte d'un utilisateur
     *
     * @return void
     */
    public function accountPost()
    {
      global $router;
      if (isset($_SESSION['userObject'])) {

        $user = User::find($_SESSION['userId']);

        // Récupération des données du formulaire
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_UNSAFE_RAW);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_UNSAFE_RAW);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $oldPassword = filter_input(INPUT_POST, 'oldPassword', FILTER_UNSAFE_RAW);
        $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

        $errorList = [];

        if (!empty($password)) {
          if (password_verify($oldPassword, $user->getPassword())) {
            $password = password_hash($password, PASSWORD_ARGON2ID);
            $user->setPassword($password);
    
          } else {
            $errorList['oldPassword'] = 'Mauvais mot de passe';
            
            $this->show('signup', [
              'user' => $user,
              'errorsList' => $errorList,
            ]);
          }
        }
        
        $user->setEmail($email);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);

        $ok = $user->update();

        if ($ok) {
          $_SESSION['userObject'] = $user;

          $this->show('signup', [
            'user' => $user,
            'accountModified' => true
          ]);
        }
        
      } else {
        header('Location: ' . $router->generate('main-home'));
      }
    }

    /**
     * Méthode pour déconnecter l'utilisateur
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);
        unset($_SESSION['basket']);

        global $router;
        header('Location: ' . $router->generate('main-home'));
    }

    /**
     * Méthode affichant le panier de l'utilisateur
     *
     * @return void
     */
    public function basket()
    {
      $this->show('basket', [
        'basket' => $_SESSION['basket']
      ]);
    }
  }