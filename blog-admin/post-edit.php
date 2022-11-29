<?php 
include("header.php");

include("db.php");

$table = "post";

$alert = "";
$message = "";

$successS   = "Category stored successfully";
$successDel = "Category deleted successfully";
$errorIC    = "Name contain letters only";
$errorS     = "Category stored unsuccessful";
$errorDel   = "Category deleted unsuccessful";

if(isset($_GET['alert'])){
   $alert = $_GET['alert'];

    if($alert == 'successS'){
        $success = $successS;
    }
    else if($alert == 'successDel'){
        $success = $successDel;
    } 
    else if($alert == 'errorIC'){
        $error = $errorIC;
    } 
    else if($alert == 'errorDel'){
        $error = $errorDel;
    } 
    else if($alert == 'errorS'){
        $error = $errorS;
    } 
}

// Query for category data

$tableCategory  = "category";

$sql = "SELECT * FROM {$tableCategory}";
$resultCat = $conn->query($sql);

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

// Query for post data

$tablePost      = "post";

$sql = "SELECT * FROM {$tablePost} where id = '{$id}'";

$resultPost = $conn->query($sql);

if($resultPost->num_rows >0){
$post = $resultPost->fetch_assoc();

?>

<div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Create Post</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Update Post</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if($message != ""){ ?>
                                <div class="alert alert-danger text-light h5">
                                        <?php echo $message; ?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-validation">
                                        <form class="form-valide" action="post-update.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" vale="<?php echo $post['id']; ?>">
                                            <input type="hidden" name="filename" vale="<?php echo $post['filename']; ?>">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="post-title">Title <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="post-title" name="post-title" placeholder="Enter a title.." value="<?php echo $post['title']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="post-content">Post Content <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <textarea name="post-content" id="post-content"><?php echo $post['content']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="post-category">Category<span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="post-category" name="post-category">
                                                        <option value="">-- Select --</option>
                                                        <?php while ($category = $resultCat->fetch_assoc()) { ?>
                                                            <option value="<?php echo $category['slug']; ?>"<?php echo ($category['slug'] == $post['category'])?"selected":""  ?>><?php echo $category['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="post-status">Status<span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="post-status" name="post-status">
                                                        <option value="">-- Select --</option>
                                                        <option value="publish" <?php echo ($post['status']=="publish")?"selected":""  ?>>Publish</option>
                                                        <option value="draft" <?php echo ($post['status']=="draft")?"selected":""  ?>>Draft</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="post-image">Post Image<span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="file" name="uploadedFile" id="post-image">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p><?php echo date("Y"); ?> © Blog Admin - <a href="#">example.com</a></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
    <!-- jquery vendor -->
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="js/lib/form-validation/jquery.validate.min.js"></script>
    <script>
        var form_validation = function() {
        var e = function() {
                jQuery(".form-valide").validate({
                    ignore: [],
                    errorClass: "invalid-feedback animated fadeInDown",
                    errorElement: "div",
                    errorPlacement: function(e, a) {
                        jQuery(a).parents(".form-group > div").append(e)
                    },
                    highlight: function(e) {
                        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                    },
                    success: function(e) {
                        jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                    },
                    rules: {
                        "post-title": {
                            required: !0,
                            minlength: 10
                        },
                        "post-content": {
                            required: !0,
                        },
                        "post-category": {
                            required: !0,
                        },
                        "post-status": {
                            required: !0,
                        },
                        "post-image": {
                            required: !0,
                        },
                    },
                    messages: {
                        "post-title": {
                            required: "Please enter a post title",
                            minlength: "Your post title must consist of at least 10 characters"
                        },
                        "post-content": {
                            required: "Please write your blog content here",
                        },
                        "post-category": {
                            required: "Please select a category",
                        },
                        "post-status": {
                            required: "Please select a blog post status",
                        },
                        "post-image": {
                            required: "Please select a image for blog post",
                        },
                    }
                })
            }
        return {
        init: function() {
            e(), a(), jQuery(".js-select2").on("change", function() {
                jQuery(this).valid()
            })
        }
    }
}();
jQuery(function() {
    form_validation.init()
});
    </script>
    
    <!-- bootstrap -->
    <script src="https://cdn.tiny.cloud/1/hbom4kson0fnyjyu21op1vgxzwht5yolpe0nnchomyn17vrw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });
  </script>
</body>

</html>

<?php }