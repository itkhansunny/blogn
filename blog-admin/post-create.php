<?php include("header.php");

include("db.php");

$table = "category";

$success = $error = "";

$eTitle     = "Please enter a title";
$eContent   = "Please write blog content";
$eCategory  = "Please select a category";
$eStatus    = "Please select status";
$uFail      = "Image upload fail";
$invFormat  = "ERROR: File type and File size is not valid";


if(isset($_GET['alert'])){
    $alert = $_GET['alert'];

    if($alert == 'eTitle'){
        $error = $eTitle;
    }else
    if($alert == 'eContent'){
        $error = $eContent;
    }else
    if($alert == 'eCategory'){
        $error = $eCategory;
    }else
    if($alert == 'eStatus'){
        $error = $eStatus;
    }else
    if($alert == 'uFail'){
        $error = $uFail;
    }else
    if($alert == 'invFormat'){
        $error = $invFormat;
    }
}


$sql = "SELECT * FROM {$table}";
$result = $conn->query($sql);



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
                                    <li class="breadcrumb-item active">Create Post</li>
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
                            <?php if($error != ""){ ?>
                                <div class="alert alert-danger text-light h5">
                                        <?php echo $error; ?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-validation">
                                        <form class="form-valide" action="post-store.php" method="POST" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="post-title">Title <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="post-title" name="post-title" placeholder="Enter a title..">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="post-content">Post Content <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <textarea name="post-content" id="post-content"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="post-category">Category<span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="post-category" name="post-category">
                                                        <option value="">-- Select --</option>
                                                        <?php while ($category = $result->fetch_assoc()) { ?>
                                                            <option value="<?php echo $category['slug']; ?>"><?php echo $category['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="post-status">Status<span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="post-status" name="post-status">
                                                        <option value="">-- Select --</option>
                                                        <option value="publish">Publish</option>
                                                        <option value="draft">Draft</option>
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