<?php
include "./admin/database/db.php";


unset($_SESSION['user_id'] );
unset($_SESSION['username']);
unset($_SESSION['user_role']);

session_destroy();

header('location: ' . "./index.php");