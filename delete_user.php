<?php
require_once __DIR__ . '/config/configuration.php'; // Include your database connection file

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL statement to delete the user
    $sql = "DELETE FROM users WHERE id = ?";

    // Prepare and bind parameter to the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // User deleted successfully, redirect back to admin.php
        header("Location: admin.php");
        exit();
    } else {
        // Error in deletion
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Invalid or missing user ID
    echo "Invalid user ID.";
}

// Close the connection
$conn->close();
?>
