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

    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
            UPDATE `user`
            SET
                lastname = :lastname,
                firstname = :firstname,
                email = :email,
                password = :password,
                updated_at = NOW()
            WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $updated = $pdoStatement->execute(
            [
                'lastname' => $this->lastname,
                'firstname' => $this->firstname,
                'email' => $this->email,
                'password' => $this->password,
                'id' => $this->id,
            ]
        );

        return $updated;
    }

    public static function find($id)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `user` WHERE `id` =' . $id;
        $pdoStatement = $pdo->query($sql);
        $user = $pdoStatement->fetchObject('app\models\User');
        return $user;
    }

    public static function findByEmail($email)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `user` WHERE `email` = :email';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute(
            [
                'email' => $email
            ]
        );
        return $pdoStatement->fetchObject(self::class);
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