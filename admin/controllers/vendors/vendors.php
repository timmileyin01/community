<?php
//include database configuration file
include_once '../../database/db.php';

$errors = array();


if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = '';
    $user_role = 'vendor_member';
    $usersView = "SELECT * FROM users WHERE user_role = ?";
    $stmt8 = $conn->prepare($usersView);
    $stmt8->bind_param("s", $user_role);
    $stmt8->execute();
    $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);

    if ($data) {
        $output .= '<table class="table table-stripped table-sm table-bordered text-body">
                        <thead>
                            <tr class="text-center">
                                <th>Image</th>
                                <th>Name</th>
                                <th>Service</th>
                                <th>Description of Service</th>
                                <th>Charge/Event</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>                                           
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
            $id = $row['user_id'];
            $viewServiceQuery = "SELECT * FROM services WHERE user_id = ? LIMIT 1";
    $viewService = $conn->prepare($viewServiceQuery);
    $viewService->bind_param("i", $id);
    $viewService->execute();
    $viewServiceResult = $viewService->get_result()->fetch_assoc();
            $output .= '<tr class="text-center text-body">
                            <td><img class="rounded-circle" width="50px" height="50px" src="../admin/uploads/' . $row['image'] . '"></td>
                            <td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
                            <td>' . $viewServiceResult['name'] . '</td>
                            <td>' . $viewServiceResult['description'] . '</td>
                            <td>' . $viewServiceResult['charge'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $row['user_role'] . '</td>
                            <td>
                                <a href="#" title="View Details" class="text-success infoBtn" id="' . $row['user_id'] . '"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
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

    $viewUserQuery = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
    $viewUser = $conn->prepare($viewUserQuery);
    $viewUser->bind_param("i", $id);
    $viewUser->execute();
    $viewUserResult = $viewUser->get_result()->fetch_assoc();

    $viewServiceQuery = "SELECT * FROM services WHERE user_id = ? LIMIT 1";
    $viewService = $conn->prepare($viewServiceQuery);
    $viewService->bind_param("i", $id);
    $viewService->execute();
    $viewServiceResult = $viewService->get_result()->fetch_assoc();

    $fullDetails = array("image"=>$viewUserResult['image'], "firstname"=>$viewUserResult['firstname'], "lastname"=>$viewUserResult['lastname'], "username"=>$viewUserResult['username'], "email"=>$viewUserResult['email'], "phone"=>$viewUserResult['phone'], "user_role"=>$viewUserResult['user_role'], "created_at"=>$viewUserResult['created_at'], "name"=>$viewServiceResult['name'], "description"=>$viewServiceResult['description'], "charge"=>$viewServiceResult['charge']);

    echo json_encode($fullDetails);
}