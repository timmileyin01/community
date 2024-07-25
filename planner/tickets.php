<?php
$currentPage = "tickets";
include "./includes/header.php";
?>
<!-- BEGIN .app-side -->
<?php include "./includes/aside.php"; ?>
<!-- END: .app-side -->
<!-- BEGIN .app-main -->
<div class="app-main">
    <!-- BEGIN .app-heading -->
    <?php include "./includes/topNav.php"; ?>
    <!-- END: .app-heading -->
    <!-- BEGIN .main-heading -->
    <?php include "./includes/mainHeading.php"; ?>
    <!-- END: .main-heading -->
    <!-- END: .main-heading -->
    <!-- BEGIN .main-content -->
    <div class="main-content">
        <section style="background-color: #eee">
            <div class="container py-lg-5 py-sm-2">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">User</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tickets
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <h4 class="mt-2 text-primary">Tickets Verification</h4>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyTicketModal"><i class="fas fa-ticket fa-lg"></i>&nbsp; Verify Ticket</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
</div>
<!-- END: .main-content -->
</div>
<!-- END: .app-main -->
</div>
<!-- END: .app-container -->



<!-- Member Add modal -->
<div class="modal fade" id="verifyTicketModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Verify Ticket<h4>
                        <p class="statusMsg"></p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" autocomplete="off" method="post" id="verify-ticket-form">

                    <div class="form-group">
                        <label for=""></label>
                        <select class="form-control" name="event_id" id="" required>
                            <option>Select Event</option>
                            <?php $events = "SELECT * FROM events";
                            $stmt = $conn->prepare($events);
                            $stmt->execute();
                            $eventData = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                            foreach ($eventData as $key => $row) :
                            ?>
                                <option value="<?= $row['event_id']; ?>"><?= $row['title']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="ticket_id" class="form-control" placeholder="Ticket ID" id="ticket_id" required>
                    </div>
                    <div class="mt-3">
                        <input type="submit" name="verifyTicketBtn" class="btn btn-danger btn-block" id="verifyTicketBtn" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>











<?php include "./includes/footer.php"; ?>


<script src="../admin/controllers/tickets/tickets.js"></script>
</body>

</html>