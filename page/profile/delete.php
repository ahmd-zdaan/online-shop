<?php
include_once 'config/connect.php';

$user_id = $_GET['user_id'];

$query = "DELETE FROM user WHERE user_id=" . $user_id;

if (mysqli_query($connect, $query)) {
    log_out();
}