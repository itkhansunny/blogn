<?php 
session_start();

unset($_SESSION['logIn']);
unset($_SESSION['username']);
unset($_SESSION['email']);

if(!$_SESSION['logIn']){
    header('location:login.php');
}
