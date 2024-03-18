<?php
include("../database.php");


if (isset($_GET['id'])) {
    
    $departmentId = $_GET['id'];
    $query = "DELETE FROM departments WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $departmentId);
    if ($statement->execute()) {
        header("Location:department.php");
        exit();
    } else {
        echo "Error: Unable to delete the department.";
    }

    // Close the prepared statement
    $statement->close();
}

// Close the database connection
$conn->close();
?>