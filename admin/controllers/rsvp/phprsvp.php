<?php


$errors = array();

session_start();

if (isset($_POST['payBtn'])) {
    $_SESSION['ticket_price'] = $_POST['price'];

    header("location: " . '../../../rsvp.php');
    exit();
}


