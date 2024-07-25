<?php
$currentPage = "events";
include "./includes/header.php";
?>

<!-- .app-side -->
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
                                    Events
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
                    <div class="col-lg-6">
                        <h4 class="mt-2 text-primary">ALL YOUR Events</h4>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-primary m-1 float-lg-right" data-toggle="modal" data-target="#addEventModal"><i class="fas fa-user-plus fa-lg"></i>&nbsp; Add Event</button>
                    </div>
                </div>
                <div class="table-responsive" id="showEvent">
                    <h3 class="text-center text-success" style="margin-top: 150px;">Loading...</h3>
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




<!-- add new user modal -->
<!-- The Modal -->
<div class="modal fade" id="addEventModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create an Event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" method="post" id="add-event-form">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title of Event.." id="" required>
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" placeholder="Description of Event.." id=""></textarea>
                    </div>
                    <div class="form-group">
                        <select name="category_id" class="form-control" id="">
                            <option value="">Select Event Category</option>
                            <?php $usersView = "SELECT * FROM categories";
                            $stmt8 = $conn->prepare($usersView);
                            $stmt8->execute();
                            $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);
                            foreach ($data as $key => $row) :
                            ?>
                                <option value="<?= $row['category_id']; ?>"><?= $row['name']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Date of Event</label>
                        <input type="date" name="date" class="form-control" placeholder="Date of Event.." id="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Time of Event</label>
                        <input type="time" name="time" class="form-control" placeholder="Time of Event.." id="" required>
                    </div>
                    <div class="form-group">
                        <select name="center_id" class="form-control" id="">
                            <option value="">Select Event Center</option>
                            <?php $centerView = "SELECT * FROM event_center";
                            $stmt = $conn->prepare($centerView);
                            $stmt->execute();
                            $centerData = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                            foreach ($centerData as $key => $centerRow) :
                            ?>
                                <option value="<?= $centerRow['center_id']; ?>"><?= $centerRow['name']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Upload a Flyer</label>
                        <div class="col-lg-10">
                            <div class="file-upload text-secondary">
                                <input type="file" class="image" name="image" accept="image/*">
                                <span class="fs-4 fw-2">Choose file...</span>
                                <span>or drag and drop file here</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-check mb-3" id="hideAppendPrice">
                        <label class="form-check-label">
                            <button type="button" class="btn btn-primary" id="appendPrice">Click me</button> if the event ticket is not free
                        </label>
                    </div>
                    <div id="receivePrice">

                    </div>
                    <div class="form-group">
                        <input type="submit" name="addEventBtn" class="btn btn-danger btn-block" id="addEventBtn" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- edit user modal -->
<!-- The Modal -->
<div class="modal fade" id="editEventModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" method="post" id="edit-event-form">
                    <input type="hidden" name="event_id">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title of Event.." id="" required>
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" placeholder="Description of Event.." id=""></textarea>
                    </div>
                    <div class="form-group">
                        <select name="category_id" class="form-control" id="">
                            <option value="">Select Event Category</option>
                            <?php $usersView = "SELECT * FROM categories";
                            $stmt8 = $conn->prepare($usersView);
                            $stmt8->execute();
                            $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);
                            foreach ($data as $key => $row) :
                            ?>
                                <option value="<?= $row['category_id']; ?>"><?= $row['name']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Date of Event</label>
                        <input type="date" name="date" class="form-control" placeholder="Date of Event.." id="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Time of Event</label>
                        <input type="time" name="time" class="form-control" placeholder="Time of Event.." id="" required>
                    </div>
                    <div class="form-group">
                        <select name="center_id" class="form-control" id="">
                            <option value="">Select Event Center</option>
                            <?php $centerView = "SELECT * FROM event_center";
                            $stmt = $conn->prepare($centerView);
                            $stmt->execute();
                            $centerData = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                            foreach ($centerData as $key => $centerRow) :
                            ?>
                                <option value="<?= $centerRow['center_id']; ?>"><?= $centerRow['name']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Upload a Flyer</label>
                        <div class="col-lg-10">
                            <div class="file-upload text-secondary">
                                <input type="file" class="image" name="image" accept="image/*">
                                <span class="fs-4 fw-2">Choose file...</span>
                                <span>or drag and drop file here</span>
                            </div>
                        </div>
                    </div>
                    <div id="receivePrice">
                        <div class="form-group"><span class="text-dark my-1">Regular in (Naira)</span>
                        <input type="number" class="form-control" name="regularPrice" placeholder="Price e.g. 6000" ></div>
                        <div class="form-group"><span class="text-dark my-1">VIP in (Naira)</span><input type="number" class="form-control" name="vipPrice" placeholder="Price e.g. 6000" ></div>
                        <div class="form-group"><span class="text-dark my-1">VVIP in (Naira)</span><input type="number" class="form-control" name="vvipPrice" placeholder="Price e.g. 6000"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Status of Event</label>
                        <input type="text" name="status" class="form-control" placeholder="Status of Event.." id="" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editEventBtn" class="btn btn-danger btn-block" id="editEventBtn" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>







<!-- BEGIN .main-footer -->
<?php include "./includes/footer.php"; ?>

<script src="./controllers/events/events.js"></script>
</body>

</html>