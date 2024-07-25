<?php
//include database configuration file
include_once '../../database/db.php';

$errors = array();






//add user from admin
if (isset($_POST['action']) && $_POST['action'] == "verifyTicket") {
    if (!empty($_POST['ticket_id']) && !empty($_POST['event_id'])) {
        $ticket_id = check_input($_POST["ticket_id"]);
        $event_id = check_input($_POST["event_id"]);
      


        


            $nameExists = "SELECT * FROM rsvp WHERE ticket_id = ? AND event_id = ?";
            $stmt1 = $conn->prepare($nameExists);
            $stmt1->bind_param("ii", $ticket_id, $event_id);
            $stmt1->execute();
            $returnedEvent = $stmt1->get_result()->fetch_assoc();




            if ($returnedEvent['ticket_id'] == $ticket_id) {
                //User exists in the database
                echo '300';
            } else {
               echo '200';
            }
        } else {
            //username must be more than five characters
            echo "700";
        }
}



function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}