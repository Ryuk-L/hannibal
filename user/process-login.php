<?php
session_start();
include_once("../database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_no = $_POST["reg_no"];
    $password = $_POST["password"];


    if (empty($reg_no) || empty($password)) {
        header("Location: loginUser.php?error=Please fill in all fields");
        exit();
    }

   
    $statement = $conn->prepare("SELECT * FROM registrations WHERE reg_no = ? AND password = ?");
    $statement->bind_param("ss", $reg_no, $password);
    $statement->execute();
    $result = $statement->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["user"] = $row;

        $id= $_SESSION['user']['id'];
        $query = "UPDATE registrations SET login_date = NOW() WHERE id = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("s", $id);
        $statement->execute();


        header("Location: change_password.php");
        exit();
    } else {
        header("Location: loginUser.php?error=Invalid username or password");
        exit();
    }

    $statement->close();
}
?>