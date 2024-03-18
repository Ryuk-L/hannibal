<?php
session_start();
include_once("../database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        header("Location: loginAdmin.php?error=Please fill in all fields");
        exit();
    }

   
    $statement = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $statement->bind_param("ss", $username, $password);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["admin"] = $username;

        header("Location: change_password.php");
        exit();
    } else {
        header("Location: loginAdmin.php?error=Invalid username or password");
        exit();
    }

    $statement->close();
}
?>