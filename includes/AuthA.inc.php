<?php
/*
 * Login mechanism for educational purposes.
 * Experimental
 * Should be project agnostic
 * Copyright nml, 2015
 */

/**
 * Abstract class for the login mechanism.
 * @author nml
 */
abstract class AuthA {
  const SESSVAR = 'nAuth42';
  protected $email;
  protected static $logInstance = NULL;


  public static function isAuthenticated() {
    return isset($_SESSION[self::SESSVAR]) ? true : false;
  }

  private static function setTestCookie() {
    setcookie('foo', 'bar', time() + 3600);
  }

  public static function areCookiesEnabled() {
    self::setTestCookie();
    return (isset($_COOKIE['foo']) && $_COOKIE['foo'] == 'bar') ? true : false;
  }
    
  public static function logout() {
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(), '', 0, '/');
    session_regenerate_id(true);
  }
    
    abstract protected function dbLookUp($email, $passwordattempt);
    
    protected function getEmail() {
        return $this->email;
    }
}