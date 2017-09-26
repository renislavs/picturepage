<?php
    session_start();
    require_once './includes/Authentication.inc.php';
    
    if (Authentication::isAuthenticated()) {
        Authentication::Logout();
    }
    header('Location: ./index.php?notAuth');