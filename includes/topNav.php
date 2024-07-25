


    <!-- TOP NAV -->
    <div class="top-nav" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <p> <i class='bx bxs-envelope'></i> event@example.com</p>
                    <p> <i class='bx bxs-phone-call'></i> 2348000000000 </p>
                </div>
                <div class="col-auto social-icons">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-pinterest'></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="./"><?= $settings['title'] ?><span class="dot">.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto justify-content-center align-items-center ">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/community/#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/community/#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#events">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/community/#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/community/#reviews">Reviews</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class='bx bxs-user-circle h1'></i></a>
                        <ul class="dropdown-menu">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                               
                            

                            ?>
                            <div class="container-fluid">
                                <a class="navbar-brand" href="
                                
                                <?php 
                                if ($userResult['user_role'] == 'normal_member') {
                                    echo './user';
                                } elseif ($userResult['user_role'] == 'vendor_member') {
                                    echo './vendor';
                                } elseif ($userResult['user_role'] == 'planner_member') {
                                    echo './planner';
                                } elseif ($userResult['user_role'] == 'admin_member') {
                                    echo './admin';
                                } elseif ($userResult['user_role'] == 'super_admin_member') {
                                    echo './admin';
                                }
                                
                                ?>
                                
                                
                                
                                ">
                                    <img src="./admin/uploads/<?= $userResult['image'] ?>" alt="Avatar Logo" style="width:40px; height:40px;" class="rounded-pill">Dashboard
                                </a>
                            </div>
                            <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                            <?php }else {
                                
                            ?>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#memberModal">SignUp</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-brand ms-lg-3">Contact</a>
            </div>
        </div>
    </nav>





    