<?php
require_once __DIR__ . '/config/configuration.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $billing = $_POST['billing'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];

    // Prepare the SQL statement to update the user data
    $sql = "UPDATE users SET name = ?, billing = ?, contact = ?, age = ?, sex = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $billing, $contact, $age, $sex, $id);

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
