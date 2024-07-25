<?php
//include database configuration file
include_once '../../database/db.php';

$errors = array();

if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = '';
    $usersView = "SELECT * FROM categories";
    $stmt8 = $conn->prepare($usersView);
    $stmt8->execute();
    $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);

    if ($data) {
        $output .= '<table class="table table-stripped table-sm table-bordered text-body">
                        <thead>
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
            $output .= '<tr class="text-center">
                           
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['description'] . '</td>
                            <td>
                                <a href="#" title="View Details" class="text-success infoBtn" id="' . $row['category_id'] . '"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Edit Details" class="text-primary editBtn" data-toggle="modal" data-target="#editCategoryModal" id="' . $row['category_id'] . '"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Delete" class="text-danger delBtn" id="' . $row['category_id'] . '"><i class="fas fa-trash-alt fa-lg"></i></a>
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




//add category from admin
if (isset($_POST['action']) && $_POST['action'] == "addNewCategory") {
    if (!empty($_POST['name']) && !empty($_POST['description'])) {
        $name = check_input($_POST["name"]);
        $description = check_input($_POST["description"]);
        $date = date('Y-m-d H:i:s');

        if (strlen($name) > 3) {


            $usernameExists = "SELECT * FROM categories WHERE name = ?";
            $stmt1 = $conn->prepare($usernameExists);
            $stmt1->bind_param("s", $name);
            $stmt1->execute();
            $returnedCategory = $stmt1->get_result()->fetch_assoc();




            if ($returnedCategory) {
                //Category exists in the database
                echo '200';
            } else {

                $sql = "INSERT categories (name,description,created_at) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $name, $description, $date);
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




//edit category from admin
if (isset($_POST['action']) && $_POST['action'] == "UpdateCategory") {
    if (!empty($_POST['name']) && !empty($_POST['description'])) {
        $id = $_POST["category_id"];
        $name = check_input($_POST["name"]);
        $description = check_input($_POST["description"]);

        if (strlen($name) > 3) {


            $usernameExists = "SELECT * FROM categories WHERE name = ?";
            $stmt1 = $conn->prepare($usernameExists);
            $stmt1->bind_param("s", $name);
            $stmt1->execute();
            $returnedCategory = $stmt1->get_result()->fetch_assoc();




            if ($returnedCategory && $returnedCategory['category_id'] != $id) {
                //Category exists in the database
                echo '200';
            } else {

                
                $sql = "UPDATE categories SET name = ?, description = ? WHERE category_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssi", $name, $description, $id);
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


    $editCategoryQuery = "SELECT * FROM categories WHERE category_id = ? LIMIT 1";
    $editCategory = $conn->prepare($editCategoryQuery);
    $editCategory->bind_param("i", $id);
    $editCategory->execute();
    $editCategoryResult = $editCategory->get_result()->fetch_assoc();
    echo json_encode($editCategoryResult);
}





//view user on button click
if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];

    $viewCategoryQuery = "SELECT * FROM categories WHERE category_id = ? LIMIT 1";
    $viewCategory = $conn->prepare($viewCategoryQuery);
    $viewCategory->bind_param("i", $id);
    $viewCategory->execute();
    $viewCategoryResult = $viewCategory->get_result()->fetch_assoc();
    echo json_encode($viewCategoryResult);
}





if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];

    $delCategoryQuery = "DELETE FROM `categories` WHERE category_id = ?";
    $delCategory = $conn->prepare($delCategoryQuery);
    $delCategory->bind_param("i", $id);
    $delCategory->execute();

    if ($delCategory) {
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