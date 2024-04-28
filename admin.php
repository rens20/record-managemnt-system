<?php
require_once __DIR__ . '../config/configuration.php';
require_once __DIR__ . '../config/validation.php';


// Check if the 'updated' parameter is set and display a success message
if (isset($_GET['updated']) && $_GET['updated'] === 'true') {
    echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">';
    echo '<strong class="font-bold">Success!</strong>';
    echo '<span class="block sm:inline"> User updated successfully.</span>';
    echo '</div>';
}

// Check if delete action is triggered
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the record from the database
    $deleteSql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Redirect back to admin.php after successful delete
        header('Location: admin.php');
        exit;
    } else {
        echo '<script>alert("Error deleting record!");</script>';
    }
}

// Fetch user data from database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    echo '
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Data</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-4">User Data</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sex</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
    ';

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">' . $row["id"] . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $row["name"] . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $row["email"] . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $row["contact"] . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $row["age"] . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $row["sex"] . '</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <button onclick="deleteUser(' . $row["id"] . ')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                </td>
            </tr>
        ';
    }

    echo '
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            function deleteUser(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this record!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "admin.php?action=delete&id=" + id;
                    }
                });
            }
        </script>
    </body>

    </html>
    ';
} else {
    echo "No users found.";
}

$conn->close();
?>
