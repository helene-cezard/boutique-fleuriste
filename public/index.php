<?php
  
  require_once __DIR__ . "/../vendor/autoload.php";

  // require_once __DIR__ . "/../app/controllers/MainController.php";


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

  // Route de la page de connexion
  $router->map(
    "GET",
    "/signup",
    [ 'controller' => "\\app\\controllers\\MainController", 'method' => "signup" ],
    "main-signup"
  );

  // AltoRouter cherche la route
  $routeInfo = $router->match();

  if( $routeInfo === false )
  {
    http_response_code( 404 );
    exit( "Page non trouvée" );
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