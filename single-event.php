<?php

include "./includes/header.php";
include "./includes/topNav.php";


if (isset($_GET['event_id'])) {
    $_SESSION['event_id'] = $_GET['event_id'];
    $event_id =  $_SESSION['event_id'];
    $eventQuery = "SELECT * FROM events WHERE event_id = ?";
    $stmt10 = $conn->prepare($eventQuery);
    $stmt10->bind_param("i", $event_id);
    $stmt10->execute();
    $row = $stmt10->get_result()->fetch_assoc();
}

?>


<section id="events">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <article class="blog-post">
                    <img src="./admin/uploads/<?= $row['flyer']; ?>" alt="">
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
                        <p><span class="text-dark fw-bolder"> Description : </span><?= $row['description'] ?></p>
                        <div class="row">
                            <div class="col-lg-4 m-2">
                                <small>DATE : <?= $row['date'] ?></small>
                            </div>
                            <div class="col-lg-4 m-2">
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

                        <div class="row col-lg-12 border">
                            <h5>Contact</h5>
                            <?php
                            $userQuery = "SELECT * FROM users WHERE user_id = ?";
                            $stmt12 = $conn->prepare($userQuery);
                            $stmt12->bind_param("i", $row['user_id']);
                            $stmt12->execute();
                            $row3 = $stmt12->get_result()->fetch_assoc();
                            ?>
                            <div class="col-lg-12 my-2">
                                <h6> Name : <span class="text-danger"><?= $row3['firstname'] . ' ' . $row3['lastname'] ?></span></h6>
                            </div>
                            <div class="col-lg-6 my-2">
                                <h6> Email : <span class="text-danger"><?= $row3['email'] ?></span></h6>
                            </div>
                            <div class="col-lg-6 my-2">
                                <h6> Phone : <span class="text-danger"><?= $row3['phone'] ?></span></h6>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 m-2">
                                <?php if($row['status'] == 'Upcoming'): ?>
                                <button type="button" id="<?= $row['event_id'] ?>" class="btn btn-lg btn-primary goingBtn">Going</button>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-4 m-2">
                                <a href="./events.php" class="btn btn-lg btn-danger">Ignore</a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>







<?php include "./includes/userModals.php"; ?>








<?php include "./includes/footer.php"; ?>


<script src="./admin/controllers/users/users.js"></script>
<script src="./admin/controllers/rsvp/rsvp.js"></script>

</body>

</html>