<?php
require_once __DIR__ . '../config/configuration.php';
require_once __DIR__ . '../config/validation.php';

// Check if form is submitted for updating user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];

    $sql = "UPDATE users SET name=?, email=?, contact=?, age=?, sex=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $email, $contact, $age, $sex, $id);

    if ($stmt->execute()) {
        // Redirect back to admin.php after successful update
        header('Location: admin.php?updated=true');
exit;

        exit;
    } else {
        echo '<script>alert("Error updating record!");</script>';
    }
}

// Fetch user data based on ID from query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $contact = $row['contact'];
        $age = $row['age'];
        $sex = $row['sex'];
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "User ID not specified.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">Edit User</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Billing</label>
                <input type="email" id="email" name="email" value="<?php echo $billing; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                <input type="text" id="contact" name="contact" value="<?php echo $contact; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                <input type="number" id="age" name="age" value="<?php echo $age; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                <select id="sex" name="sex" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="Male" <?php if ($sex == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($sex == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($sex == 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <button type="submit" class="w-full py-2 px-4 text-white bg-blue-500 rounded-md focus:outline-none focus:ring-opacity-50">Save Changes</button>
        </form>
    </div>
</body>

</html>
