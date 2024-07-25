<?php
//include database configuration file
include_once '../../database/db.php';

$errors = array();




//edit category section
if (isset($_POST['rsvp_id'])) {
    $_SESSION['event_id'] = $id = $_POST['rsvp_id'];

    if (isset($_SESSION['user_id'])) {
        $priceQuery = "SELECT * FROM prices WHERE event_id = ? LIMIT 1";
        $prices = $conn->prepare($priceQuery);
        $prices->bind_param("i", $id);
        $prices->execute();
        $pricesResult = $prices->get_result()->fetch_assoc();

        if ($pricesResult) {
            echo "paid";
        } else {
            $event_id = $_SESSION['event_id'];
            $user_id = $_SESSION['user_id'];
            $ticket_id = $result = uniqid();
            $ticket_price = 0;

            $eventQuery = "SELECT * FROM events WHERE event_id = ?";
            $stmt20 = $conn->prepare($eventQuery);
            $stmt20->bind_param("i", $event_id);
            $stmt20->execute();
            $row20 = $stmt20->get_result()->fetch_assoc();

            $eventC = "SELECT * FROM event_center WHERE center_id = ?";
            $stmt21 = $conn->prepare($eventC);
            $stmt21->bind_param("i", $row20['center_id']);
            $stmt21->execute();
            $row21 = $stmt21->get_result()->fetch_assoc();

            $userQuery = "SELECT * FROM users WHERE user_id = ?";
            $stmt12 = $conn->prepare($userQuery);
            $stmt12->bind_param("i", $_SESSION['user_id']);
            $stmt12->execute();
            $row3 = $stmt12->get_result()->fetch_assoc();

            $insertSql = "INSERT rsvp (ticket_price,ticket_id,email,event_id,planner_id) VALUES (?,?,?,?,?)";
            $stmtSql = $conn->prepare($insertSql);
            $stmtSql->bind_param("issii", $ticket_price, $ticket_id, $row3['email'], $event_id,$row20['user_id']);
            $insert1 = $stmtSql->execute();





            if ($insert1) {
                $fullDetails = array("title" => $row20['title'], "date" => $row20['date'], "time" => $row20['time'], "name" => $row21['name'], "address" => $row21['address'], "ticket_id" => $ticket_id);



                echo json_encode($fullDetails);
            }
            unset($_SESSION['event_id']);
        }
    } else {
        echo "login";
    }
}


if (isset($_POST['pay_id'])) {
    $ticket_price = $_SESSION['ticket_price'];
    $event_id = $_SESSION['event_id'];
    $user_id = $_SESSION['user_id'];
    $ticket_id = $result = uniqid();

    $eventQuery = "SELECT * FROM events WHERE event_id = ?";
    $stmt20 = $conn->prepare($eventQuery);
    $stmt20->bind_param("i", $event_id);
    $stmt20->execute();
    $row20 = $stmt20->get_result()->fetch_assoc();

    $eventC = "SELECT * FROM event_center WHERE center_id = ?";
    $stmt21 = $conn->prepare($eventC);
    $stmt21->bind_param("i", $row20['center_id']);
    $stmt21->execute();
    $row21 = $stmt21->get_result()->fetch_assoc();

    $userQuery = "SELECT * FROM users WHERE user_id = ?";
    $stmt12 = $conn->prepare($userQuery);
    $stmt12->bind_param("i", $_SESSION['user_id']);
    $stmt12->execute();
    $row3 = $stmt12->get_result()->fetch_assoc();

    $insertSql = "INSERT rsvp (ticket_price,ticket_id,email,event_id,planner_id) VALUES (?,?,?,?,?)";
    $stmtSql = $conn->prepare($insertSql);
    $stmtSql->bind_param("issii", $ticket_price, $ticket_id, $row3['email'], $event_id,$row20['user_id']);
    $insert1 = $stmtSql->execute();


    $userPlannQuery = "SELECT * FROM account WHERE user_id = ?";
    $stmt29 = $conn->prepare($userPlannQuery);
    $stmt29->bind_param("i", $row20['user_id']);
    $stmt29->execute();
    $row29 = $stmt29->get_result()->fetch_assoc();
    if ($row29) {
        $total_money = "SELECT SUM(ticket_price) AS count FROM rsvp WHERE event_id = $event_id";
        $row30 = $conn->query($total_money);
        $row31 = $row30->fetch_array();
        $total_now = $row31['count'];

        $sqlUpdate = "UPDATE account SET balance = ? WHERE user_id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ii", $total_now, $row20['user_id']);
        $update = $stmtUpdate->execute();
    } else {
        $total_money = "SELECT SUM(ticket_price) AS count FROM rsvp WHERE event_id = $event_id";
        $row30 = $conn->query($total_money);
        $row31 = $row30->fetch_array();
        $total_now = $row31['count'];


        $insertSql1 = "INSERT account (user_id,balance) VALUES (?,?)";
        $stmtSql1 = $conn->prepare($insertSql1);
        $stmtSql1->bind_param("ii", $row20['user_id'], $total_now);
        $insert11 = $stmtSql1->execute();
    }






    if ($insert1) {
        $fullDetails = array("title" => $row20['title'], "date" => $row20['date'], "time" => $row20['time'], "name" => $row21['name'], "address" => $row21['address'], "price" => $ticket_price, "ticket_id" => $ticket_id);



        echo json_encode($fullDetails);
    }

    unset($_SESSION['ticket_price'], $_SESSION['event_id']);
}


