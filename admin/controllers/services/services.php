<?php
//include database configuration file
include_once '../../database/db.php';

$errors = array();


if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = '';
    $usersView = "SELECT * FROM services";
    $stmt8 = $conn->prepare($usersView);
    $stmt8->execute();
    $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);



    if ($data) {
        $output .= '<table class="table table-stripped table-sm table-bordered text-body">
                        <thead>
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Description</th>
                                <th>Charge/Event</th>
                                <th>Created By</th>
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
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['description'] . '</td>
                            <td>' . $row['charge'] . '</td>
                            <td>' . $row1['firstname'] . " " . $row1['lastname'] . '</td>
                            <td>
                                <a href="#" title="View Details" class="text-success infoBtn" id="' . $row['service_id'] . '"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Edit Details" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="' . $row['service_id'] . '"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Delete" class="text-danger delBtn" id="' . $row['service_id'] . '"><i class="fas fa-trash-alt fa-lg"></i></a>
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
if (isset($_POST['action']) && $_POST['action'] == "addNewService") {
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['charge'])) {
        $name = check_input($_POST["name"]);
        $description = check_input($_POST["description"]);
        $charge = check_input($_POST["charge"]);
        $date = date('Y-m-d H:i:s');
        $user_id = $_SESSION['user_id'];

        if (strlen($name) > 3) {


            $usernameExists = "SELECT * FROM services WHERE name = ?";
            $stmt1 = $conn->prepare($usernameExists);
            $stmt1->bind_param("s", $name);
            $stmt1->execute();
            $returnedService = $stmt1->get_result()->fetch_assoc();




            if ($returnedService && $returnedService['user_id'] == $user_id) {
                //Service exists in the database
                echo '200';
            } else {

                $sql = "INSERT services (name,description,charge,created_at,user_id) VALUES (?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssisi", $name, $description, $charge, $date, $user_id);
                $insert = $stmt->execute();



                if ($insert) {
                    //success
                    echo '300';
                } else {
                    //failed
                    echo '400';
                }
            }
        } else {
            //Category name must be more than five characters
            echo "900";
        }
    } else {
        //You must fill all fields 
        echo '700';
    }
}



//edit service from admin
if (isset($_POST['action']) && $_POST['action'] == "UpdateService") {
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['charge'])) {
        $id = $_POST["service_id"];
        $name = check_input($_POST["name"]);
        $description = check_input($_POST["description"]);
        $charge = check_input($_POST["charge"]);
        $user_id = $_SESSION['user_id'];

        if (strlen($name) > 3) {


            $usernameExists = "SELECT * FROM services WHERE name = ?";
            $stmt1 = $conn->prepare($usernameExists);
            $stmt1->bind_param("s", $name);
            $stmt1->execute();
            $returnedService = $stmt1->get_result()->fetch_assoc();




            if ($returnedService && $returnedService['service_id'] != $id && $returnedService['user_id'] == $user_id) {
                //Services exists in the database
                echo '200';
            } else {


                $sql = "UPDATE services SET name = ?, description = ?, charge = ? WHERE service_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssii", $name, $description, $charge, $id);
                $update = $stmt->execute();



                if ($update === TRUE) {
                    //success
                    echo '300';
                } else {
                    //failed
                    echo '400';
                }
            }
        } else {
            //Category name must be more than five characters
            echo "900";
        }
    } else {
        //You must fill all fields 
        echo '700';
    }
}





//edit category section
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];


    $editServiceQuery = "SELECT * FROM services WHERE service_id = ? LIMIT 1";
    $editService = $conn->prepare($editServiceQuery);
    $editService->bind_param("i", $id);
    $editService->execute();
    $editServiceResult = $editService->get_result()->fetch_assoc();
    echo json_encode($editServiceResult);
}


//view user on button click
if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];

    $viewServiceQuery = "SELECT * FROM services WHERE service_id = ? LIMIT 1";
    $viewService = $conn->prepare($viewServiceQuery);
    $viewService->bind_param("i", $id);
    $viewService->execute();
    $viewServiceResult = $viewService->get_result()->fetch_assoc();
    echo json_encode($viewServiceResult);
}





if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];

    $delServiceQuery = "DELETE FROM `services` WHERE service_id = ?";
    $delService = $conn->prepare($delServiceQuery);
    $delService->bind_param("i", $id);
    $delService->execute();

    if ($delService) {
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
