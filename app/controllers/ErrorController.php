<?php 

  namespace app\controllers;

class ErrorController extends CoreController
{
    public function notFound()
    {
      $this->show('error/err404', []);
    }
}