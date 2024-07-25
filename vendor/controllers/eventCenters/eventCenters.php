<?php
//include database configuration file
include_once '../../../admin/database/db.php';

$errors = array();


if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = '';
    $user_id = $_SESSION['user_id'];
    $usersView = "SELECT * FROM event_center WHERE user_id = ?";
    $stmt8 = $conn->prepare($usersView);
    $stmt10->bind_param("i", $user_id);
    $stmt8->execute();
    $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);


    if ($data) {
        $output .= '<table class="table table-stripped table-sm table-bordered text-body">
                        <thead>
                            <tr class="text-center">
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Address</th>
                                <th>Capacity</th>
                                <th>Charge/Event</th>
                                <th>Created By</th>
                                <th>Contact Email</th>
                                <th>Contact Phone</th>
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
            $output .= '<tr class="text-center text-body">
                            <td><img width="50px" height="50px" src="../admin/uploads/' . $row['image'] . '"></td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['description'] . '</td>
                            <td>' . $row['address'] . '</td>
                            <td>' . $row['capacity'] . '</td>
                            <td>' . $row['charge'] . '</td>
                            <td>' . $row1['username'] .'</td>
                            <td>' . $row1['email'] .'</td>
                            <td>' . $row1['phone'] .'</td>
                            <td>
                                <a href="#" title="View Details" class="text-success infoBtn" id="' . $row['center_id'] . '"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Edit Details" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="' . $row['center_id'] . '"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Delete" class="text-danger delBtn" id="' . $row['center_id'] . '"><i class="fas fa-trash-alt fa-lg"></i></a>
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

//add user from admin
if (isset($_POST['action']) && $_POST['action'] == "addNewCenter") {
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['address']) && !empty($_POST['capacity']) && !empty($_POST['charge']) && !empty($_FILES['image']['name'])) {
        $name = check_input($_POST["name"]);
        $description = check_input($_POST["description"]);
        $address = check_input($_POST["address"]);
        $capacity = check_input($_POST["capacity"]);
        $charge = check_input($_POST["charge"]);
        $user_id = $_SESSION['user_id'];
        $date = date('Y-m-d H:i:s');

        if (strlen($name) > 5) {


            $nameExists = "SELECT * FROM event_center WHERE name = ?";
            $stmt1 = $conn->prepare($nameExists);
            $stmt1->bind_param("s", $name);
            $stmt1->execute();
            $returnedCenter = $stmt1->get_result()->fetch_assoc();




            if ($returnedCenter && $returnedCenter['user_id'] == $user_id) {
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
                        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                        if ($result) {
                            $sql = "INSERT event_center (name,description,address,capacity,charge,user_id,image,created_at) VALUES (?,?,?,?,?,?,?,?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ssssssss", $name, $description, $address, $capacity, $charge, $user_id, $file_name, $date);
                            $insert = $stmt->execute();



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
if (isset($_POST['action']) && $_POST['action'] == "UpdateCenter") {
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['address']) && !empty($_POST['capacity']) && !empty($_POST['charge']) && !empty($_FILES['image']['name'])) {
        $id = $_POST["center_id"];
        $name = check_input($_POST["name"]);
        $description = check_input($_POST["description"]);
        $address = check_input($_POST["address"]);
        $capacity = check_input($_POST["capacity"]);
        $charge = check_input($_POST["charge"]);
        $user_id = $_SESSION['user_id'];


        if (strlen($name) > 3) {


            $nameExists = "SELECT * FROM event_center WHERE name = ?";
            $stmt1 = $conn->prepare($nameExists);
            $stmt1->bind_param("s", $name);
            $stmt1->execute();
            $returnedCenter = $stmt1->get_result()->fetch_assoc();

            if ($returnedCenter && $returnedCenter['center_id'] != $id && $returnedCenter['user_id'] == $user_id) {
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

                        $imgSql = "SELECT * FROM event_center WHERE center_id = ?";
                        $resultImg = $conn->prepare($imgSql);
                        $resultImg->bind_param("i", $id);
                        $resultImg->execute();
                        $resultImgR = $resultImg->get_result()->fetch_assoc();


                        $file1 = $resultImgR['image'];
                        $path1 = ('../../uploads/') . $file1;


                        if (file_exists($path1)) {
                            unlink($path1);
                        }
                        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                        if ($result) {

                            $sqlUpdate = "UPDATE event_center SET name = ?, description = ?, address = ?, capacity = ?, charge = ?, image = ? WHERE center_id = ?";
                            $stmtUpdate = $conn->prepare($sqlUpdate);
                            $stmtUpdate->bind_param("sssiisi", $name, $description, $address, $capacity, $charge,  $file_name, $id);
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
                    //Please select an image
                    echo '600';
                }
            }
        } else {
            //username must be more than five characters
            echo "900";
        }
    } elseif (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['address']) && !empty($_POST['capacity']) && !empty($_POST['charge'])) {
        $id = $_POST["center_id"];
        $name = check_input($_POST["name"]);
        $description = check_input($_POST["description"]);
        $address = check_input($_POST["address"]);
        $capacity = check_input($_POST["capacity"]);
        $charge = check_input($_POST["charge"]);
        $user_id = $_SESSION['user_id'];



        if (strlen($name) > 3) {

            $nameExists = "SELECT * FROM event_center WHERE name = ?";
            $stmt1 = $conn->prepare($nameExists);
            $stmt1->bind_param("s", $name);
            $stmt1->execute();
            $returnedCenter = $stmt1->get_result()->fetch_assoc();

            if ($returnedCenter && $returnedCenter['center_id'] != $id && $returnedCenter['user_id'] == $user_id) {
                //User exists in the database
                echo '200';
            } else {
                $sqlUpdate = "UPDATE event_center SET name = ?, description = ?, address = ?, capacity = ?, charge = ? WHERE center_id = ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("sssiii", $name, $description, $address, $capacity, $charge, $id);
                $update = $stmtUpdate->execute();




                if ($update === TRUE) {
                    //success
                    echo '300';
                } else {
                    //failed
                    echo '400';
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

    $editCenterQuery = "SELECT * FROM event_center WHERE center_id = ? LIMIT 1";
    $editCenter = $conn->prepare($editCenterQuery);
    $editCenter->bind_param("i", $id);
    $editCenter->execute();
    $editCenterResult = $editCenter->get_result()->fetch_assoc();
    echo json_encode($editCenterResult);
}



//view user on button click
if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];

    $viewCenterQuery = "SELECT * FROM event_center WHERE center_id = ? LIMIT 1";
    $viewCenter = $conn->prepare($viewCenterQuery);
    $viewCenter->bind_param("i", $id);
    $viewCenter->execute();
    $viewCenterResult = $viewCenter->get_result()->fetch_assoc();

    $user_id = $viewCenterResult['user_id'];

    $viewUserQuery = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
    $viewUser = $conn->prepare($viewUserQuery);
    $viewUser->bind_param("i", $user_id);
    $viewUser->execute();
    $viewUserResult = $viewUser->get_result()->fetch_assoc();



    $fullDetails = array("image"=>$viewCenterResult['image'], "address"=>$viewCenterResult['address'], "charge"=>$viewCenterResult['charge'], "username"=>$viewUserResult['username'], "email"=>$viewUserResult['email'], "phone"=>$viewUserResult['phone'], "capacity"=>$viewCenterResult['capacity'], "created_at"=>$viewCenterResult['created_at'], "name"=>$viewCenterResult['name'], "description"=>$viewCenterResult['description']);

    echo json_encode($fullDetails);
}





if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];
    $imgSql = "SELECT * FROM event_center WHERE center_id = '" . $id . "' LIMIT 1";
    $resultImg = $conn->query($imgSql);
    $resultImg1 = $resultImg->fetch_assoc();


    $file1 = $resultImg1['image'];
    $path1 = ('../../uploads/') . $file1;


    if (file_exists($path1)) {
        unlink($path1);
    }

    $delCenterQuery = "DELETE FROM `event_center` WHERE center_id = ?";
    $delCenter = $conn->prepare($delCenterQuery);
    $delCenter->bind_param("i", $id);
    $delCenter->execute();

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
