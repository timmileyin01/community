<?php
//include database configuration file
include_once '../../database/db.php';

$errors = array();


//edit user from admin
if (isset($_POST['action']) && $_POST['action'] == "updateSetting") {
    if (!empty($_POST['title']) && !empty($_POST['about'])) {
        $id = 1;
        $title = check_input($_POST["title"]);
        $about = check_input($_POST["about"]);


        if (strlen($title) > 5) {



            $formIndex = 'image';


            $filetype = ['jpg', 'png', 'webp', 'jpeg'];


            $filesize = 1000000;
            if (!empty($_FILES['image']['name'])) {
                $file_name = time() . '_' . $_FILES['image']['name'];
                $destination = "../../uploads/" . $file_name;
                $errors = validateFile($_FILES, $formIndex, $filetype, $filesize);
                if (count($errors) == 0) {

                    $imgSql = "SELECT * FROM settings WHERE setting_id = ?";
                    $resultImg = $conn->prepare($imgSql);
                    $resultImg->bind_param("i", $id);
                    $resultImg->execute();
                    $resultImgR = $resultImg->get_result()->fetch_assoc();


                    $file1 = $resultImgR['logo'];
                    $path1 = ('../../uploads/') . $file1;


                    if (file_exists($path1)) {
                        unlink($path1);
                    }
                    $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                    if ($result) {
                        $sqlUpdate = "UPDATE settings SET title = ?, about = ?, logo = ? WHERE setting_id = ?";
                        $stmtUpdate = $conn->prepare($sqlUpdate);
                        $stmtUpdate->bind_param("sssi", $title, $about, $file_name, $id);
                        $update = $stmtUpdate->execute();

                        if ($update === TRUE) {
                            //success
                            echo '300';
                        } else {
                            //failed
                            echo '400';
                        }
                    } else {
                        //An error occured with image upload, Retry again!
                        echo '800';
                    }
                } else {
                    //Please check that your image is of type (jpg,png,webp,jpeg) and the size is 1mb and below
                    echo '500';
                }
            } else {
                $sqlUpdate = "UPDATE settings SET title = ?, about = ? WHERE setting_id = ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("ssi", $title, $about, $id);
                $update = $stmtUpdate->execute();


                if ($update === TRUE) {
                    //success
                    echo '300';
                } else {
                    //failed
                    echo '400';
                }
            }
        }
    } else {
        //You must fill all fields except image
        echo '700';
    }
}


//edit user from admin
if (isset($_POST['action']) && $_POST['action'] == "addMessage") {
    if (!empty($_POST['message']) && !empty($_POST['user_id'])) {
        $message = check_input($_POST["message"]);
        $receiver_id = $_POST["user_id"];
        $sender_id = $_SESSION['user_id'];

        $sql = "INSERT messages (receiver_id,message,sender_id) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isi", $receiver_id, $message, $sender_id);
        $insert = $stmt->execute();


        if ($insert === TRUE) {
            //success
            echo '300';
        } else {
            //failed
            echo '400';
        }
    } else {
        //You must fill all fields except image
        echo '700';
    }
}


//edit user from admin
if (isset($_POST['action']) && $_POST['action'] == "reminderMessage") {
    if (!empty($_POST['message'])) {
        $message = check_input($_POST["message"]);
        $event_id = $_POST["event_id"];
        $sender_id = $_SESSION['user_id'];

        $rsvpView = "SELECT * FROM rsvp WHERE event_id = ?";
        $stmt8 = $conn->prepare($rsvpView);
        $stmt8->bind_param("i", $event_id);
        $stmt8->execute();
        $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);
        
        $eventView = "SELECT * FROM events WHERE event_id = ?";
        $stmt81 = $conn->prepare($eventView);
        $stmt81->bind_param("i", $event_id);
        $stmt81->execute();
        $data2 = $stmt81->get_result()->fetch_assoc();

        $message = 'Event Title : ' . $data2['title'] . '<br>' . 'Event Date : ' . $data2['date'] . '<br>' . $message;
        $i = 0;
        foreach ($data as $key => $row) {
            $receiver_email = $row['email'];
            $userSql = "SELECT * FROM users WHERE email = ?";
            $resultUser = $conn->prepare($userSql);
            $resultUser->bind_param("s", $receiver_email);
            $resultUser->execute();
            $results = $resultUser->get_result()->fetch_assoc();
            if ($results) {

                $receiver_id = $results['user_id'];
                $sql = "INSERT messages (receiver_id,message,sender_id) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isi", $receiver_id, $message, $sender_id);
                $insert = $stmt->execute();

                $i++;
            }
        }




        if ($i > 0) {
            //success
            echo '300';
        } else {
            //failed
            echo '400';
        }
    } else {
        //You must fill all fields except image
        echo '700';
    }
}



//edit user section
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];

    $editEventQuery = "SELECT * FROM settings WHERE setting_id = ? LIMIT 1";
    $editEvent = $conn->prepare($editEventQuery);
    $editEvent->bind_param("i", $id);
    $editEvent->execute();
    $editEventResult = $editEvent->get_result()->fetch_assoc();




    $fullDetails = array("title" => $editEventResult['title'], "about" => $editEventResult['about']);


    echo json_encode($fullDetails);
}


//edit user section
if (isset($_POST['message_id'])) {
    $id = $_POST['message_id'];

    $fullDetails = array("event_id" => $id);


    echo json_encode($fullDetails);
}






function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}



function validateFile($file, $formIndex, $filetype, $filesize)
{
    $errors = array();

    $thumbnail = $file[$formIndex];

    $time = time(); //to make each image name unique
    $thumbnail_name = $time . $thumbnail['name'];
    $thumbnail_tmp_name = $thumbnail['tmp_name'];



    $allowed_files = $filetype;
    $extension = explode('.', $thumbnail_name);

    $extension = end($extension);

    if (!in_array($extension, $allowed_files)) {
        array_push($errors, 'Only jpg, jpeg, webp, png files allowed');
    }

    if ($thumbnail['size'] > $filesize) {
        array_push($errors, 'file is too large');
    }

    return $errors;
}
