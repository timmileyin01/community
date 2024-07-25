<?php
$currentPage = "category";
include "./includes/header.php";





?>

    <!-- BEGIN .app-wrap -->
    <div class="app-wrap">
        <!-- BEGIN .app-container -->
        <div class="app-container">
            <!-- BEGIN .app-side -->
            <?php include "./includes/sidebar.php"; ?>
            <!-- END: .app-side -->
            <!-- BEGIN .app-main -->
            <div class="app-main">
                <!-- top navigation inclusion -->
		<?php include "./includes/topNav.php"; ?>
                <!-- END: .app-heading -->
                <!-- BEGIN .main-heading -->
                <?php include "./includes/pageHeading.php"; ?>
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
                                                Event Categories
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
                                    <h4 class="mt-2 text-primary">All Event Categories</h4>
                                </div>
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-primary m-1 float-lg-right" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-user-plus fa-lg"></i>&nbsp; Add Category</button>
                                </div>
                            </div>
                            <div class="table-responsive" id="showCategory">
                                
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




    <!-- Category Add modal -->
    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Category<h4>
                    <p class="statusMsg"></p>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" autocomplete="off" method="post" id="add-category-form">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control"  placeholder="Name of Category" minlength="3" id="catName" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="description" class="form-control" id="catDescription" placeholder="Some details about the Category"></textarea>
                        </div>
                        <div class="mt-3">
                            <input type="submit" name="addCategoryBtn" class="btn btn-danger btn-block" id="addCategoryBtn" value="Submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Category Edit modal -->
    <div class="modal fade" id="editCategoryModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category<h4>
                    <p class="statusMsg"></p>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" autocomplete="off" method="post" id="edit-category-form">
                        <input type="hidden" name="category_id">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control"  placeholder="Name of Category" minlength="3" id="catName" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="description" class="form-control" id="catDescription" placeholder="Some details about the Category"></textarea>
                        </div>
                        <div class="mt-3">
                            <input type="submit" name="editCategoryBtn" class="btn btn-danger btn-block" id="editCategoryBtn" value="Submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>








    <?php include "./includes/footer.php"; ?>





    <script src="./controllers/categories/categories.js"></script>
</body>

</html>