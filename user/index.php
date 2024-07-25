<?php
$currentPage = 'home';
include './includes/header.php';
?>
<!-- BEGIN .app-side -->
<?php include './includes/sidebar.php'; ?>
<!-- END: .app-side -->
<!-- BEGIN .app-main -->
<div class="app-main">
	<!-- BEGIN .app-heading -->
	<?php include './includes/topNav.php'; ?>
	<!-- END: .app-heading -->
	<!-- BEGIN .main-heading -->
	<?php include './includes/pageHeader.php' ?>
	<!-- END: .main-heading -->
	<!-- BEGIN .main-content -->
	<div class="main-content">
		<section style="background-color: #eee">
			<div class="container py-5">
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
								<img src="../admin/uploads/<?= $userResult['image'] ?>" alt="avatar" class="rounded-circle" style="width: 150px; height:150px;" />
								<h5 class="my-3"><?= $userResult['user_role'] ?></h5>
								<div class="d-flex justify-content-center mb-2">
									<button data-toggle="modal" data-target="#editModal" id="<?= $_SESSION['user_id'] ?>" type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">
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

		<div class="row gutters">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">My Tickets</div>
					<div class="card-body">
						<div class="row gutters">
							<?php
							$ticketQuery = "SELECT * FROM rsvp WHERE email = ? ORDER BY rsvp_id DESC";
							$tickets = $conn->prepare($ticketQuery);
							$tickets->bind_param("s", $userResult['email']);
							$tickets->execute();
							$results1 = $tickets->get_result()->fetch_all(MYSQLI_ASSOC);

							foreach ($results1 as $key => $row) {
								$eventQuery = "SELECT * FROM events WHERE event_id = ?";
								$stmt10 = $conn->prepare($eventQuery);
								$stmt10->bind_param("i", $row['event_id']);
								$stmt10->execute();
								$row1 = $stmt10->get_result()->fetch_assoc();

							?>

								<div class="col-md-4 col-sm-12 my-sm-2">
									<a href="../single-event.php?event_id=<?= $row1['event_id'] ?>" class="blog-sm">
										<img width="300px" height="250px" src="../admin/uploads/<?= $row1['flyer'] ?>" class="img-fluid blog-thumb" alt="Google Dashboards" />
										<h6 class="blog-title"><?= $row1['title'] ?></h6>
										<p class="blog-content">
											Email : <?= $row['email']; ?>
										</p>
										<h6>Date : <span class="text-danger"><?= $row1['date'] ?></span></h6>
										<h6>Time : <span class="text-danger"><?= $row1['time'] ?></span></h6>
										<h6>Your Ticket ID : <span class="text-danger"><?= $row['ticket_id'] ?></span></h6>
										<h6>Ticket Price : <span class="text-danger"><?= $row['ticket_price'] ?></span></h6>
									</a>
								</div>
							<?php } ?>

						</div>
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

<?php include './includes/footer.php'; ?>
</body>

</html>