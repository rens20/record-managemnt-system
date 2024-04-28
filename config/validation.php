<?php
function ValidateLogin($username, $email, $password, $confirm) {
      require_once __DIR__ . '/configuration.php';
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize user inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $confirm = mysqli_real_escape_string($conn, $confirm);

    // Use prepared statement to avoid SQL injection
    $sql = "SELECT * FROM admin WHERE email = ? AND password = ? AND username = ? AND confirm = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("ssss", $email, $password, $username, $confirm);
    
    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    
    // Fetch the row
    $row = $result->fetch_assoc();

    // Close statement and connection
    $stmt->close();
    mysqli_close($conn);

    return $row;
}
