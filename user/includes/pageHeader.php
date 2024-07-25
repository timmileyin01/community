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
                                    }
                                     ?>
                                    </h5>
									<h6 class="sub-heading">Welcome to <?= $settings['title'] ?></h6>
								</div>
							</div>
							<div class="col-md-4 col-sm-6 col-12">
								<div class="right-actions">
									<div class="input-group form-group search-block">
										<input type="text" class="form-control" placeholder="Search for your events..."
											aria-label="Search for..." />
										<span class="input-group-btn">
											<button class="btn btn-primary" type="button">
												Search
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>