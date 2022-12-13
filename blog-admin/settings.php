<?php
session_start();
include("header.php");
?>

<div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Settings</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Settings</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                    <?php if(isset($_SESSION['success'])){ ?>
                        <div class="col-lg-12">
                                <div class="alert alert-success text-light h5">
                                    <?php echo $_SESSION['success']; 
                                    session_destroy();
                                    ?>
                                </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-6">
									<div class="card">
										<div class="card-body">
											<!-- Nav tabs -->
											<div class="vtabs ">
												<ul class="nav nav-tabs tabs-vertical" role="tablist">
													<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home9" role="tab"><span><i class="ti-home"></i></span> Home</a> </li>
													<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile9" role="tab"><span><i class="ti-user"></i></span> Social Media</a> </li>
													<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages9" role="tab"><span><i class="ti-email"></i></span> Home Page</a> </li>
												</ul>
												<!-- Tab panes -->
                                                <form action="settings-store.php" method="POST" enctype="multipart/form-data">
												<div class="tab-content">
                                                        <div class="tab-pane active" id="home9" role="tabpanel">
                                                            <div class="p-20">
                                                                <label for="title">Blog Name</label>
                                                                <input id="title" type="text" name="name" value="<?php echo getSValue('name'); ?>">
                                                                <label for="description">Blog Description</label>
                                                                <input id="description" type="text" name="description" value="<?php echo getSValue('description'); ?>">
                                                                <label for="logo">Blog Logo</label>
                                                                <input id="logo" type="file" name="uploadedFile">
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane  p-20" id="profile9" role="tabpanel">
                                                            <div class="p-20">
                                                                <label for="facebook">Facebook Link</label>
                                                                <input id="facebook" type="text" name="facebook" value="<?php echo getSValue('facebook'); ?>">
                                                                <label for="twitter">Twitter Link</label>
                                                                <input id="twitter" type="text" name="twitter" value="<?php echo getSValue('twitter'); ?>">
                                                                <label for="github">Github Link</label>
                                                                <input id="github" type="text" name="github" value="<?php echo getSValue('github'); ?>">
                                                                <label for="youtube">Youtube Link</label>
                                                                <input id="youtube" type="text" name="youtube" value="<?php echo getSValue('youtube'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane p-20" id="messages9" role="tabpanel">
                                                                <div class="p-20">
                                                                    <label for="homeheader">Home Page Header</label>
                                                                    <input id="homeheader" type="text" name="homeheader" value="<?php echo getSValue('homeheader'); ?>">
                                                                    <label for="blogowner">Blog Owner</label>
                                                                    <input id="blogowner" type="text" name="blogowner" value="<?php echo getSValue('blogowner'); ?>">
                                                                    <label for="bio">Blog Owner BIO</label>
                                                                    <input id="bio" type="text" name="bio" value="<?php echo getSValue('bio'); ?>">
                                                                    
                                                                </div>
                                                        </div>
                                                        
												</div>
                                                <button class="ml-3 btn btn-success" type="submit" name="save" value="save">Save</button>
                                                    </form>
											</div>
										</div>
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


    <script src="js/lib/bootstrap.min.js"></script><script src="js/scripts.js"></script>
    <!-- scripit init-->





</body>

</html>