<?php

include "./includes/header.php";
include "./includes/topNav.php";

$status = 'Upcoming';
$eventQuery = "SELECT * FROM events WHERE status = ? LIMIT 6";
$events = $conn->prepare($eventQuery);
$events->bind_param("s", $status);
$events->execute();
$results = $events->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!-- SLIDER -->
<div class="owl-carousel owl-theme hero-slider">
    <div class="slide slide1">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center text-white">
                    <h6 class="text-white text-uppercase">Explore Upcoming Events</h6>
                    <h1 class="display-3 my-4">Connect with like-minded<br />individuals</h1>
                    <a href="#events" class="btn btn-brand">Get Started</a>
                </div>
            </div>
        </div>
    </div>
    <div class="slide slide2">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1 text-white">
                    <h6 class="text-white text-uppercase">Available tools to cater for your event needs</h6>
                    <h1 class="display-3 my-4">Fostering vibrant, engaging and memorable<br />Experiences</h1>
                    <a href="#events" class="btn btn-brand">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="bg-light" id="about">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h6>What we offer</h6>
                    <h1>We offer wide range of services</h1>
                    <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                        roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p>
                </div>
            </div>
        </div>
    </div>
    <div id="projects-slider" class="owl-theme owl-carousel">
        <div class="project">
            <div class="overlay"></div>
            <img src="img/project1.jpg" alt="">
            <div class="content">
                <h2>Event Creation and Management</h2>
                <h6>Event Event</h6>
            </div>
        </div>
        <div class="project">
            <div class="overlay"></div>
            <img src="img/project2.jpg" alt="">
            <div class="content">
                <h2>Ticketing and Registration</h2>
                <h6>Event Event</h6>
            </div>
        </div>
        <div class="project">
            <div class="overlay"></div>
            <img src="img/project3.jpg" alt="">
            <div class="content">
                <h2>Resource Management</h2>
                <h6>Event Event</h6>
            </div>
        </div>
        <div class="project">
            <div class="overlay"></div>
            <img src="img/project4.jpg" alt="">
            <div class="content">
                <h2>Collaboration Tools</h2>
                <h6>Event Event</h6>
            </div>
        </div>
        <div class="project">
            <div class="overlay"></div>
            <img src="img/project5.jpg" alt="">
            <div class="content">
                <h2>Promotion and Marketing</h2>
                <h6>Event Event</h6>
            </div>
        </div>
    </div>
</section>

<!-- MILESTONE -->
<section id="milestone">
    <div class="container">
        <div class="row text-center justify-content-center gy-4">
            <div class="col-lg-2 col-sm-6">
                <h1 class="display-4">90K+</h1>
                <p class="mb-0">Happy Clients</p>
            </div>
            <div class="col-lg-2 col-sm-6">
                <h1 class="display-4">20+</h1>
                <p class="mb-0">Available Vendors</p>
            </div>
            <div class="col-lg-2 col-sm-6">
                <h1 class="display-4">10+</h1>
                <p class="mb-0">Events Organized</p>
            </div>
            <div class="col-lg-2 col-sm-6">
                <h1 class="display-4">99%</h1>
                <p class="mb-0">Success Rate</p>
            </div>
        </div>
    </div>
</section>

