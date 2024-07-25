<?php
include './database/db.php';

if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_role'])) {
    header('location: ' . '../');
    exit();
}elseif (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 'super_admin_member' || $_SESSION['user_role'] == 'admin_member') {
        //do nothing
    }else{
        header('location: ' . '../');
        exit();
    }
}

$id = $_SESSION['user_id'];
$userQuery = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
$user = $conn->prepare($userQuery);
$user->bind_param("i", $id);
$user->execute();
$userResult = $user->get_result()->fetch_assoc();


$setting_id = 1;
$settingQuery = "SELECT * FROM settings WHERE setting_id = ? LIMIT 1";
$setting = $conn->prepare($settingQuery);
$setting->bind_param("i", $setting_id);
$setting->execute();
$settings = $setting->get_result()->fetch_assoc();

function prepare_sql($sql)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result();
    return $records;
}


$sql1_row = "SELECT * FROM events";
$row1_record = prepare_sql($sql1_row);
$nr1_of_rows = $row1_record->num_rows; 

$sql2_row = "SELECT * FROM users";
$row2_record = prepare_sql($sql2_row);
$nr2_of_rows = $row2_record->num_rows;

$sql3_row = "SELECT * FROM services";
$row3_record = prepare_sql($sql3_row);
$nr3_of_rows = $row3_record->num_rows;

$sql4_row = "SELECT * FROM rsvp";
$row4_record = prepare_sql($sql4_row);
$nr4_of_rows = $row4_record->num_rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Cache-control" content="no-cache">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Bootstrap Admin Templates" />
	<meta name="keywords" content="Admin, Dashboard, Bootstrap4, Sass, CSS3, HTML5, Responsive Dashboard, Responsive Admin Template, Admin Template, Best Admin Template, Bootstrap Template, Themeforest" />
	<meta name="author" content="Bootstrap Gallery" />
	<link rel="canonical" href="https://www.bootstrap.gallery/" />
	<meta property="og:url" content="https://www.bootstrap.gallery" />
	<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery" />
	<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards" />
	<meta property="og:type" content="Website" />
	<meta property="og:site_name" content="Bootstrap Gallery" />
	<link rel="shortcut icon" href="./uploads/<?= $settings['logo'] ?>" />
	<title><?= $settings['title'] ?></title>

	<!-- Common CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="fonts/icomoon/icomoon.css" />
	<link rel="stylesheet" href="css/main.min.css" />
    <link rel="stylesheet" href="css/custom.css">

	<!-- Other CSS includes plugins - Cleanedup unnecessary CSS -->
	<!-- Chartist css -->
	<link href="vendor/chartist/css/chartist.min.css" rel="stylesheet" />
	<link href="vendor/chartist/css/chartist-custom.css" rel="stylesheet" />
</head>

<body>
	<!-- Loading starts -->
	<div class="loading-wrapper">
		<div class="loading">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<!-- Loading ends -->