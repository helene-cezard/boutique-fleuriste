<?php

  namespace app\models;

  use app\utils\Database;
  use PDO;

  class CoreModel
  {
      // =========================================================
      //  Properties
      // =========================================================

      protected $id;
      protected $created_at;
      protected $updated_at;
    
      // =========================================================
      //  Getters & Setters
      // =========================================================

      /**
       * Get the value of id
       */ 
      public function getId()
      {
            return $this->id;
      }

      /**
       * Get the value of created_at
       */ 
      public function getCreated_at()
      {
            return $this->created_at;
      }

      /**
       * Set the value of created_at
       *
       * @return  self
       */ 
      public function setCreated_at($created_at)
      {
            $this->created_at = $created_at;

            return $this;
      }

      /**
       * Get the value of updated_at
       */ 
      public function getUpdated_at()
      {
            return $this->updated_at;
      }

      /**
       * Set the value of updated_at
       *
       * @return  self
       */ 
      public function setUpdated_at($updated_at)
      {
            $this->updated_at = $updated_at;

            return $this;
      }
  }