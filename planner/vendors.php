<?php  
$currentPage = "vendors";
include "./includes/header.php";
?>
			
			<!-- .app-side -->
			 <?php include "./includes/aside.php"; ?>
			 <!-- END: .app-side -->
			 <!-- BEGIN .app-main -->
			 <div class="app-main">
				 <!-- BEGIN .app-heading -->
				 <?php include "./includes/topNav.php"; ?>
				 
				 <!-- END: .app-heading -->
				 <!-- BEGIN .main-heading -->
				 
				 <?php include "./includes/mainHeading.php"; ?>
				<!-- END: .main-heading -->
                <!-- BEGIN .main-content -->
                <div class="main-content">
                    <section style="background-color: #eee">
                        <div class="container py-lg-5 py-sm-2">
                            <div class="row">
                                <div class="col">
                                    <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">User</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                Vendors
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="mt-2 text-primary">All Available Vendors</h4>
                                </div>
                            </div>
                            <div class="table-responsive" id="showVendor">
                            <h3 class="text-center text-success" style="margin-top: 150px;">Loading...</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->
            </div>
            <!-- END: .main-content -->
        </div>
        <!-- END: .app-main -->
    </div>
    <!-- END: .app-container -->







    <!-- BEGIN .main-footer -->
    <?php include "./includes/footer.php"; ?>

		<script src="../admin/controllers/vendors/vendors.js"></script>
</body>

</html>