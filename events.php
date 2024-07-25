<?php

include "./includes/header.php";
include "./includes/topNav.php";

$status = 'Upcoming';
$eventQuery = "SELECT * FROM events WHERE status = ?";
$events = $conn->prepare($eventQuery);
$events->bind_param("s", $status);
$events->execute();
$results = $events->get_result()->fetch_all(MYSQLI_ASSOC);

$search_te = "";

if (isset($_POST['search-term'])) {
    $search_term = '%' . $_POST['search-term'] . '%';
    $sql = "SELECT * FROM `events` WHERE `title` LIKE  '$search_term' OR `date` LIKE  '$search_term' OR `time` LIKE  '$search_term' AND `status` =  '$status' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $search_te = $_POST['search-term'];
}





?>



    <section id="events">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h6>Events</h6>
                        <h1>All Events</h1>
                        <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                            roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p>
                            <?php if(isset($_POST['search-term'])){ ?>
                            <h4>You search for : <?= $search_te; ?></h4>
                            <?php } ?>

                        <form class="d-flex col-lg-4 m-auto" method="post" action="events.php">
                            <input class="form-control me-2" type="text" name="search-term" placeholder="Search">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
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
        </div>
    </section>



    <?php include "./includes/userModals.php"; ?>








    <?php include "./includes/footer.php"; ?>


    <script src="./admin/controllers/users/users.js"></script>

</body>

</html>