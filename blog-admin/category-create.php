<?php 
include("header.php");

include("db.php");

$table = "category";

$alert = "";

$successS   = "Category stored successfully";
$successU   = "Category updated successfully";
$successDel = "Category deleted successfully";
$errorIC    = "Name contain letters only";
$errorS     = "Category stored unsuccessful";
$errorDel   = "Category deleted unsuccessful";

if(isset($_GET['alert'])){
    $alert = $_GET['alert'];

    if($alert == 'successS'){
        $success = $successS;
    }
    else if($alert == 'successU'){
        $success = $successU;
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
                                <h1>Category</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Category</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">

                        <?php if($alert == 'successS' || $alert == 'successDel' || $alert == 'successU'){ ?>
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

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category Name</th>
                                                    <th>Slug</th>
                                                    <th>Create time</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($data = $result->fetch_assoc()){ ?>
                                                <tr>
                                                    <th scope="row"><?php echo $data['id']; ?></th>
                                                    <td><?php echo $data['name']; ?></td>
                                                    <td><?php echo $data['slug']; ?></td>
                                                    <td><?php echo $data['createtime']; ?></td>
                                                    <td>
                                                        <a class="btn btn-success" href="category-update.php?id=<?php echo $data['id']; ?>">Edit</a>
                                                        <a class="btn btn-danger" href="category-delete.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Are you sure to delete this category?')">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-validation">
                                        <form class="form-valide" action="categoryStore.php" method="POST">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="name">Category <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter a category..." autocomplete="off">
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