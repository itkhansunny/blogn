<?php 
include("db.php");

$table = "category";

if(isset($_POST['submit'])){
    
    $id     = $_POST['id'];
    $name   = $_POST['name'];
    $slug   = strtolower($name);

    if(!empty($name)){  
        if(!preg_match('/[^\-_]/', $name)){
            header("location:category-create.php?alert=errorIC");
            exit();
        }
    }

    $sql = "UPDATE {$table} SET name='$name', slug='$slug' WHERE id = $id ";

    if($conn->query($sql)){
        header("location:category-create.php?alert=successU");
        exit();
    }else{
        header("location:category-create.php?id={$id}&alert=errorS");
        exit();
    }

}