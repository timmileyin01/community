


<?php
//include database configuration file
include_once '../../database/db.php';
$id = 2;
$name = 'carols';
$nameExists = "SELECT * FROM events WHERE title = ?";
            $stmt1 = $conn->prepare($nameExists);
            $stmt1->bind_param("s", $name);
            $stmt1->execute();
            $returnedEvent = $stmt1->get_result()->fetch_assoc();

            if ($returnedEvent && $returnedEvent['event_id'] != $id && $returnedEvent['user_id'] == 5) {
                //User exists in the database
                echo '200';
            }else {
                echo "good";
            }


?>