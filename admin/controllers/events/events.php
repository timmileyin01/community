<?php
//include database configuration file
include_once '../../database/db.php';

$errors = array();


if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = '';
    $eventsView = "SELECT * FROM events";
    $eventsViewStmt = $conn->prepare($eventsView);
    $eventsViewStmt->execute();
    $data = $eventsViewStmt->get_result()->fetch_all(MYSQLI_ASSOC);


    if ($data) {
        $output .= '<table class="table table-stripped table-sm table-bordered text-body">
                        <thead>
                            <tr class="text-center">
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Event Center</th>
                                <th>Address</th>
                                <th>Capacity</th>
                                <th>Ticket Price</th>
                                <th>Status</th>                                
                                <th>Attendees</th>                                
                                <th>Reminders</th>
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

            $category_idBy = $row['category_id'];
            $categoryBy = "SELECT * FROM categories WHERE category_id = ?";
            $stmt11 = $conn->prepare($categoryBy);
            $stmt11->bind_param("i", $category_idBy);
            $stmt11->execute();
            $row2 = $stmt11->get_result()->fetch_assoc();

            $center_idBy = $row['center_id'];
            $centerBy = "SELECT * FROM event_center WHERE center_id = ?";
            $stmt12 = $conn->prepare($centerBy);
            $stmt12->bind_param("i", $center_idBy);
            $stmt12->execute();
            $row3 = $stmt12->get_result()->fetch_assoc();

            $price_idBy = $row['event_id'];
            $priceBy = "SELECT * FROM prices WHERE event_id = ?";
            $stmt13 = $conn->prepare($priceBy);
            $stmt13->bind_param("i", $price_idBy);
            $stmt13->execute();
            $row4 = $stmt13->get_result()->fetch_assoc();

            $ticket_idBy = $row['event_id'];
            $ticketBy = "SELECT * FROM rsvp WHERE event_id = ?";
            $stmt14 = $conn->prepare($ticketBy);
            $stmt14->bind_param("i", $ticket_idBy);
            $stmt14->execute();
            $row5 = $stmt14->get_result()->num_rows;

            if ($row4) {
                $output .= '<tr class="text-center text-body">
                <td><img width="50px" height="50px" src="../admin/uploads/' . $row['flyer'] . '"></td>
                <td>' . $row['title'] . '</td>
                <td>' . $row['description'] . '</td>
                <td>' . $row2['name'] . '</td>
                <td>' . $row['date'] . '</td>
                <td>' . $row['time'] . '</td>
                <td>' . $row3['name'] . '</td>
                <td>' . $row3['address'] . '</td>
                <td>' . $row3['capacity'] . '</td>
                <td>' . 'Regular = ' . $row4['regular'] . '<br> V.I.P = ' . $row4['vip'] . '<br> V.V.I.P = ' . $row4['vvip'] . '</td>
                <td>' . $row['status'] . '</td>
                <td>' . $row5 . '</td>
                <td>
                <a href="#" title="Send Reminders" class="text-primary reminderBtn" data-toggle="modal" data-target="#reminderModal" id="' . $row['event_id'] . '"><i class="fas fa-envelope fa-lg"></i></a>
                </td>
                <td>
                    <a href="#" title="View Details" class="text-success infoBtn" id="' . $row['event_id'] . '"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                    <a href="#" title="Edit Details" class="text-primary editBtn" data-toggle="modal" data-target="#editEventModal" id="' . $row['event_id'] . '"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                    <a href="#" title="Delete" class="text-danger delBtn" id="' . $row['event_id'] . '"><i class="fas fa-trash-alt fa-lg"></i></a>
                </td>
                </tr>
                ';
            } else {
                $output .= '<tr class="text-center text-body">
                            <td><img width="50px" height="50px" src="../admin/uploads/' . $row['flyer'] . '"></td>
                            <td>' . $row['title'] . '</td>
                            <td>' . $row['description'] . '</td>
                            <td>' . $row2['name'] . '</td>
                            <td>' . $row['date'] . '</td>
                            <td>' . $row['time'] . '</td>
                            <td>' . $row3['name'] . '</td>
                            <td>' . $row3['address'] . '</td>
                            <td>' . $row3['capacity'] . '</td>
                            <td>Free</td>
                            <td>' . $row['status'] . '</td>
                            <td>' . $row5 . '</td>
                            <td>
                            <a href="#" title="Send Reminders" class="text-primary reminderBtn" data-toggle="modal" data-target="#reminderModal" id="' . $row['event_id'] . '"><i class="fas fa-envelope fa-lg"></i></a>
                            </td>
                            <td>
                                <a href="#" title="View Details" class="text-success infoBtn" id="' . $row['event_id'] . '"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Edit Details" class="text-primary editBtn" data-toggle="modal" data-target="#editEventModal" id="' . $row['event_id'] . '"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Delete" class="text-danger delBtn" id="' . $row['event_id'] . '"><i class="fas fa-trash-alt fa-lg"></i></a>
                            </td>
                            </tr>
                            ';
            }
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary mt-5">No Record Found!</h3>';
    }
}