if (isset($_POST['action']) && $_POST['action'] == 'payLogin') {
    $ticket_price = '';
    if (isset($_POST['price'])) {
        # code...
        $ticket_price = $_POST['price'];
    } else {
        # code...
        $ticket_price = 0;
    }
    $event_id = $_SESSION['event_id'];
    $email = $_POST['email'];
    $ticket_id = $result = uniqid();

    $eventQuery = "SELECT * FROM events WHERE event_id = ?";
    $stmt20 = $conn->prepare($eventQuery);
    $stmt20->bind_param("i", $event_id);
    $stmt20->execute();
    $row20 = $stmt20->get_result()->fetch_assoc();

    $eventC = "SELECT * FROM event_center WHERE center_id = ?";
    $stmt21 = $conn->prepare($eventC);
    $stmt21->bind_param("i", $row20['center_id']);
    $stmt21->execute();
    $row21 = $stmt21->get_result()->fetch_assoc();


    $insertSql = "INSERT rsvp (ticket_price,ticket_id,email,event_id,planner_id) VALUES (?,?,?,?,?)";
    $stmtSql = $conn->prepare($insertSql);
    $stmtSql->bind_param("issii", $ticket_price, $ticket_id, $email, $event_id,$row20['user_id']);
    $insert1 = $stmtSql->execute();


    $userPlannQuery = "SELECT * FROM account WHERE user_id = ?";
    $stmt29 = $conn->prepare($userPlannQuery);
    $stmt29->bind_param("i", $row20['user_id']);
    $stmt29->execute();
    $row29 = $stmt29->get_result()->fetch_assoc();
    if ($row29) {
        $total_money = "SELECT SUM(ticket_price) AS count FROM rsvp WHERE event_id = $event_id";
        $row30 = $conn->query($total_money);
        $row31 = $row30->fetch_array();
        $total_now = $row31['count'];

        $sqlUpdate = "UPDATE account SET balance = ? WHERE user_id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ii", $total_now, $row20['user_id']);
        $update = $stmtUpdate->execute();
    } else {
        $total_money = "SELECT SUM(ticket_price) AS count FROM rsvp WHERE event_id = $event_id";
        $row30 = $conn->query($total_money);
        $row31 = $row30->fetch_array();
        $total_now = $row31['count'];


        $insertSql1 = "INSERT account (user_id,balance) VALUES (?,?)";
        $stmtSql1 = $conn->prepare($insertSql1);
        $stmtSql1->bind_param("ii", $row20['user_id'], $total_now);
        $insert11 = $stmtSql1->execute();
    }





    if ($insert1) {
        $fullDetails = array("title" => $row20['title'], "date" => $row20['date'], "time" => $row20['time'], "name" => $row21['name'], "address" => $row21['address'], "price" => $ticket_price, "ticket_id" => $ticket_id);



        echo json_encode($fullDetails);
    }

    unset($_SESSION['ticket_price'], $_SESSION['event_id']);
}
/* if (isset($_POST['rsvp_id'])) {
    $id = $_POST['rsvp_id'];

    if ($_SESSION['user_id']) {
        $priceQuery = "SELECT * FROM prices WHERE event_id = ? LIMIT 1";
        $prices = $conn->prepare($priceQuery);
        $prices->bind_param("i", $id);
        $prices->execute();
        $pricesResult = $prices->get_result()->fetch_assoc();

        $userQuery = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
        $user = $conn->prepare($userQuery);
        $user->bind_param("i", $_SESSION['user_id']);
        $user->execute();
        $users = $user->get_result()->fetch_assoc();

        if ($pricesResult) {
                $fullDetails = array("event_id" => $id, "regular" => $pricesResult['regular'], "vip" => $pricesResult['vip'], "vvip" => $pricesResult['vvip'], "email" => $users['email']);
            
        
        
            echo json_encode($fullDetails);
        }else {
            echo "free";
        }
    }else {
        echo "login";
    }
} */
