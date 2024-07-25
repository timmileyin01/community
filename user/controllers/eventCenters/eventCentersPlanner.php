<?php
//include database configuration file
include_once '../../database/db.php';

$errors = array();


if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = '';
    $usersView = "SELECT * FROM event_center";
    $stmt8 = $conn->prepare($usersView);
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