//add user from admin
if (isset($_POST['action']) && $_POST['action'] == "addNewEvent") {
    if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['category_id']) && !empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['center_id']) && !empty($_FILES['image']['name'])) {
        $title = check_input($_POST["title"]);
        $description = check_input($_POST["description"]);
        $category_id = check_input($_POST["category_id"]);
        $date = $_POST["date"];
        $date1 = date('Y-m-d H:i:s');
        $time = $_POST["time"];
        $center_id = check_input($_POST["center_id"]);
        $user_id = $_SESSION['user_id'];
        $status = "Upcoming";


        if (strlen($title) > 5) {


            $nameExists = "SELECT * FROM events WHERE title = ?";
            $stmt1 = $conn->prepare($nameExists);
            $stmt1->bind_param("s", $title);
            $stmt1->execute();
            $returnedEvent = $stmt1->get_result()->fetch_assoc();




            if ($returnedEvent && $returnedEvent['user_id'] == $user_id) {
                //User exists in the database
                echo '200';
            } else {
                $formIndex = 'image';


                $filetype = ['jpg', 'png', 'webp', 'jpeg'];


                $filesize = 5000000;
                if (!empty($_FILES['image']['name'])) {
                    $file_name = time() . '_' . $_FILES['image']['name'];
                    $destination = "../../uploads/" . $file_name;
                    $errors = validateFile($_FILES, $formIndex, $filetype, $filesize);
                    if (count($errors) == 0) {
                        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                        if ($result) {

                            $sql = "INSERT events (title,description,category_id,date,time,center_id,user_id,flyer,created_at,status) VALUES (?,?,?,?,?,?,?,?,?,?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ssissiisss", $title, $description, $category_id, $date, $time, $center_id, $user_id, $file_name, $date1, $status);
                            $insert = $stmt->execute();
                            $last_id = $conn->insert_id;

                            if (isset($_POST['regularPrice']) && !empty($_POST['regularPrice'])) {

                                $regularPrice = check_input($_POST["regularPrice"]);
                                $vipPrice = check_input($_POST["vipPrice"]);
                                $vvipPrice = check_input($_POST["vvipPrice"]);

                                $priceSql1 = "INSERT prices (regular,vip,vvip,event_id) VALUES (?,?,?,?)";
                                $stmtSql = $conn->prepare($priceSql1);
                                $stmtSql->bind_param("iiii", $regularPrice, $vipPrice, $vvipPrice, $last_id);
                                $insert1 = $stmtSql->execute();
                            }



                            if ($insert) {
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
                    //Please select an image
                    echo '600';
                }
            }
        } else {
            //username must be more than five characters
            echo "900";
        }
    } else {
        //You must fill all fields 
        echo '700';
    }
}



//edit user from admin
if (isset($_POST['action']) && $_POST['action'] == "updateEvent") {
    if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['category_id']) && !empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['center_id'])) {
        $id = $_POST["event_id"];
        $title = check_input($_POST["title"]);
        $description = check_input($_POST["description"]);
        $category_id = check_input($_POST["category_id"]);
        $date = $_POST["date"];
        $time = $_POST["time"];
        $center_id = check_input($_POST["center_id"]);
        $status = check_input($_POST["status"]);


        if (strlen($title) > 5) {


            $nameExists = "SELECT * FROM events WHERE title = ?";
            $stmt1 = $conn->prepare($nameExists);
            $stmt1->bind_param("s", $title);
            $stmt1->execute();
            $returnedEvent = $stmt1->get_result()->fetch_assoc();

            if ($returnedEvent && $returnedEvent['event_id'] != $id && $returnedEvent['user_id'] == $user_id) {
                //User exists in the database
                echo '200';
            } else {
                $formIndex = 'image';


                $filetype = ['jpg', 'png', 'webp', 'jpeg'];


                $filesize = 1000000;
                if (!empty($_FILES['image']['name'])) {
                    $file_name = time() . '_' . $_FILES['image']['name'];
                    $destination = "../../uploads/" . $file_name;
                    $errors = validateFile($_FILES, $formIndex, $filetype, $filesize);
                    if (count($errors) == 0) {

                        $imgSql = "SELECT * FROM events WHERE event_id = ?";
                        $resultImg = $conn->prepare($imgSql);
                        $resultImg->bind_param("i", $id);
                        $resultImg->execute();
                        $resultImgR = $resultImg->get_result()->fetch_assoc();


                        $file1 = $resultImgR['flyer'];
                        $path1 = ('../../uploads/') . $file1;


                        if (file_exists($path1)) {
                            unlink($path1);
                        }
                        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                        if ($result) {
                            $sqlUpdate = "UPDATE events SET title = ?, description = ?, category_id = ?, date = ?, time = ?, center_id = ?, flyer = ?, status = ? WHERE event_id = ?";
                            $stmtUpdate = $conn->prepare($sqlUpdate);
                            $stmtUpdate->bind_param("ssississi", $title, $description, $category_id, $date, $time,  $center_id, $file_name, $status, $id);
                            $update = $stmtUpdate->execute();

                            if (isset($_POST['regularPrice']) && !empty($_POST['regularPrice'])) {

                                $regularPrice = check_input($_POST["regularPrice"]);
                                $vipPrice = check_input($_POST["vipPrice"]);
                                $vvipPrice = check_input($_POST["vvipPrice"]);

                                $priceSql1 = "UPDATE prices SET regular = ?, vip = ?, vvip = ? WHERE event_id = ?";
                                $stmtSql = $conn->prepare($priceSql1);
                                $stmtSql->bind_param("iiii", $regularPrice, $vipPrice, $vvipPrice, $id);
                                $insert1 = $stmtSql->execute();
                            } else if (isset($_POST['regularPrice']) && empty($_POST['regularPrice'])) {
                                $delPriceQuery = "DELETE FROM `prices` WHERE event_id = ?";
                                $delPrice = $conn->prepare($delPriceQuery);
                                $delPrice->bind_param("i", $id);
                                $delPrice->execute();
                            }





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
                    $sqlUpdate = "UPDATE events SET title = ?, description = ?, category_id = ?, date = ?, time = ?, center_id = ?, status = ? WHERE event_id = ?";
                    $stmtUpdate = $conn->prepare($sqlUpdate);
                    $stmtUpdate->bind_param("ssissisi", $title, $description, $category_id, $date, $time,  $center_id, $status, $id);
                    $update = $stmtUpdate->execute();

                    if (isset($_POST['regularPrice']) && !empty($_POST['regularPrice'])) {

                        $regularPrice = check_input($_POST["regularPrice"]);
                        $vipPrice = check_input($_POST["vipPrice"]);
                        $vvipPrice = check_input($_POST["vvipPrice"]);

                        $priceSql1 = "UPDATE prices SET regular = ?, vip = ?, vvip = ? WHERE event_id = ?";
                        $stmtSql = $conn->prepare($priceSql1);
                        $stmtSql->bind_param("iiii", $regularPrice, $vipPrice, $vvipPrice, $id);
                        $insert1 = $stmtSql->execute();
                    }else if (isset($_POST['regularPrice']) && empty($_POST['regularPrice'])) {
                        $delPriceQuery = "DELETE FROM `prices` WHERE event_id = ?";
                        $delPrice = $conn->prepare($delPriceQuery);
                        $delPrice->bind_param("i", $id);
                        $delPrice->execute();
                    }





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
            //username must be more than five characters
            echo "900";
        }
    } else {
        //You must fill all fields except image
        echo '700';
    }
}

//edit user section
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];

    $editEventQuery = "SELECT * FROM events WHERE event_id = ? LIMIT 1";
    $editEvent = $conn->prepare($editEventQuery);
    $editEvent->bind_param("i", $id);
    $editEvent->execute();
    $editEventResult = $editEvent->get_result()->fetch_assoc();

    $viewEventQuery = "SELECT * FROM prices WHERE event_id = ? LIMIT 1";
    $viewEvent = $conn->prepare($viewEventQuery);
    $viewEvent->bind_param("i", $id);
    $viewEvent->execute();
    $viewEventResult = $viewEvent->get_result()->fetch_assoc();



    if ($viewEventResult) {
        $fullDetails = array("event_id" => $id, "title" => $editEventResult['title'], "description" => $editEventResult['description'], "category_id" => $editEventResult['category_id'], "date" => $editEventResult['date'], "time" => $editEventResult['time'], "center_id" => $editEventResult['center_id'], "status" => $editEventResult['status'], "regular" => $viewEventResult['regular'], "vip" => $viewEventResult['vip'], "vvip" => $viewEventResult['vvip']);
    } else {
        $fullDetails = array("event_id" => $id, "title" => $editEventResult['title'], "description" => $editEventResult['description'], "category_id" => $editEventResult['category_id'], "status" => $editEventResult['status'], "date" => $editEventResult['date'], "time" => $editEventResult['time'], "center_id" => $editEventResult['center_id']);
    }


    echo json_encode($fullDetails);
}



//view user on button click
if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];

    $viewCenterQuery = "SELECT * FROM events WHERE event_id = ? LIMIT 1";
    $viewCenter = $conn->prepare($viewCenterQuery);
    $viewCenter->bind_param("i", $id);
    $viewCenter->execute();
    $viewCenterResult = $viewCenter->get_result()->fetch_assoc();

    $user_id = $viewCenterResult['user_id'];

    $category_idBy = $viewCenterResult['category_id'];
    $categoryBy = "SELECT * FROM categories WHERE category_id = ?";
    $stmt11 = $conn->prepare($categoryBy);
    $stmt11->bind_param("i", $category_idBy);
    $stmt11->execute();
    $row2 = $stmt11->get_result()->fetch_assoc();

    $center_idBy = $viewCenterResult['center_id'];
    $centerBy = "SELECT * FROM event_center WHERE center_id = ?";
    $stmt12 = $conn->prepare($centerBy);
    $stmt12->bind_param("i", $center_idBy);
    $stmt12->execute();
    $row3 = $stmt12->get_result()->fetch_assoc();

    $priceBy = "SELECT * FROM prices WHERE event_id = ?";
    $stmt13 = $conn->prepare($priceBy);
    $stmt13->bind_param("i", $id);
    $stmt13->execute();
    $row4 = $stmt13->get_result()->fetch_assoc();


    if ($row4) {
        $fullDetails = array("image" => $viewCenterResult['flyer'], "title" => $viewCenterResult['title'], "description" => $viewCenterResult['description'], "category_name" => $row2['name'], "date" => $viewCenterResult['date'], "time" => $viewCenterResult['time'], "center_name" => $row3['name'], "capacity" => $row3['capacity'], "address" => $row3['address'], "regular" => $row4['regular'], "vip" => $row4['vip'], "vvip" => $row4['vvip']);
    } else {

        $fullDetails = array("image" => $viewCenterResult['flyer'], "title" => $viewCenterResult['title'], "description" => $viewCenterResult['description'], "category_name" => $row2['name'], "date" => $viewCenterResult['date'], "time" => $viewCenterResult['time'], "center_name" => $row3['name'], "capacity" => $row3['capacity'], "address" => $row3['address']);
    }

    echo json_encode($fullDetails);
}





if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];
    $imgSql = "SELECT * FROM events WHERE event_id = '" . $id . "' LIMIT 1";
    $resultImg = $conn->query($imgSql);
    $resultImg1 = $resultImg->fetch_assoc();


    $file1 = $resultImg1['flyer'];
    $path1 = ('../../uploads/') . $file1;


    if (file_exists($path1)) {
        unlink($path1);
    }

    $delCenterQuery = "DELETE FROM `events` WHERE event_id = ?";
    $delCenter = $conn->prepare($delCenterQuery);
    $delCenter->bind_param("i", $id);
    $delCenter->execute();
    if ($delCenter) {
        # code...
        $delPriceQuery = "DELETE FROM `prices` WHERE event_id = ?";
        $delPrice = $conn->prepare($delPriceQuery);
        $delPrice->bind_param("i", $id);
        $delPrice->execute();
    }

    if ($delCenter) {
        //passwords do not match
        echo '100';
    } else {
        //passwords do not match
        echo '200';
    }
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
