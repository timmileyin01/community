<?php

include "./includes/header.php";
include "./includes/topNav.php";


?>


<?php
if (isset($_SESSION['ticket_price']) && isset($_SESSION['event_id'])) {
    $event_id = $_SESSION['event_id'];
    $eventQuery = "SELECT * FROM events WHERE event_id = ?";
    $stmt20 = $conn->prepare($eventQuery);
    $stmt20->bind_param("i", $event_id);
    $stmt20->execute();
    $row20 = $stmt20->get_result()->fetch_assoc();
?>
    <div class="container p-0 my-4">
        <div class="card px-4">
            <p class="h8 py-3">Payment Details</p>
            <div class="row gx-3">
                <form action="" autocomplete="off" method="post" id="form-pay">

                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Event Name</p>
                            <input class="form-control mb-3" type="text" value="<?= $row20['title'] ?>" disabled name="event_name">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Ticket Price</p>
                            <input class="form-control mb-3" type="number" value="<?= $_SESSION['ticket_price'] ?>" disabled name="price">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                $userQuery = "SELECT * FROM users WHERE user_id = ?";
                                $stmt12 = $conn->prepare($userQuery);
                                $stmt12->bind_param("i", $_SESSION['user_id']);
                                $stmt12->execute();
                                $row3 = $stmt12->get_result()->fetch_assoc();
                            ?>
                                <p class="text mb-1">Email</p>
                                <input class="form-control mb-3" type="text" value="<?= $row3['email'] ?>" disabled placeholder="Email" name="email">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Card Number</p>
                            <input class="form-control mb-3" type="text" name="card_no" placeholder="1234 5678 435678">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Expiry</p>
                            <input class="form-control mb-3" type="text" name="exp" placeholder="MM/YYYY">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">CVV/CVC</p>
                            <input class="form-control mb-3 pt-2 " type="password" name="cvv" placeholder="***">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" id="<?= $_SESSION['event_id'] ?>" class="btn btn-primary mb-3 submitPayBtn">
                            <span class="ps-3">Pay</span>
                            <span class="fas fa-arrow-right"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>





<?php include "./includes/userModals.php"; ?>








<?php include "./includes/footer.php"; ?>


<script src="./admin/controllers/users/users.js"></script>
<script src="./admin/controllers/rsvp/rsvp.js"></script>

</body>

</html>