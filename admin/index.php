<?php
$currentPage = "home";
include "./includes/header.php";





?>

<!-- BEGIN .app-wrap -->
<div class="app-wrap">
	<!-- BEGIN .app-container -->
	<div class="app-container">
		<!-- sidebar inclusion-->
		<?php include "./includes/sidebar.php"; ?>
		<!-- sidebar inclusion-->

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
											User Profile
										</li>
									</ol>
								</nav>
							</div>
						</div>

						<div class="row gutters">
							<div class="col-md-3 col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="stats-widget">
											<div class="stats-widget-header">
												<i class="icon-user"></i>
											</div>
											<div class="stats-widget-body">
												<!-- Row start -->
												<ul class="row no-gutters">
													<li class="col-sm-6 col">
														<h6 class="title">Users</h6>
													</li>
													<li class="col-sm-6 col">
														<h4 class="total"><?= $nr2_of_rows ?></h4>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="stats-widget">
											<div class="stats-widget-header">
												<i class="icon-map"></i>
											</div>
											<div class="stats-widget-body">
												<!-- Row start -->
												<ul class="row no-gutters">
													<li class="col-sm-6 col">
														<h6 class="title">Events</h6>
													</li>
													<li class="col-sm-6 col">
														<h4 class="total"><?= $nr1_of_rows ?></h4>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="stats-widget">
											<div class="stats-widget-header">
												<i class="icon-document"></i>
											</div>
											<div class="stats-widget-body">
												<!-- Row start -->
												<ul class="row no-gutters">
													<li class="col-sm-6 col">
														<h6 class="title">Tickets</h6>
													</li>
													<li class="col-sm-6 col">
														<h4 class="total"><?= $nr4_of_rows ?></h4>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="stats-widget">
											<div class="stats-widget-header">
												<i class="icon-briefcase4"></i>
											</div>
											<div class="stats-widget-body">
												<!-- Row start -->
												<ul class="row no-gutters">
													<li class="col-sm-6 col">
														<h6 class="title">Services</h6>
													</li>
													<li class="col-sm-6 col">
														<h4 class="total"><?= $nr3_of_rows ?></h4>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-6">
										<h4 class="mt-2 text-primary">Earnings of Event Planners</h4>
									</div>
								</div>
								<div class="table-responsive" id="showEarnings">
								<h3 class="text-center text-success" style="margin-top: 150px;">Loading...</h3>
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




	<!-- Edit modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Account Balance<h4>
                        <p class="statusMsg"></p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" autocomplete="off" method="post" id="edit-account-form">
                    <input type="hidden" name="account_id">
                    <div class="mb-3">
                        <input type="number" name="balance" class="form-control" placeholder="Account Balance" id="balance" required>
                    </div>
                    <div class="mt-3">
                        <input type="submit" name="editAccountBtn" class="btn btn-danger btn-block" id="editAccountBtn" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
	
	<?php include "./includes/footer.php" ?>


	<script src="./controllers/earning/earning.js"></script>
</body>

</html>