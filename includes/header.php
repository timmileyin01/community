<?php include './admin/database/db.php'; 

if (isset($_SESSION['user_id'])) {
    # code...
    $id = $_SESSION['user_id'];
    $userQuery = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
    $user = $conn->prepare($userQuery);
    $user->bind_param("i", $id);
    $user->execute();
    $userResult = $user->get_result()->fetch_assoc();
}

$setting_id = 1;
$settingQuery = "SELECT * FROM settings WHERE setting_id = ? LIMIT 1";
$setting = $conn->prepare($settingQuery);
$setting->bind_param("i", $setting_id);
$setting->execute();
$settings = $setting->get_result()->fetch_assoc();



?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-control" content="no-cache">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">

    <title><?= $settings['title'] ?></title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">