<?php

/**
 * Description of PicturePage Voter (user).
 *
 * @author Marianne
 */
class Voter {
    
    private $firstname;
    private $password;
    private $email;

    function __construct($firstname, $password, $email) {
        $this->firstname = $firstname;
        $this->password = $password;
        $this->email = $email;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }
}
