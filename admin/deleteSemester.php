<?php
include("../database.php");


if (isset($_GET['id'])) {
    
    $semesterId = $_GET['id'];
    $query = "DELETE FROM semesters WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $semesterId);
    if ($statement->execute()) {
        header("Location:semester.php");
        exit();
    } else {
        echo "Error: Unable to delete the semester.";
    }

    // Close the prepared statement
    $statement->close();
}

// Close the database connection
$conn->close();
?>