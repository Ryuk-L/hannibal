<?php
include("../database.php");


if (isset($_GET['id'])) {
    
    $courseId = $_GET['id'];
    $query = "DELETE FROM courses WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $courseId);
    if ($statement->execute()) {
        header("Location:course.php");
        exit();
    } else {
        echo "Error: Unable to delete the course.";
    }

    $statement->close();
}

$conn->close();
?>