<?php
include("../database.php");


if (isset($_GET['id'])) {
    
    $registrationId = $_GET['id'];
    $query = "DELETE FROM registrations WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $registrationId);
    if ($statement->execute()) {
        header("Location:registration.php");
        exit();
    } else {
        echo "Error: Unable to delete the registration.";
    }

    $statement->close();
}


?>