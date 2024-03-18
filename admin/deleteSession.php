<?php
include("../database.php");


if (isset($_GET['id'])) {
    
    $sessionId = $_GET['id'];


    $query = "DELETE FROM sessions WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $sessionId);
    if ($statement->execute()) {
        header("Location:session.php");
        exit();
    } else {
        echo "Error: Unable to delete the session.";
    }

    // Close the prepared statement
    $statement->close();
}

// Close the database connection
$conn->close();
?>