<?php
//include database configuration file
include_once '../../database/db.php';

$errors = array();


if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = '';
    $usersView = "SELECT * FROM users";
    $stmt8 = $conn->prepare($usersView);
    $stmt8->execute();
    $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);

    if ($data) {
        $output .= '<table class="table table-stripped table-sm table-bordered text-body">
                        <thead>
                            <tr class="text-center">
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>                                           
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
            $output .= '<tr class="text-center text-body">
                            <td><img class="rounded-circle" width="50px" height="50px" src="./uploads/' . $row['image'] . '"></td>
                            <td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $row['user_role'] . '</td>
                            <td>
                                <a href="#" title="View Details" class="text-success infoBtn" id="' . $row['user_id'] . '"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Edit Details" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="' . $row['user_id'] . '"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                                <a href="#" title="Delete" class="text-danger delBtn" id="' . $row['user_id'] . '"><i class="fas fa-trash-alt fa-lg"></i></a>
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

if (isset($_POST['action']) && $_POST['action'] == "insert") {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_FILES['image']['name'])) {
        $firstname = check_input($_POST["firstname"]);
        $lastname = check_input($_POST["lastname"]);
        $username = check_input($_POST["username"]);
        $password = check_input($_POST["password"]);
        $confirmpassword = check_input($_POST["confirmpassword"]);
        $email = check_input($_POST["email"]);
        $phone = check_input($_POST["phone"]);

        $password = sha1($password);
        $confirmpassword = sha1($confirmpassword);

        $date = date('Y-m-d H:i:s');
        if (strlen($username) > 5) {

            if (strlen($password) > 5  && strlen($confirmpassword) > 5 && $password == $confirmpassword) {
                $usernameExists = "SELECT * FROM users WHERE username = ?";
                $stmt1 = $conn->prepare($usernameExists);
                $stmt1->bind_param("s", $username);
                $stmt1->execute();
                $returnedUser = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC);


                $usernameExists1 = "SELECT * FROM users WHERE email = ?";
                $stmt2 = $conn->prepare($usernameExists1);
                $stmt2->bind_param("s", $email);
                $stmt2->execute();
                $returnedUser1 = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);

                $usernameExists2 = "SELECT * FROM users WHERE phone = ?";
                $stmt3 = $conn->prepare($usernameExists2);
                $stmt3->bind_param("s", $phone);
                $stmt3->execute();
                $returnedUser2 = $stmt3->get_result()->fetch_all(MYSQLI_ASSOC);

                if ($returnedUser || $returnedUser1 || $returnedUser2) {
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
                                $sql = "INSERT users (firstname,lastname,username,password,email,phone,image,created_at) VALUES (?,?,?,?,?,?,?,?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ssssssss", $firstname, $lastname, $username, $password, $email, $phone, $file_name, $date);
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

                //passwords do not match
                echo '100';
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

//add user from admin
if (isset($_POST['action']) && $_POST['action'] == "addNewUser") {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_FILES['image']['name']) && !empty($_POST['user_role'])) {
        $firstname = check_input($_POST["firstname"]);
        $lastname = check_input($_POST["lastname"]);
        $username = check_input($_POST["username"]);
        $password = check_input($_POST["password"]);
        $confirmpassword = check_input($_POST["confirmpassword"]);
        $email = check_input($_POST["email"]);
        $phone = check_input($_POST["phone"]);
        $user_role = check_input($_POST["user_role"]);

        $password = sha1($password);
        $confirmpassword = sha1($confirmpassword);

        $date = date('Y-m-d H:i:s');

        if (strlen($username) > 5) {

            if (strlen($password) > 5  && strlen($confirmpassword) > 5 && $password == $confirmpassword) {
                $usernameExists = "SELECT * FROM users WHERE username = ?";
                $stmt1 = $conn->prepare($usernameExists);
                $stmt1->bind_param("s", $username);
                $stmt1->execute();
                $returnedUser = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC);


                $usernameExists1 = "SELECT * FROM users WHERE email = ?";
                $stmt2 = $conn->prepare($usernameExists1);
                $stmt2->bind_param("s", $email);
                $stmt2->execute();
                $returnedUser1 = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);

                $usernameExists2 = "SELECT * FROM users WHERE phone = ?";
                $stmt3 = $conn->prepare($usernameExists2);
                $stmt3->bind_param("s", $phone);
                $stmt3->execute();
                $returnedUser2 = $stmt3->get_result()->fetch_all(MYSQLI_ASSOC);

                if ($returnedUser || $returnedUser1 || $returnedUser2) {
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
                                $sql = "INSERT users (firstname,lastname,username,password,email,phone,user_role,image,created_at) VALUES (?,?,?,?,?,?,?,?,?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("sssssssss", $firstname, $lastname, $username, $password, $email, $phone, $user_role, $file_name, $date);
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
                //passwords do not match
                echo '100';
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



//login logic
if (isset($_POST['action']) && $_POST['action'] == "loginUser") {
    if (!empty($_POST['loginID']) || !empty($_POST['password'])) {
        $loginID = check_input($_POST["loginID"]);
        $password = check_input($_POST["password"]);

        $password = sha1($password);

        $usernameExists = "SELECT * FROM users WHERE username = ? OR email = ? OR phone = ? LIMIT 1";
        $stmt1 = $conn->prepare($usernameExists);
        $stmt1->bind_param("sss", $loginID, $loginID, $loginID);
        $stmt1->execute();
        $returnedUser = $stmt1->get_result()->fetch_assoc();

        if ($returnedUser && $password == $returnedUser['password']) {


            $_SESSION['user_id'] = $returnedUser['user_id'];
            $_SESSION['username'] = $returnedUser['username'];

            if ($returnedUser['user_role'] == 'normal_member') {
                $_SESSION['user_role'] = 'normal_member';
                echo 'r1';
            } elseif ($returnedUser['user_role'] == 'vendor_member') {
                $_SESSION['user_role'] = 'vendor_member';
                echo 'r2';
            } elseif ($returnedUser['user_role'] == 'planner_member') {
                $_SESSION['user_role'] = 'planner_member';
                echo 'r3';
            } elseif ($returnedUser['user_role'] == 'admin_member') {
                $_SESSION['user_role'] = 'admin_member';
                echo 'r4';
            } elseif ($returnedUser['user_role'] == 'super_admin_member') {
                $_SESSION['user_role'] = 'super_admin_member';
                echo 'r5';
            }
        } else {
            //Invalid Credentials
            echo '100';
        }
    } else {
        //You must fill all fields
        echo '200';
    }
}


//edit user from admin
if (isset($_POST['action']) && $_POST['action'] == "UpdateUser") {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_FILES['image']['name']) && !empty($_POST['user_role'])) {
        $id = $_POST["user_id"];
        $firstname = check_input($_POST["firstname"]);
        $lastname = check_input($_POST["lastname"]);
        $username = check_input($_POST["username"]);
        $password = check_input($_POST["password"]);
        $confirmpassword = check_input($_POST["confirmpassword"]);
        $email = check_input($_POST["email"]);
        $phone = check_input($_POST["phone"]);
        $user_role = check_input($_POST["user_role"]);

        $password = sha1($password);
        $confirmpassword = sha1($confirmpassword);

        if (strlen($username) > 5) {

            if (strlen($password) > 5  && strlen($confirmpassword) > 5 && $password == $confirmpassword) {
                $sql = "SELECT * FROM users WHERE username = '" . $username . "' LIMIT 1";
                $result = $conn->query($sql);
                $returnedUser = $result->fetch_assoc();

                $sql1 = "SELECT * FROM users WHERE email = '" . $email . "' LIMIT 1";
                $result1 = $conn->query($sql1);
                $returnedUser1 = $result1->fetch_assoc();

                $sql2 = "SELECT * FROM users WHERE phone = '" . $phone . "' LIMIT 1";
                $result2 = $conn->query($sql2);
                $returnedUser2 = $result2->fetch_assoc();

                if ($returnedUser && $returnedUser['user_id'] != $id) {
                    //User exists in the database
                    echo '200';
                } elseif ($returnedUser1 && $returnedUser1['user_id'] != $id) {
                    //User exists in the database
                    echo '200';
                } elseif ($returnedUser2 && $returnedUser2['user_id'] != $id) {
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
                            $imgSql = "SELECT * FROM users WHERE user_id = '" . $id . "' LIMIT 1";
                            $resultImg = $conn->query($imgSql);
                            $resultImg1 = $resultImg->fetch_assoc();


                            $file1 = $resultImg1['image'];
                            $path1 = ('../../uploads/') . $file1;


                            if (file_exists($path1)) {
                                unlink($path1);
                            }
                            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                            if ($result) {

                                $sqlnnn = "UPDATE users SET `firstname` = '" . $firstname . "', `lastname` = '" . $lastname . "', `username` = '" . $username . "', `email` = '" . $email . "', `phone` = '" . $phone . "', `user_role` = '" . $user_role . "', `password` = '" . $password . "', `image` = '" . $file_name . "' WHERE `user_id` = '" . $id . "'";
                                $insertn = $conn->query($sqlnnn);



                                if ($insertn === TRUE) {
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
                //passwords do not match
                echo '100';
            }
        } else {
            //username must be more than five characters
            echo "900";
        }
    } elseif (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['user_role'])) {
        $id = $_POST["user_id"];
        $firstname = check_input($_POST["firstname"]);
        $lastname = check_input($_POST["lastname"]);
        $username = check_input($_POST["username"]);
        $password = check_input($_POST["password"]);
        $confirmpassword = check_input($_POST["confirmpassword"]);
        $email = check_input($_POST["email"]);
        $phone = check_input($_POST["phone"]);
        $user_role = check_input($_POST["user_role"]);

        $password = sha1($password);
        $confirmpassword = sha1($confirmpassword);

        if (strlen($username) > 5) {

            if (strlen($password) > 5  && strlen($confirmpassword) > 5 && $password == $confirmpassword) {
                $sql = "SELECT * FROM users WHERE username = '" . $username . "' LIMIT 1";
                $result = $conn->query($sql);
                $returnedUser = $result->fetch_assoc();

                $sql1 = "SELECT * FROM users WHERE email = '" . $email . "' LIMIT 1";
                $result1 = $conn->query($sql1);
                $returnedUser1 = $result1->fetch_assoc();

                $sql2 = "SELECT * FROM users WHERE phone = '" . $phone . "' LIMIT 1";
                $result2 = $conn->query($sql2);
                $returnedUser2 = $result2->fetch_assoc();

                if ($returnedUser && $returnedUser['user_id'] != $id) {
                    //User exists in the database
                    echo '200';
                } elseif ($returnedUser1 && $returnedUser1['user_id'] != $id) {
                    //User exists in the database
                    echo '200';
                } elseif ($returnedUser2 && $returnedUser2['user_id'] != $id) {
                    //User exists in the database
                    echo '200';
                } else {
                    $sqlnnn = "UPDATE users SET `firstname` = '" . $firstname . "', `lastname` = '" . $lastname . "', `username` = '" . $username . "', `email` = '" . $email . "', `phone` = '" . $phone . "', `user_role` = '" . $user_role . "', `password` = '" . $password . "' WHERE `user_id` = '" . $id . "'";
                    $insertn = $conn->query($sqlnnn);




                    if ($insertn === TRUE) {
                        //success
                        echo '300';
                    } else {
                        //failed
                        echo '400';
                    }
                }
            } else {
                //passwords do not match
                echo '100';
            }
        } else {
            //username must be more than five characters
            echo "900";
        }
    } elseif (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_FILES['image']['name']) && !empty($_POST['user_role'])) {
        $id = $_POST["user_id"];
        $firstname = check_input($_POST["firstname"]);
        $lastname = check_input($_POST["lastname"]);
        $username = check_input($_POST["username"]);
        $email = check_input($_POST["email"]);
        $phone = check_input($_POST["phone"]);
        $user_role = check_input($_POST["user_role"]);

        if (strlen($username) > 5) {
            $sql = "SELECT * FROM users WHERE username = '" . $username . "' LIMIT 1";
            $result = $conn->query($sql);
            $returnedUser = $result->fetch_assoc();

            $sql1 = "SELECT * FROM users WHERE email = '" . $email . "' LIMIT 1";
            $result1 = $conn->query($sql1);
            $returnedUser1 = $result1->fetch_assoc();

            $sql2 = "SELECT * FROM users WHERE phone = '" . $phone . "' LIMIT 1";
            $result2 = $conn->query($sql2);
            $returnedUser2 = $result2->fetch_assoc();

            if ($returnedUser && $returnedUser['user_id'] != $id) {
                //User exists in the database
                echo '200';
            } elseif ($returnedUser1 && $returnedUser1['user_id'] != $id) {
                //User exists in the database
                echo '200';
            } elseif ($returnedUser2 && $returnedUser2['user_id'] != $id) {
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
                        $imgSql = "SELECT * FROM users WHERE user_id = '" . $id . "' LIMIT 1";
                        $resultImg = $conn->query($imgSql);
                        $resultImg1 = $resultImg->fetch_assoc();


                        $file1 = $resultImg1['image'];
                        $path1 = ('../../uploads/') . $file1;


                        if (file_exists($path1)) {
                            unlink($path1);
                        }
                        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                        if ($result) {
                            $sqlnnn = "UPDATE users SET `firstname` = '" . $firstname . "', `lastname` = '" . $lastname . "', `username` = '" . $username . "', `email` = '" . $email . "', `phone` = '" . $phone . "', `user_role` = '" . $user_role . "', `image` = '" . $file_name . "' WHERE `user_id` = '" . $id . "'";
                            $insertn = $conn->query($sqlnnn);



                            if ($insertn === TRUE) {
                                //succes
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
    } elseif (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['user_role'])) {
        $id = $_POST["user_id"];
        $firstname = check_input($_POST["firstname"]);
        $lastname = check_input($_POST["lastname"]);
        $username = check_input($_POST["username"]);
        $email = check_input($_POST["email"]);
        $phone = check_input($_POST["phone"]);
        $user_role = check_input($_POST["user_role"]);

        if (strlen($username) > 5) {

            $sql = "SELECT * FROM users WHERE username = '" . $username . "' LIMIT 1";
            $result = $conn->query($sql);
            $returnedUser = $result->fetch_assoc();

            $sql1 = "SELECT * FROM users WHERE email = '" . $email . "' LIMIT 1";
            $result1 = $conn->query($sql1);
            $returnedUser1 = $result1->fetch_assoc();

            $sql2 = "SELECT * FROM users WHERE phone = '" . $phone . "' LIMIT 1";
            $result2 = $conn->query($sql2);
            $returnedUser2 = $result2->fetch_assoc();

            if ($returnedUser && $returnedUser['user_id'] != $id) {
                //User exists in the database
                echo '200';
            } elseif ($returnedUser1 && $returnedUser1['user_id'] != $id) {
                //User exists in the database
                echo '200';
            } elseif ($returnedUser2 && $returnedUser2['user_id'] != $id) {
                //User exists in the database
                echo '200';
            } else {


                $sqlnnn = "UPDATE users SET `firstname` = '" . $firstname . "', `lastname` = '" . $lastname . "', `username` = '" . $username . "', `email` = '" . $email . "', `phone` = '" . $phone . "', `user_role` = '" . $user_role . "' WHERE `user_id` = '" . $id . "'";
                $insertn = $conn->query($sqlnnn);

                if ($insertn === TRUE) {
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
        //You must fill all fields except image and password fields
        echo '700';
    }
}

//edit user section
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];

    $editUserQuery = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
    $editUser = $conn->prepare($editUserQuery);
    $editUser->bind_param("i", $id);
    $editUser->execute();
    $editUserResult = $editUser->get_result()->fetch_assoc();
    echo json_encode($editUserResult);
}



//view user on button click
if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];

    $viewUserQuery = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
    $viewUser = $conn->prepare($viewUserQuery);
    $viewUser->bind_param("i", $id);
    $viewUser->execute();
    $viewUserResult = $viewUser->get_result()->fetch_assoc();
    echo json_encode($viewUserResult);
}





if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];
    $imgSql = "SELECT * FROM users WHERE user_id = '" . $id . "' LIMIT 1";
    $resultImg = $conn->query($imgSql);
    $resultImg1 = $resultImg->fetch_assoc();


    $file1 = $resultImg1['image'];
    $path1 = ('../../uploads/') . $file1;


    if (file_exists($path1)) {
        unlink($path1);
    }

    $delUserQuery = "DELETE FROM `users` WHERE user_id = ?";
    $delUser = $conn->prepare($delUserQuery);
    $delUser->bind_param("i", $id);
    $delUser->execute();

    if ($delUser) {
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
