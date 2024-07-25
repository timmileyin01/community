<header class="app-header">
	<div class="container-fluid">
		<div class="row gutters">
			<div class="col-md-4 col-sm-3 col-4">
				<a class="mini-nav-btn" href="#" id="onoffcanvas-nav">
					<i class="icon-sort"></i>
				</a>
				<a href="#app-side" data-toggle="onoffcanvas" class="onoffcanvas-toggler" aria-expanded="true">
					<i class="icon-chevron-thin-left"></i>
				</a>
			</div>
			<div class="col-md-8 col-sm-9 col-8">
				<ul class="header-actions">
					<li class="dropdown">
						<a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
							<i class="icon-notifications_none"></i>
							<span class="count-label"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right lg" aria-labelledby="notifications">
							<ul class="imp-notify">
								<?php $receiver_id = $_SESSION['user_id'];
								$messageView = "SELECT * FROM messages WHERE receiver_id = $receiver_id";
								$stmt18 = $conn->prepare($messageView);
								$stmt18->execute();
								$data1 = $stmt18->get_result()->fetch_all(MYSQLI_ASSOC);
								foreach ($data1 as $key => $row1) :
									$sender_id = $row1['sender_id'];
									$usersView = "SELECT * FROM users WHERE user_id = $sender_id";
									$stmt19 = $conn->prepare($usersView);
									$stmt19->execute();
									$data2 = $stmt19->get_result()->fetch_assoc();
								?>
									<li>
										<div class="icon"><?php echo substr($data2['username'], 0, 1); ?></div>
										<div class="details">
											<b><?= 'From : ' . $data2['username'] ?></b>
											<p>
												<?= $row1['message'] ?>
											</p>
										</div>
									</li>

								<?php endforeach; ?>


							</ul>
						</div>
					</li>

					<li class="dropdown">
						<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
							<img class="rounded-circle" width="40px" height="40px" src="../admin/uploads/<?= $userResult['image'] ?>" alt="Admin Dashboards" />
							<span class="user-name"><?= $userResult['username'] ?></span>
							<i class="icon-chevron-small-down"></i>
						</a>
						<div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
							<div class="logout-btn">
								<a href="../logout.php" class="btn btn-primary">Logout</a>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</header>