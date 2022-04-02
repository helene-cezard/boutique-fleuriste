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


  //TODO Autres routes ici :

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