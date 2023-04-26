<?php
  
  require_once __DIR__ . "/../vendor/autoload.php";

  session_start();

  //====================================================================
  // ROUTER
  //====================================================================

  $router = new AltoRouter();
  $router->setBasePath( $_SERVER['BASE_URI'] );

  //====================================================================
  // ROUTES
  //====================================================================

  // Routes MainController ---------------------------------------------

  // Route de la page d'accueil
  $router->map( 
    "GET",
    "/",
    [ 'controller' => "\\app\\controllers\\MainController", 'method' => "home" ],
    "main-home"
  );

  // Route des pages d'articles
  $router->map( 
    "GET",
    "/item/[i:id]",
    [ 'controller' => "\\app\\controllers\\MainController", 'method' => "item" ],
    "main-item"
  );

  // Ajout d'un article dans le panier
  $router->map( 
    "POST",
    "/item/[i:id]",
    [ 'controller' => "\\app\\controllers\\MainController", 'method' => "itemPost" ],
    "main-item-post"
  );

  // Suppression d'un article dans le panier
  $router->map(
    "GET",
    "/basket/[i:id]",
    [ 'controller' => "\\app\\controllers\\MainController", 'method' => 'itemDelete'],
    "main-item-delete"
  );

  // Route de la page des bouquets
  $router->map( 
    "GET",
    "/bouquets",
    [ 'controller' => "\\app\\controllers\\MainController", 'method' => "bouquets" ],
    "main-bouquets"
  );

  // Route de la page des plantes en pot
  $router->map( 
    "GET",
    "/pots",
    [ 'controller' => "\\app\\controllers\\MainController", 'method' => "pots" ],
    "main-pots"
  );

  // Route de la page des compositions
  $router->map( 
    "GET",
    "/compositions",
    [ 'controller' => "\\app\\controllers\\MainController", 'method' => "compositions" ],
    "main-compositions"
  );

  // Routes UserController ---------------------------------------------

  // Route de la page d'enregistrement d'un utilisateur
  $router->map(
    "GET",
    "/signup",
    [ 'controller' => "\\app\\controllers\\UserController", 'method' => "signup" ],
    "user-signup"
  );

  // Récupération des données d'enregistrement d'un utilisateur
  $router->map(
    "POST",
    "/signup",
    [ 'controller' => "\\app\\controllers\\UserController", 'method' => "signupPost" ],
    "user-signup-post"
  );

  // Route de la page de connexion d'un utilisateur
  $router->map(
    "GET",
    "/login",
    [ 'controller' => "\\app\\controllers\\UserController", 'method' => "login" ],
    "user-login"
  );

  // Récupération des données de connexion d'un utilisateur
  $router->map(
    "POST",
    "/login",
    [ 'controller' => "\\app\\controllers\\UserController", 'method' => "loginPost" ],
    "user-login-post"
  );

  // Page de modification du compte utilisateur
  $router->map(
    "GET",
    "/account",
    [ 'controller' => "\\app\\controllers\\UserController", 'method' => "account" ],
    "user-account"
  );

  // Modification du compte utilisateur
  $router->map(
    "POST",
    "/account",
    [ 'controller' => "\\app\\controllers\\UserController", 'method' => "accountPost" ],
    "user-account-post"
  );

  // Déconnexion de l'utilisateur
  $router->map(
    "GET",
    "/logout",
    [ 'controller' => "\\app\\controllers\\UserController", 'method' => "logout" ],
    "user-logout"
  );

    // Page du panier de l'utilisateur
    $router->map(
      "GET",
      "/basket",
      [ 'controller' => "\\app\\controllers\\UserController", 'method' => "basket" ],
      "user-basket"
    );

    // Suppression du panier de l'utilisateur
    $router->map(
      "POST",
      "/basket",
      [ 'controller' => "\\app\\controllers\\UserController", 'method' => "basketDelete" ],
      "user-basket-delete"
    );

    // Page 404
    $router->map(
      "GET",
      "/not_found",
      [ 'controller' => "\\app\\controllers\\ErrorController", 'method' => "notFound" ],
      "not-found"
    );

  // AltoRouter cherche la route
  $routeInfo = $router->match();

  if( $routeInfo === false )
  {
    http_response_code( 404 );
    header('Location: ' . $router->generate('not-found'));
    // exit( "Page non trouvée" );
  }
  
  // Informantions nécessaires au dispatcher
  $dispatchInfo = $routeInfo['target'];

  $controllerName = $dispatchInfo['controller'];
  $methodName     = $dispatchInfo['method'];

  //====================================================================
  // DISPATCHER
  //====================================================================

  $controller = new $controllerName();
  $controller->$methodName( $routeInfo['params'] );