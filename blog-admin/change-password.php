<?php
include("header.php");

?>

	
<div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Change Password</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Change password</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <?php if(isset($_SESSION['success'])){ ?>
                                    <div>
                                            <div class="alert alert-success text-light h5">
                                                    <?php echo $_SESSION['success']; 
                                                    unset($_SESSION['success']);
                                                    ?>
                                            </div>
                                    </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['error'])){ ?>
                                    <div>
                                            <div class="alert alert-danger text-light h5">
                                                    <?php echo $_SESSION['error']; 
                                                    unset($_SESSION['error']);
                                                    ?>
                                            </div>
                                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-validation">
                                        <form class="form-valide" action="passwordChange.php" method="POST">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="oldpass">Old Password<span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="password" class="form-control" id="oldpass" name="oldpass" placeholder="Enter a Old Password..." autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="newpass">New Password<span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="newpass" name="newpass" placeholder="Enter a new Password..." autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="conpass">Confirm Password<span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="conpass" name="conpass" placeholder="Enter a confirm Password..." autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Change Password</button>
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