<?php
$currentPage = "users";

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
                                                Users
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
                                    <h4 class="mt-2 text-primary">All Users</h4>
                                </div>
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-primary m-1 float-lg-right" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-user-plus fa-lg"></i>&nbsp; Add User</button>
                                </div>
                            </div>
                            <div class="table-responsive" id="showUser">
                                
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
    <div class="modal fade" id="addUserModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New User<h4>
                    <p class="statusMsg"></p>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" autocomplete="off" method="post" id="add-user-form">
                        <div class="row col-lg-18 mb-3 mt-3">
                            <div class="col-lg-6">
                                <input type="text" name="firstname" class="form-control" placeholder="First Name"  id="firstname" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name"  id="lastname" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control"  placeholder="Username" minlength="6" id="username" required>
                            <span style="color:red;" id="displayUsernameError"></span>
                        </div>
                        <div class="row col-lg-18 mb-3 mt-3">
                            <div class="col-lg-6">
                                <input type="password" name="password" class="form-control" placeholder="Password" minlength="6"  id="password" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm password" minlength="6" id="confirmpassword" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="E-mail"  id="email" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number"  id="phone" required>
                        </div>
                        <div class="mb-3">
                            <select name="user_role" class="form-control" id="" required>
                                <option value="">Click to Select User Role</option>
                                <option value="normal_member">Attendee</option>
                                <option value="vendor_member">Vendor</option>
                                <option value="planner_member">Event Planner</option>
                                <option value="admin_member">Staff</option>
                                <option value="super_admin_member">Admin</option>
                            </select>
                        </div>
                        <div class="prevImg mb-3">
                            <label class="form-label">Upload Image</label>
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
                            <input type="submit" name="addUserBtn" class="btn btn-danger btn-block" id="addUserBtn" value="Submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Member edit modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit User<h4>
                    <p class="statusMsg"></p>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" autocomplete="off" method="post" id="edit-user-form">
                    <input type="hidden" name="user_id" id="id">
                        <div class="row col-lg-18 mb-3 mt-3">
                            <div class="col-lg-6">
                                <input type="text" name="firstname" class="form-control" placeholder="First Name"  id="firstname" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name"  id="lastname" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control"  placeholder="Username" minlength="6" id="username" required>
                            <span style="color:red;" id="displayUsernameError"></span>
                        </div>
                        <div class="row col-lg-18 mb-3 mt-3">
                            <span class="col-12">Leave empty if you do not wish to change your password</span>
                            <div class="col-lg-6">
                                <input type="password" name="password" class="form-control" placeholder="Password" minlength="6"  id="password">
                            </div>
                            <div class="col-lg-6">
                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm password" minlength="6" id="confirmpassword">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="E-mail"  id="email" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number"  id="phone" required>
                        </div>
                        <div class="mb-3">
                            <select name="user_role" class="form-control" id="" required>
                                <option value="">Click to Select User Role</option>
                                <option value="normal_member">Attendee</option>
                                <option value="vendor_member">Vendor</option>
                                <option value="planner_member">Event Planner</option>
                                <option value="admin_member">Staff</option>
                                <option value="super_admin_member">Admin</option>
                            </select>
                        </div>
                        <div class="prevImg mb-3">
                        <span class="col-12">Leave empty if you do not wish to change your Imgae</span>
                            <label class="form-label col-12">Upload Image</label>
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
                            <input type="submit" name="EditUserBtn" class="btn btn-danger btn-block" id="EditUserBtn" value="Submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>






    <?php include "./includes/footer.php"; ?>




    <script src="./controllers/users/users.js"></script>
</body>

</html>