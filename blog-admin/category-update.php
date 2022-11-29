<?php 
include("header.php");

include("db.php");

$table = "category";

$alert = "";

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

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$sql = "SELECT * FROM {$table} where id = '{$id}'";

$result = $conn->query($sql);

if($result->num_rows >0){
$row = $result->fetch_assoc();

?>
	
	<div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Update Category <span class="text-primary"><?php echo $row['name']; ?></span> </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Update Category</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">

                        <?php if($alert == 'successS' || $alert == 'successDel'){ ?>
                        <div class="col-lg-12">
                                <div class="alert alert-success text-light h5">
                                        <?php echo $success; ?>
                                </div>
                        </div>
                        <?php } ?>

                        <?php if($alert == 'errorIC' || $alert == 'errorS' || $alert == 'errorDel'){ ?>
                        <div class="col-lg-12">
                                <div class="alert alert-danger text-light h5">
                                        <?php echo $error; ?>
                                </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-validation">
                                        <form class="form-valide" action="categoryUpdateStore.php" method="POST">
                                            <div class="form-group row">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <label class="col-lg-4 col-form-label" for="name">Category <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter a category..." autocomplete="off" value="<?php echo $row['name']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="reset" class="btn btn-warning">Reset</button>
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
                                <p>2018 © Admin Board. - <a href="#">example.com</a></p>
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
    
    <!-- bootstrap -->
    <!-- Select2 -->
    <script src="js/lib/select2/select2.full.min.js"></script>
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
                        "name": {
                            required: !0,
                            minlength: 3
                        },
                    },
                    messages: {
                        "name": {
                            required: "Please enter a category",
                            minlength: "Your category must consist of at least 3 characters"
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
    <script src="js/lib/bootstrap.min.js"></script><script src="js/scripts.js"></script>
    <!-- scripit init-->
</body>

</html>

<?php }