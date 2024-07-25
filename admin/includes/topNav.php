<!-- BEGIN .app-heading -->
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
							<img class="rounded-circle" width="40px" height="40px" src="./uploads/<?= $userResult['image'] ?>" alt="Admin Dashboards" />
							<span class="user-name"><?= $userResult['username'] ?></span>
							<i class="icon-chevron-small-down"></i>
						</a>
						<div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
							<ul class="user-settings-list">
								<li>
									<a href="#" class="updateSetBtn" data-toggle="modal" data-target="#settingsModal">
										<div class="icon red">
											<i class="icon-cog3"></i>
										</div>
										<p>Settings</p>
									</a>
								</li>
							</ul>
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
<!-- END: .app-heading -->





<!-- Member signup modal -->
<div class="modal fade" id="settingsModal">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Website Settings</h4>
				<p class="statusMsg"></p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body px-4">
				<form action="" autocomplete="off" method="post" id="form-setting-data">
					<div class="mb-3">
						<input type="text" name="title" class="form-control" placeholder="Website Title" minlength="5" id="title" required>
						<span style="color:red;" id="displayUsernameError"></span>
					</div>
					<div class="mb-3">
						<input type="text" name="about" class="form-control" placeholder="About Website" minlength="5" id="about" required>
						<span style="color:red;" id="displayUsernameError"></span>
					</div>
					<div class="prevImg mb-3">
						<label class="form-label">Upload Logo</label>
						<div class="col-lg-2">
							<img class="preview_img" src="./uploads/<?= $settings['logo'] ?>">
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
						<input type="submit" name="settingBtn" class="btn btn-danger btn-block" id="settingBtn" value="Submit">
					</div>
				</form>
			</div>

		</div>
	</div>
</div>


<!-- Member signup modal -->
<div class="modal fade" id="messageModal">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Send Message</h4>
				<p class="statusMsg"></p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body px-4">
				<form action="" autocomplete="off" method="post" id="form-message-data">
				<div class="form-group">
                        <select name="user_id" class="form-control" id="" required>
                            <option value="">Select User...</option>
                            <?php $usersView1 = "SELECT * FROM users";
                            $stmt18 = $conn->prepare($usersView1);
                            $stmt18->execute();
                            $data1 = $stmt18->get_result()->fetch_all(MYSQLI_ASSOC);
                            foreach ($data1 as $key => $row1) :
								if ($row1['user_id'] != $id) {
									# code...
								
                            ?>
                                <option value="<?= $row1['user_id']; ?>"><?= $row1['username']; ?></option>

                            <?php } endforeach; ?>
                        </select>
                    </div>
					<div class="mb-3">
						<div class="form-group">
						  <label for=""></label>
						  <textarea class="form-control" name="message" id="" rows="3" placeholder="Your Message..." required></textarea>
						</div>
					</div>
				
					<div class="mt-3">
						<input type="submit" name="messageBtn" class="btn btn-danger btn-block" id="messageBtn" value="Submit">
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<!-- Member signup modal -->
<div class="modal fade" id="reminderModal">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Send Message</h4>
				<p class="statusMsg"></p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body px-4">
				<form action="" autocomplete="off" method="post" id="form-reminder-data">
					<input type="hidden" name="event_id">
				<div class="form-group">
                    </div>
					<div class="mb-3">
						<div class="form-group">
						  <label for=""></label>
						  <textarea class="form-control" name="message" id="" rows="3" placeholder="Your Message..." required></textarea>
						</div>
					</div>
				
					<div class="mt-3">
						<input type="submit" name="reminderBtn" class="btn btn-danger btn-block" id="reminderBtn" value="Submit">
					</div>
				</form>
			</div>

		</div>
	</div>
</div>