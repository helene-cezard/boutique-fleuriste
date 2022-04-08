<?php

namespace app\models;

use app\utils\Database;
use PDO;

class Product extends CoreModel
{
    // =========================================================
    //  Properties
    // =========================================================

    protected $name;
    protected $description;
    protected $picture;
    protected $price;
    protected $status;

    // =========================================================
    //  Methods
    // =========================================================

    /**
     * Find a Product by id
     * @param $id ID of the searched Product in database
     * @return 
     */
    public function find( $id )
    {
      $pdo = Database::getPDO();
      $sql = "SELECT * FROM `product` WHERE `id` = ".$id;
      $statement = $pdo->query( $sql );
      $productObject = $statement->fetchObject( self::class );
      return $productObject;
    }

    /**
     * Find all Categories
     * @return 
     */
    public function findAll()
    {
      $pdo = Database::getPDO();
      $sql = "SELECT * FROM `product`";
      $statement = $pdo->query( $sql );
      $allProductObjects = $statement->fetchAll( PDO::FETCH_CLASS, self::class );
      return $allProductObjects;
    }

    public function findForHomepage()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `product` WHERE `homepage` = 1";
        $statement = $pdo->query( $sql );
        $allProductObjects = $statement->fetchAll( PDO::FETCH_CLASS, self::class );
        return $allProductObjects;
    }

    public function findByCategory( $id )
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `product` WHERE `category_id` = ".$id;
        $statement = $pdo->query( $sql );
        $allProductObjects = $statement->fetchAll( PDO::FETCH_CLASS, self::class );
        return $allProductObjects;
    }
    
    // =========================================================
    //  Getters & Setters
    // =========================================================
    
    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}