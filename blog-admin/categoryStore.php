<?php 
include("db.php");

$table = "category";

if(isset($_POST['submit'])){
    
    $name = $_POST['name'];
    $slug = strtolower($name);

    if(!empty($name)){  
        if(!preg_match('/^[A-Za-z0-9-]+$/D', $name)){
            header("location:category-create.php?alert=errorIC");
            exit();
        }
    }

    $sql = "INSERT INTO {$table} (name, slug) VALUES ('$name', '$slug')";

    if($conn->query($sql)){
        header("location:category-create.php?alert=successS");
        exit();
    }else{
        header("location:category-create.php?alert=errorS");
        exit();
    }

}