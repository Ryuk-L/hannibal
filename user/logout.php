<?php
session_start();
include("../database.php");

$id= $_SESSION['user']['id'];
$query = "UPDATE registrations SET logout_date = NOW() WHERE id = ?";
$statement = $conn->prepare($query);
$statement->bind_param("s", $id);
$statement->execute();
session_destroy();
header("location:/project_stage/User/loginUser.php");
?>