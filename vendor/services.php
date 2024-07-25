<?php
$currentPage = "services";
include "./includes/header.php";
?>
<!-- BEGIN .app-side -->
<?php include "./includes/sidebar.php"; ?>
<!-- END: .app-side -->
<!-- BEGIN .app-main -->
<div class="app-main">
    <!-- BEGIN .app-heading -->
    <?php include "./includes/topNav.php"; ?>
    <!-- END: .app-heading -->
    <!-- BEGIN .main-heading -->
    <?php include "./includes/pageHeader.php"; ?>
    <!-- END: .main-heading -->
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
                                    Services
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
                        <h4 class="mt-2 text-primary">YOUR SERVICES</h4>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-primary m-1 float-lg-right" data-toggle="modal" data-target="#addServiceModal"><i class="fas fa-user-plus fa-lg"></i>&nbsp; Add Service</button>
                    </div>
                </div>
                <div class="table-responsive" id="showService">
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



<!-- Member Add modal -->
<div class="modal fade" id="addServiceModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Service<h4>
                        <p class="statusMsg"></p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" autocomplete="off" method="post" id="add-service-form">

                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="description" placeholder="Description" id="description" rows="3" required></textarea>

                    </div>
                    <div class="mb-3">
                        <input type="number" name="charge" class="form-control" placeholder="Charge Per Event" id="charge" required>
                    </div>
                    <div class="mt-3">
                        <input type="submit" name="addServiceBtn" class="btn btn-danger btn-block" id="addServiceBtn" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Service<h4>
                        <p class="statusMsg"></p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" autocomplete="off" method="post" id="edit-service-form">
<input type="hidden" name="service_id">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="description" placeholder="Description" id="description" rows="3" required></textarea>

                    </div>
                    <div class="mb-3">
                        <input type="number" name="charge" class="form-control" placeholder="Charge Per Event" id="charge" required>
                    </div>
                    <div class="mt-3">
                        <input type="submit" name="editServiceBtn" class="btn btn-danger btn-block" id="editServiceBtn" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Edit modal -->








<?php include "./includes/footer.php"; ?>


<script src="./controllers/services/services.js"></script>
</body>

</html>