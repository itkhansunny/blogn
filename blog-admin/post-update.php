<?php 

include("db.php");

$fileAttName    = "uploadedFile";
$uploadDir      = "postimage/";
$MaxFileSize    = 1000*1000;
$FileExtension  = ['png', 'jpg','jpeg'];
$FileMime       = ['image/png', 'image/jpeg'];
$table          = "post";

if(isset($_POST['submit'])){
    
    $id             = $_POST['id'];
    $filename       = $_POST['filename'];
    $title          = $_POST['post-title'];
    $content        = $_POST['post-content'];
    $category       = $_POST['post-category'];
    $status         = $_POST['post-status'];
    $createon       = $updateon = time();

    if($_FILES['uploadedFile']['size']>0){

        if(file_exists($uploadDir.$filename) && !is_dir($uploadDir.$filename)){
            unlink($uploadDir.$filename);
        }

        /* Upload Function Start */

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

        function handelFile($uploadDir, $MaxFileSize, $fileAttName, $id){
            $tempName   = $_FILES[$fileAttName]['tmp_name'];
            $filename   = basename($_FILES[$fileAttName]['name']);
            $isUpload   = is_uploaded_file($tempName);
            $validSize  = $_FILES[$fileAttName]['size']<= $MaxFileSize && $_FILES[$fileAttName]['size'] >= 0;

            if($isUpload && $validSize && allowedFiles($tempName, $filename)){
                $time           = date("ymd-His");
                $fileExtension  = pathinfo($filename, PATHINFO_EXTENSION);
                $fileNewName    = $time.".".$fileExtension;
                if(!move_uploaded_file($tempName, $uploadDir.$fileNewName)){
                    header('location:post-edit.php?alert=uFail');
                    // header("location: update.php?id=".$id."&msg=notingUpload");
                    exit();
                }
            }else{
                header('location:post-create.php?alert=invFormat');
                // header("location: update.php?id={$id}&msg=error");
                exit();
            }

            return $fileNewName; // return array 
        }

        /* Upload Function End*/

       $fileNewName =  handelFile($uploadDir, $MaxFileSize, $fileAttName, $id);

        $sql = "UPDATE {$table} SET title='$title', content = \"$content\", category='$category', status = '$status', filename = '$fileNewName' WHERE id = $id ";

        if($conn->query($sql) == TRUE)
        {
            header('location:view.php?msg=success');
            exit();
        }

    }

    $sql = "UPDATE {$table} SET title='$title', content = '$content', category='$category', status = '$status', filename = '$filename' WHERE id = $id ";

    if($conn->query($sql) == TRUE)
    {
        header('location:post-index.php?msg=success');
        exit();
    }

}