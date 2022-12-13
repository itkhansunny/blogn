<?php
session_start();

include("db.php");

if(isset($_POST['submit'])){

    $oldPassword        = $_POST['oldpass'];
    $newPassword        = $_POST['newpass'];
    $confirmPassword    = $_POST['conpass'];
    $newPassHash        = password_hash($newPassword, PASSWORD_DEFAULT);

    $username = $_SESSION['username'];

    $sql = "SELECT * FROM users WHERE username = '{$username}'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        
        $hash = $row['password'];

        if(password_verify($oldPassword , $hash)){
            if($newPassword == $confirmPassword){
                $sql = "UPDATE users SET password='$newPassHash' WHERE username = $username ";
                $_SESSION['error'] = "Old Password incorrect";
                header('location:change-password.php');
            }
        }else{
            $_SESSION['error'] = "Old Password incorrect";
            header('location:change-password.php');
        }
    }else{
        $_SESSION['error'] = "User not found!";
        header('location:change-password.php');
    }

    

}