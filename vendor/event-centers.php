<?php
$currentPage = "event-centers";
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
                                    Event Centers
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
                        <h4 class="mt-2 text-primary">YOUR EVENT CENTERS</h4>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-primary m-1 float-lg-right" data-toggle="modal" data-target="#addCenterModal"><i class="fas fa-user-plus fa-lg"></i>&nbsp; Add Center</button>
                    </div>
                </div>
                <div class="table-responsive" id="showCenter">
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
<div class="modal fade" id="addCenterModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Event Center<h4>
                        <p class="statusMsg"></p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" autocomplete="off" method="post" id="add-center-form">

                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="description" placeholder="Description" id="description" rows="3" required></textarea>

                    </div>
                    <div class="mb-3">
                        <input type="text" name="address" class="form-control" placeholder="Address of Event Center" id="address" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="capacity" class="form-control" placeholder="Capacity of Event Center" id="capacity" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="charge" class="form-control" placeholder="Charge Per Event" id="charge" required>
                    </div>
                    <div class="prevImg mb-3">
                        <label class="form-label">Upload an Image of the Center</label>
                        <div class="col-lg-2">
                            <img class="preview_img" src="img/default_profile.jpg">
                        </div>
                        <div class="col-lg-10">
                            <div class="file-upload text-secondary">
                                <input type="file" class="image" name="image" id="image" accept="image/*">
                                <span class="fs-4 fw-2">Choose file...</span>
                                <span>or drag and drop file here</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <input type="submit" name="addCenterBtn" class="btn btn-danger btn-block" id="addCenterBtn" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Edit modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Event Center<h4>
                        <p class="statusMsg"></p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" autocomplete="off" method="post" id="edit-center-form">
                    <input type="hidden" name="center_id">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="description" placeholder="Description" id="description" rows="3" required></textarea>

                    </div>
                    <div class="mb-3">
                        <input type="text" name="address" class="form-control" placeholder="Address of Event Center" id="address" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="capacity" class="form-control" placeholder="Capacity of Event Center" id="capacity" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="charge" class="form-control" placeholder="Charge Per Event" id="charge" required>
                    </div>
                    <div class="prevImg mb-3">
                        <label class="form-label">Upload an Image of the Center</label>
                        <div class="col-lg-2">
                            <img class="preview_img" src="img/default_profile.jpg">
                        </div>
                        <div class="col-lg-10">
                            <div class="file-upload text-secondary">
                                <input type="file" class="image" name="image" id="image" accept="image/*">
                                <span class="fs-4 fw-2">Choose file...</span>
                                <span>or drag and drop file here</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <input type="submit" name="editCenterBtn" class="btn btn-danger btn-block" id="editCenterBtn" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>







<?php include "./includes/footer.php"; ?>


<script src="../admin/controllers/eventCenters/eventCenters.js"></script>
</body>

</html>