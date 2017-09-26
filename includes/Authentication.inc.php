<?php
   require_once './includes/AuthA.inc.php'; // include the login parent
/*
 * Login mechanism for educational purposes.
 * Experimental
 * Should be project specific
 * Copyright nml, 2015
 */

/**
 * Description of Authentication
 * Authentication is a Singleton, hence the private constructor.
 * It is instantiated by Authentication::authenticate()
 * @author nml
 */
class Authentication extends AuthA {
    const DISPVAR = 'waldo42';
    private $firstname;

    private function __construct($email, $pwd) {
        try {
            self::dbLookUp($email, $pwd);         // invoke auth
            $_SESSION[self::SESSVAR] = $this->getEmail(); // if succesfull
            $_SESSION[self::DISPVAR] = $this->getFirstname();   // if succesfull
        }
        catch (Exception $e) {
            self::$logInstance = NULL;
        }    
    }

    public static function authenticate($email, $pwd) {
        if (self::$logInstance === NULL) {
            self::$logInstance = new Authentication($email, $pwd);
        }
        return self::$logInstance;
    }
    
    protected function dbLookUp($email, $pwdtry) {
      // Using prepared statements to prevent SQL injection
        $db = DbH::getDbH();
        $sql = "select firstname, password, email 
                from voter
                where email = :email";
        try {
            $q = $db->prepare($sql);
            $q->bindValue(':email', $email);
            $q->execute();
            $row = $q->fetch();
            if ($row['email'] === $email
                    && password_verify($pwdtry, $row['password'])) { 
                $this->firstname = $row['firstname'];
                $this->email = $email;
            } else {
                throw new Exception("Not authenticated", 42);
            }
        } catch(PDOException $e) {
            die($e->getMessage()); 
        }
    }
    
    private function getFirstname() {
        return $this->firstname;
    }
    
    public static function getDispvar() {
        return $_SESSION[self::DISPVAR];
    }
}