<?php
$currentPage = "home";
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
												User Profile
											</li>
										</ol>
									</nav>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-4">
									<div class="card mb-4">
										<div class="card-body text-center">
											<img src="../admin/uploads/<?= $userResult['image'] ?>" alt="avatar" class="rounded-circle"
												style="width: 150px; height:150px;" />
											<h5 class="my-3"><?= $userResult['user_role'] ?></h5>
											<div class="d-flex justify-content-center mb-2">
												<button data-toggle="modal" data-target="#editModal" id="<?= $_SESSION['user_id'] ?>" type="button" data-mdb-button-init data-mdb-ripple-init
													class="btn btn-primary">
													Edit
												</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-8">
									<div class="card mb-4">
										<div class="card-body">
											<div class="row">
												<div class="col-sm-3">
													<p class="mb-0">Username</p>
												</div>
												<div class="col-sm-9">
													<p class="text-muted mb-0"><?= $userResult['username'] ?></p>
												</div>
											</div>
											<hr />
											<div class="row">
												<div class="col-sm-3">
													<p class="mb-0">Full Name</p>
												</div>
												<div class="col-sm-9">
													<p class="text-muted mb-0"><?= $userResult['firstname'] . " " . $userResult['lastname'] ?></p>
												</div>
											</div>
											<hr />
											<div class="row">
												<div class="col-sm-3">
													<p class="mb-0">Email</p>
												</div>
												<div class="col-sm-9">
													<p class="text-muted mb-0"><?= $userResult['email'] ?></p>
												</div>
											</div>
											<hr />
											<div class="row">
												<div class="col-sm-3">
													<p class="mb-0">Phone</p>
												</div>
												<div class="col-sm-9">
													<p class="text-muted mb-0"><?= $userResult['phone'] ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>

					<!-- Row start -->
					<!-- Row end -->
				</div>
				<!-- END: .main-content -->
			</div>
			<!-- END: .app-main -->
		</div>
		<!-- END: .app-container -->
		

		<!-- Member edit modal -->
	<div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Your Details <?= $_SESSION['user_id'] ?><h4>
                    <p class="statusMsg"></p>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" autocomplete="off" method="post" id="edit-user-form">
                    <input type="hidden" name="user_id" id="id" value="<?= $_SESSION['user_id'] ?>">
                    <input type="hidden" name="user_role" id="id" value="<?= $_SESSION['user_role'] ?>">
                        <div class="row col-lg-18 mb-3 mt-3">
                            <div class="col-lg-6">
                                <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?= $userResult['firstname'] ?>" id="firstname" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?= $userResult['lastname'] ?>"  id="lastname" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control"  placeholder="Username" value="<?= $userResult['username'] ?>" minlength="6" id="username" required>
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
                            <input type="email" name="email" class="form-control" placeholder="E-mail" value="<?= $userResult['email'] ?>"  id="email" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" value="<?= $userResult['phone'] ?>"  id="phone" required>
                        </div>
                        <div class="prevImg mb-3">
                        <span class="col-12">Leave empty if you do not wish to change your Imgae</span>
                            <label class="form-label col-12">Upload Image</label>
                            <div class="col-lg-2">
                                <img class="preview_img" src="../admin/uploads/<?= $userResult['image'] ?>">
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

		<script src="../admin/controllers/users/users.js"></script>
</body>

</html>