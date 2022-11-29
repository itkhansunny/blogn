<?php

include("db.php");

$postTable = 'post';

/* Upload Function Start */

$fileAttName    = "uploadedFile";
$uploadDir      = "postimage/";
$MaxFileSize    = 1000*1000;
$FileExtension  = ['png', 'jpg','jpeg'];
$FileMime       = ['image/png', 'image/jpeg'];

// Advance file upload
function allowedFiles($tempFileName, $uploadPath){
    global $FileExtension, $FileMime;
    //Get File extension and file mime type 
    $fileExt        = pathinfo($uploadPath, PATHINFO_EXTENSION);
    $fileMime       = mime_content_type($tempFileName);
    // Check is it in array
    $checkExt       = in_array($fileExt, $FileExtension);
    $checkMime      = in_array($fileMime, $FileMime);
    $allowedFile    = $checkExt && $checkMime;
    return $allowedFile; // 1
}

function handelFile($uploadDir, $MaxFileSize, $fileAttName ){
    $tempName   = $_FILES[$fileAttName]['tmp_name'];
    $filename   = basename($_FILES[$fileAttName]['name']);
    $isUpload   = is_uploaded_file($tempName);
    $validSize  = $_FILES[$fileAttName]['size']<= $MaxFileSize && $_FILES[$fileAttName]['size'] >= 0;

    if($isUpload && $validSize && allowedFiles($tempName, $filename)){
        $time           = date("ymd-His");
        $fileExtension  = pathinfo($filename, PATHINFO_EXTENSION);
        $fileNewName    = $time.".".$fileExtension;
        if(!move_uploaded_file($tempName, $uploadDir.$fileNewName)){
            header('location:post-create.php?alert=uFail');
            exit();
        }
    }else{
        header('location:post-create.php?alert=invFormat');
        exit();
    }

    return $fileNewName; // return array 
}

/* Upload Function End*/


if(isset($_POST['submit'])){

    $title          = $_POST['post-title'];
    $content        = $_POST['post-content'];
    $category       = $_POST['post-category'];
    $status         = $_POST['post-status'];
    $filename       = handelFile($uploadDir,$MaxFileSize,$fileAttName);
    $createon = $updateon = time();

    if(empty($title)){
        header('location:post-create.php?alert=eTitle');
        exit();
    }
    
    if(empty($content)){
        header('location:post-create.php?alert=eContent');
        exit();
    }
    
    if($category == ""){
        header('location:post-create.php?alert=eCategory');
        exit();
    }

    if($status == ""){ 
        header('location:post-create.php?alert=eStatus');
        exit();
    }

    $sql = "INSERT INTO {$postTable} (title, content, category, status, filename, createon, updateon) VALUES ('$title', '$content', '$category', '$status', '$filename', '$createon', '$updateon')";

    if($conn->query($sql)){
        header("location:post-index.php?alert=success");
        exit();
    }
}