<?php 
include("db.php");

$table = "category";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM {$table} Where id={$id}";

    if($conn->query($sql)){
        header("location:category-create.php?alert=successDel");
        exit();
    }else{
        header("location:category-create.php?alert=errorDel");
        exit();
    }

}