<section id="events">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h6>Events</h6>
                    <h1>Latest Events</h1>
                    <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                        roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($results as $key => $row) : ?>
                <div class="col-md-4 my-2">
                    <article class="blog-post">
                    <img width="auto" height="250px" src="./admin/uploads/<?= $row['flyer']; ?>" alt="">
                    <?php
                    $categoryQuery = "SELECT * FROM categories WHERE category_id = ?";
                    $stmt13 = $conn->prepare($categoryQuery);
                    $stmt13->bind_param("i", $row['category_id']);
                    $stmt13->execute();
                    $row1 = $stmt13->get_result()->fetch_assoc();

                    ?>
                    <a href="#" class="tag"><?= $row1['name'] ?></a>
                    <a href="#" class="tag1"><?= $row['status'] ?></a>
                    <div class="content">

                        <h5><a href="./single-event.php?event_id=<?= $row['event_id'] ?>"><?= $row['title'] ?></a></h5>
                        <p style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis;"><span class="text-dark fw-bolder"> Description : </span><?= $row['description'] ?></p>
                        <div class="col-lg-12">
                            <div class="col-lg-12 m-2">
                                <small>DATE : <?= $row['date'] ?></small>
                            </div>
                            <div class="col-lg-12 m-2">
                                <small>TIME : <?= $row['time'] ?></small>
                            </div>
                        </div>
                        <?php
                        $centerQuery = "SELECT * FROM event_center WHERE center_id = ?";
                        $stmt11 = $conn->prepare($centerQuery);
                        $stmt11->bind_param("i", $row['center_id']);
                        $stmt11->execute();
                        $row2 = $stmt11->get_result()->fetch_assoc();

                        ?>
                        <h5>Location : </h5><span><?= $row2['name'] ?></span>
                        <h5>Address : </h5><span><?= $row2['address'] ?></span>
                        <div class="row col-lg-12">
                            <div class="col-lg-12 my-2">
                            <div class="col-lg-12 my-2">
                                <h6> Capacity : <span class="text-danger"><?= $row2['capacity'] ?></span></h6>
                            </div>
                                <?php
                                $priceQuery = "SELECT * FROM prices WHERE event_id = ?";
                                $stmt15 = $conn->prepare($priceQuery);
                                $stmt15->bind_param("i", $row['event_id']);
                                $stmt15->execute();
                                $row5 = $stmt15->get_result()->fetch_assoc();
                                if ($row5) :

                                ?>
                                <div class="price col-lg-12 border px-2">
                                    <h6> Ticket Price : </h6><span class="text-danger fw-bolder"><?= '<br>' . 'Regular = ' . $row5['regular'] . '<br>' . 'VIP = ' . $row5['vip']. '<br>' . 'VVIP = ' . $row5['vvip'] ?></span>

                                </div>
                                <?php else : ?>
                                    <h6> Ticket Price : <span class="text-danger">Free</span></h6>
                                <?php endif; ?>
                            </div>
                           
                        </div>
                    </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-12 mt-3">
            <a href="./events.php" class="btn btn-success m-1 float-lg-right">Show all Events</a>
        </div>
    </div>
</section>



<section id="team">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h6>Team</h6>
                    <h1>Team Members</h1>
                    <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                        roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8">
                <div class="team-member">
                    <div class="image">
                        <img src="img/team_1.jpg" alt="">
                        <div class="social-icons">
                            <a href="#"><i class='bx bxl-facebook'></i></a>
                            <a href="#"><i class='bx bxl-twitter'></i></a>
                            <a href="#"><i class='bx bxl-instagram'></i></a>
                            <a href="#"><i class='bx bxl-pinterest'></i></a>
                        </div>
                        <div class="overlay"></div>
                    </div>

                    <h5>Marvin McKinney</h5>
                    <p>Marketing Coordinator</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <div class="team-member">
                    <div class="image">
                        <img src="img/team_2.jpg" alt="">
                        <div class="social-icons">
                            <a href="#"><i class='bx bxl-facebook'></i></a>
                            <a href="#"><i class='bx bxl-twitter'></i></a>
                            <a href="#"><i class='bx bxl-instagram'></i></a>
                            <a href="#"><i class='bx bxl-pinterest'></i></a>
                        </div>
                        <div class="overlay"></div>
                    </div>

                    <h5>Kathryn Murphy</h5>
                    <p>Moderator</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <div class="team-member">
                    <div class="image">
                        <img src="img/team_3.jpg" alt="">
                        <div class="social-icons">
                            <a href="#"><i class='bx bxl-facebook'></i></a>
                            <a href="#"><i class='bx bxl-twitter'></i></a>
                            <a href="#"><i class='bx bxl-instagram'></i></a>
                            <a href="#"><i class='bx bxl-pinterest'></i></a>
                        </div>
                        <div class="overlay"></div>
                    </div>

                    <h5>Darrell Steward</h5>
                    <p>Head of Accounting</p>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include "./includes/userModals.php"; ?>















<?php
include "./includes/footer.php";

?>


<script src="./admin/controllers/users/users.js"></script>

</body>

</html>