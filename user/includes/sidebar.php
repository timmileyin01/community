<aside class="app-side" id="app-side">
				<!-- BEGIN .side-content -->
				<div class="side-content">
					<!-- Logo start -->
					<a href="../" class="logo">
						<img src="../admin/uploads/<?= $settings['logo'] ?>" alt="Admin Dashboard" />
					</a>
					<!-- Logo end -->
					<!-- BEGIN .user-profile -->
					<div class="user-profile">
						<ul class="profile-actions">
							<li>
								<a href="#">
									<i class="icon-social-skype"></i>
									<span class="count-label red"></span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="icon-drafts"></i>
								</a>
							</li>
							<li>
								<a href="login.html">
									<i class="icon-open_in_new"></i>
								</a>
							</li>
						</ul>
					</div>
					<!-- END .user-profile -->
					<!-- BEGIN .side-nav -->
					<nav class="side-nav">
						<!-- BEGIN: side-nav-content -->
						<ul class="unifyMenu" id="unifyMenu">
							<li class="active selected">
								<a href="#" class="has-arrow" style="background-color: #ff4d29" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-laptop_windows"></i>
									</span>
									<span class="nav-title">Dashboards</span>
								</a>
								<ul aria-expanded="false" class="collapse in">
									<li>
										<a href="index.php" class="<?php if($currentPage == "home"){ echo "current-page"; } ?>">Dashboard</a>
									</li>
								</ul>
							</li>

							<li>
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-lock_outline"></i>
									</span>
									<span class="nav-title">Authentication</span>
								</a>
								<ul aria-expanded="false">
									<li>
										<a href="../logout.php">Logout</a>
									</li>
								</ul>
							</li>
						</ul>
						<!-- END: side-nav-content -->
					</nav>
					<!-- END: .side-nav -->
				</div>
				<!-- END: .side-content -->
			</aside>