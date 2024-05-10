<?php
  require_once __DIR__ . '/configuration.php';
function ValidateLogin($email, $password, $username, $confirm) {

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $username = mysqli_real_escape_string($conn, $username);
    $confirm = mysqli_real_escape_string($conn, $confirm);

    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password' AND username = '$username' AND confirm = '$confirm'";
    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_fetch_assoc($result);

    mysqli_close($conn);

    return $row;
}
?>
