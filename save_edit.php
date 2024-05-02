<?php
require_once __DIR__ . '../config/configuration.php';
require_once __DIR__ . '../config/validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];

    // Update user data in the database
    $updateSql = "UPDATE users SET name = ?, email = ?, contact = ?, age = ?, sex = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sssssi", $name, $email, $contact, $age, $sex, $id);

    if ($stmt->execute()) {
        echo '<script>
                Swal.fire({
                    title: "Success!",
                    text: "User data updated successfully.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "admin.php";
                });
              </script>';
        exit;
    } else {
        echo '<script>alert("Error updating user data!");</script>';
    }
}

$conn->close();
?>
