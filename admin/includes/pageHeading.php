<div class="main-heading">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-8 col-sm-6 col-12">
							<div class="page-icon">
								<i class="icon-laptop_windows"></i>
							</div>
							<div class="page-title">
								<h5>
                                    <?php
                                    if ($currentPage == "home") {
                                        echo "Dashboard";
                                    }elseif ($currentPage == "category") {
                                        echo "Categories";
                                    }elseif ($currentPage == "event-centers") {
                                        echo "Event Centers";
                                    }elseif ($currentPage == "events") {
                                        echo "Events";
                                    }elseif ($currentPage == "users") {
                                        echo "Users";
                                    }elseif ($currentPage == "services") {
                                        echo "Services";
                                    }elseif ($currentPage == "tickets") {
                                        echo "Tickets";
                                    }
                                     ?>
                                </h5>
								<h6 class="sub-heading">Welcome to <?= $settings['title'] ?></h6>
							</div>
						</div>
					</div>
				</div>
			</div>