    <!-- Login form modal -->
    <div class="modal fade" id="loginModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" autocomplete="off" method="post" id="login-member">
                        <div class="mb-3">
                            <input type="text" name="loginID" class="form-control" placeholder="Enter your Username, Email or Phone Number" minlength="6" id="" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Enter Password..." minlength="6" id="" required>
                        </div>
                        <div class="mt-3">
                            <input type="submit" name="loginBtn" class="btn btn-danger btn-block" id="loginBtn" value="Login">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Member signup modal -->
    <div class="modal fade" id="memberModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Member SignUp</h4>
                    <p class="statusMsg"></p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" autocomplete="off" method="post" id="form-member-data">
                        <div class="row col-lg-18 mb-3 mt-3">
                            <div class="col-lg-6">
                                <input type="text" name="firstname" class="form-control" placeholder="First Name" id="firstname" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name" id="lastname" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" minlength="6" id="username" required>
                            <span style="color:red;" id="displayUsernameError"></span>
                        </div>
                        <div class="row col-lg-18 mb-3 mt-3">
                            <div class="col-lg-6">
                                <input type="password" name="password" class="form-control" placeholder="Password" minlength="6" id="password" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm password" minlength="6" id="confirmpassword" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" id="email" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" id="phone" required>
                        </div>
                        <div class="prevImg mb-3">
                            <label class="form-label">Upload Image</label>
                            <div class="col-lg-2">
                                <img class="preview_img" src="img/default_profile.jpg">
                            </div>
                            <div class="col-lg-10">
                                <div class="file-upload text-secondary">
                                    <input type="file" class="image" name="image" id="image" accept="image/*">
                                    <span class="fs-4 fw-2">Choose file...</span>
                                    <span>or drag and drop file here</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <input type="submit" name="memberBtn" class="btn btn-danger btn-block" id="memberBtn" value="SignUp">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <?php
    if (isset($_SESSION['event_id'])) {
        $event_id = $_SESSION['event_id'];
        $eventQuery = "SELECT * FROM events WHERE event_id = ?";
        $stmt20 = $conn->prepare($eventQuery);
        $stmt20->bind_param("i", $event_id);
        $stmt20->execute();
        $row20 = $stmt20->get_result()->fetch_assoc();
    ?>

        <!-- Member signup modal -->
        <div class="modal fade" id="loginPayModal">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Make Payment</h4>
                        <p class="statusMsg"></p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body px-4">


                        <div class="container p-0">
                            <div class="card px-4">
                                <p class="h8 py-3">Payment Details</p>
                                <div class="row gx-3">
                                    <form action="" autocomplete="off" method="post" id="form-login-pay">
                                        <div class="col-12">
                                            <div class="d-flex flex-column">
                                                <p class="text mb-1">Event Name</p>
                                                <input class="form-control mb-3" type="text" value="<?= $row20['title'] ?>" disabled name="event_name">
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($_SESSION['event_id'])) {
                                            # code...
                                            $priceQuery = "SELECT * FROM prices WHERE event_id = ?";
                                            $stmt19 = $conn->prepare($priceQuery);
                                            $stmt19->bind_param("i", $_SESSION['event_id']);
                                            $stmt19->execute();
                                            $row9 = $stmt19->get_result()->fetch_assoc();

                                            if ($row9) {


                                        ?>

                                                <select name="price" id="" required class="form-control">



                                                    <option value="">Select Ticket Price</option>
                                                    <option value="<?= $row9['regular'] ?>"><?= 'Regular = ' . $row9['regular'] ?></option>
                                                    <option value="<?= $row9['vip'] ?>"><?= 'vip = ' . $row9['vip'] ?></option>
                                                    <option value="<?= $row9['vvip'] ?>"><?= 'vvip = ' . $row9['vvip'] ?></option>

                                                </select>
                                            <?php } ?>
                                        <?php } ?>
                                        <div class="col-12">
                                            <div class="d-flex flex-column">
                                                <p class="text mb-1">Email</p>
                                                <input class="form-control mb-3" type="text" placeholder="Enter your email" name="email">
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
                                            <button id="loginPayBtn" class="btn btn-primary mb-3 loginSubmitPayBtn">
                                                <span class="ps-3">Pay</span>
                                                <span class="fas fa-arrow-right"></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


    <?php } ?>


    <!-- Member signup modal -->
    <div class="modal fade" id="prices">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ticket Prices</h4>
                    <p class="statusMsg"></p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">


                    <div class="container p-0">
                        <div class="card px-4 pb-2">
                            <form autocomplete="off" method="post" action="./admin/controllers/rsvp/phprsvp.php">
                                <div class="form-group">
                                    <span>The Ticket is not free you have to pay to obtain it</span>
                                    <select name="price" id="" required class="form-control">
                                        <?php
                                        if (isset($_SESSION['event_id'])) {
                                            # code...
                                            $priceQuery = "SELECT * FROM prices WHERE event_id = ?";
                                            $stmt19 = $conn->prepare($priceQuery);
                                            $stmt19->bind_param("i", $_SESSION['event_id']);
                                            $stmt19->execute();
                                            $row9 = $stmt19->get_result()->fetch_assoc();
                                        ?>



                                            <option value="">Select Ticket Price</option>
                                            <option value="<?= $row9['regular'] ?>"><?= 'Regular = ' . $row9['regular'] ?></option>
                                            <option value="<?= $row9['vip'] ?>"><?= 'vip = ' . $row9['vip'] ?></option>
                                            <option value="<?= $row9['vvip'] ?>"><?= 'vvip = ' . $row9['vvip'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" name="payBtn" class="btn btn-primary btn-block" id="payBtn" value="Pay">
                                </div>
                            </form>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Member signup modal -->
    <div class="modal fade" id="ticketModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Your Ticket</h4>
                    <p class="statusMsg"></p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">


                    <div class="container p-0">
                        <div class="card px-4 pb-2">
                            <div class="form-group">
                                <span>Event Name</span><span>Bla bla bla</span>
                            </div>
                            <div class="form-group">
                                <span>Date</span><span>Bla bla bla</span>
                            </div>
                            <div class="form-group">
                                <span>Time</span><span>Bla bla bla</span>
                            </div>
                            <div class="form-group">
                                <span>Event Center</span><span>Bla bla bla</span>
                            </div>
                            <div class="form-group">
                                <span>Address</span><span>Bla bla bla</span>
                            </div>
                            <div class="form-group">
                                <span>Ticket Price</span><span>7000</span>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>