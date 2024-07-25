<?php include '../admin/database/db.php'; 

if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_role'])) {
    header('location: ' . '../');
    exit();
}elseif (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] != 'normal_member') {
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Bootstrap Admin Templates" />
	<meta name="keywords"
		content="Admin, Dashboard, Bootstrap4, Sass, CSS3, HTML5, Responsive Dashboard, Responsive Admin Template, Admin Template, Best Admin Template, Bootstrap Template, Themeforest" />
	<meta name="author" content="Bootstrap Gallery" />
	<link rel="canonical" href="https://www.bootstrap.gallery/" />
	<meta property="og:url" content="https://www.bootstrap.gallery" />
	<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery" />
	<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards" />
	<meta property="og:type" content="Website" />
	<meta property="og:site_name" content="Bootstrap Gallery" />
	<link rel="shortcut icon" href="../admin/uploads/<?= $settings['logo'] ?>" />
	<title><?= $settings['title'] ?></title>

	<!-- Common CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="fonts/icomoon/icomoon.css" />
	<link rel="stylesheet" href="css/main.min.css" />

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

	<!-- BEGIN .app-wrap -->
	<div class="app-wrap">
		<!-- BEGIN .app-container -->
		<div class="app-container">