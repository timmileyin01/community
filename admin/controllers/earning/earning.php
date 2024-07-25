<?php
//include database configuration file
include_once '../../database/db.php';

$errors = array();


if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = '';
    $accountView = "SELECT * FROM account";
    $stmt8 = $conn->prepare($accountView);
    $stmt8->execute();
    $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);



    if ($data) {
        $output .= '<table class="table table-stripped table-sm table-bordered text-body">
                        <thead>
                            <tr class="text-center">
                                <th>Name</th>
								<th>No. of Events</th>
								<th>Tickets Sold</th>
								<th>Balance</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
            $user_idBy = $row['user_id'];
            $userBy = "SELECT * FROM users WHERE user_id = ?";
            $stmt10 = $conn->prepare($userBy);
            $stmt10->bind_param("i", $user_idBy);
            $stmt10->execute();
            $row1 = $stmt10->get_result()->fetch_assoc();


            $rsvpBy = "SELECT * FROM rsvp WHERE planner_id = ?";
            $stmt11 = $conn->prepare($rsvpBy);
            $stmt11->bind_param("i", $user_idBy);
            $stmt11->execute();
            $row2 = $stmt11->get_result();
            $row2 = $row2->num_rows;


            $eventBy = "SELECT * FROM events WHERE user_id = ?";
            $stmt12 = $conn->prepare($eventBy);
            $stmt12->bind_param("i", $user_idBy);
            $stmt12->execute();
            $row3 = $stmt12->get_result();
            $row3 = $row3->num_rows;




            $output .= '<tr class="text-center text-body">
                            <td>' . $row1['firstname'] . " " . $row1['lastname'] . '</td>
                            <td>' . $row3 . '</td>
                            <td>' . $row2 . '</td>
                            <td>' . $row['balance'] . '</td>
                            <td>
                                <a href="#" title="View Details" class="text-success infoBtn" id="' . $row['account_id'] . '"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Edit Details" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="' . $row['account_id'] . '"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                            </td>
                            </tr>
                            ';
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary mt-5">No Record Found!</h3>';
    }
}



//edit category section
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];


    $editAccountQuery = "SELECT * FROM account WHERE account_id = ? LIMIT 1";
    $editAccount = $conn->prepare($editAccountQuery);
    $editAccount->bind_param("i", $id);
    $editAccount->execute();
    $editAccountResult = $editAccount->get_result()->fetch_assoc();
    echo json_encode($editAccountResult);
}


//view user on button click
if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];

    $viewAccountQuery = "SELECT * FROM account WHERE account_id = ? LIMIT 1";
    $viewAccount = $conn->prepare($viewAccountQuery);
    $viewAccount->bind_param("i", $id);
    $viewAccount->execute();
    $viewAccountResult = $viewAccount->get_result()->fetch_assoc();

    $user_idBy = $viewAccountResult['user_id'];
    $userBy = "SELECT * FROM users WHERE user_id = ?";
    $stmt10 = $conn->prepare($userBy);
    $stmt10->bind_param("i", $user_idBy);
    $stmt10->execute();
    $row1 = $stmt10->get_result()->fetch_assoc();

    $name = $row1['firstname'] . ' ' . $row1['lastname'];


    $rsvpBy = "SELECT * FROM rsvp WHERE planner_id = ?";
    $stmt11 = $conn->prepare($rsvpBy);
    $stmt11->bind_param("i", $user_idBy);
    $stmt11->execute();
    $row2 = $stmt11->get_result();
    $row2 = $row2->num_rows;


    $eventBy = "SELECT * FROM events WHERE user_id = ?";
    $stmt12 = $conn->prepare($eventBy);
    $stmt12->bind_param("i", $user_idBy);
    $stmt12->execute();
    $row3 = $stmt12->get_result();
    $row3 = $row3->num_rows;




    $fullDetails = array("name" => $name, "no_of_events" => $row3, "tickets_sold" => $row2, "balance" => $viewAccountResult['balance']);



    echo json_encode($fullDetails);
}



//edit category from admin
if (isset($_POST['action']) && $_POST['action'] == "updateAccount") {
    if (!empty($_POST['balance'])) {
        $account_id = $_POST["account_id"];
        $user_id = $_POST["user_id"];
        $balance = check_input($_POST["balance"]);

           




                
                $sql = "UPDATE account SET balance = ? WHERE account_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $balance, $account_id);
                $update = $stmt->execute();



                if ($update === TRUE) {
                    //success
                    echo '300';
                } else {
                    //failed
                    echo '400';
                }
            
    } else {
        //You must fill all fields 
        echo '700';
    }
}