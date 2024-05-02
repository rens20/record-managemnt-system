<?php
require_once __DIR__ . '/config/configuration.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];

    // Prepare the SQL statement to update the user data
    $sql = "UPDATE users SET name = ?, email = ?, contact = ?, age = ?, sex = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $email, $contact, $age, $sex, $id);

    if ($stmt->execute()) {

        header("Location: admin.php");
        exit();
    } else {
     
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    $stmt->close();
} else {
  
    header("Location: admin.php");
    exit();
}

$conn->close();
?>
