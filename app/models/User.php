<?php

namespace app\models;

use app\utils\Database;
use PDO;

class User extends CoreModel
{
    // =========================================================
    //  Properties
    // =========================================================

    protected $email;
    protected $password;
    protected $firstname;
    protected $lastname;

    // =========================================================
    //  Methods
    // =========================================================

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = '
            INSERT INTO
            `user` (lastname, firstname, email, password)
            VALUES (:lastname, :firstname, :email, :password)  
        ';

        $pdoStatement = $pdo->prepare($sql);

        $inserted = $pdoStatement->execute(
            [
                'lastname' => $this->getLastname(),
                'firstname' => $this->getFirstname(),
                'email' => $this->getEmail(),
                'password' => $this->getPassword()
            ]
            );

            // Véfification que l'enregistrement a bien fonctionné
            if ($inserted) {
                $this->id = $pdo->lastInsertId();
                return true;
            }
    
            return false;
    }

    // =========================================================
    //  Getters & Setters
    // ========================================================= 

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }
}