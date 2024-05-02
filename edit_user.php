<?php
require_once __DIR__ . '/config/configuration.php'; // Include your database connection file

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the user data from the database based on the ID
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Display the edit form with pre-filled data
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
            <div class="container mx-auto py-8">
                <h1 class="text-3xl font-bold mb-4">Edit User</h1>
                <form action="update_user.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                        <input type="text" id="contact" name="contact" value="<?php echo $user['contact']; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                        <input type="number" id="age" name="age" value="<?php echo $user['age']; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                        <select id="sex" name="sex" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="Male" <?php echo ($user['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($user['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                            <option value="Other" <?php echo ($user['sex'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full py-2 px-4 text-white bg-green-600 rounded-md focus:outline-none focus:ring-opacity-50">Update</button>
                </form>
            </div>
        </body>

        </html>
        <?php
    } else {
        echo "User not found.";
    }

    $stmt->close();
} else {
    echo "Invalid user ID.";
}

$conn->close();
?>
