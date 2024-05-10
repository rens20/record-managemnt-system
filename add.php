<?php
require_once __DIR__ . '../config/configuration.php'; // Corrected the path for configuration.php
require_once __DIR__ . '../config/validation.php'; // Corrected the path for validation.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $billing = $_POST['billing'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];

    // Prepare the SQL statement using placeholders to avoid SQL injection
    $sql = "INSERT INTO users (name, billing, contact, age, sex) VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind parameters to the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $name, $billing, $contact, $age, $sex);

    if ($stmt->execute()) {
     // Success message or actions
    echo "<script>confirmSubmit();</script>";
    } else { 
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.1/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    
</style>
<body>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <!-- <h2 class="text-2xl font-bold mb-4">Add User</h2> -->
            <form   method="post" onsubmit="return confirmSubmit()">
               <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" required id="name" name="name" placeholder="Enter name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="telephone" class="block text-sm font-medium text-gray-700">Billing</label>
                    <input type="number" required id="billing" name="billing" placeholder="Enter the billing " class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                    <input type="text"  required  id="contact" name="contact" placeholder="Enter contact" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number"  required  id="age" name="age" placeholder="Enter age" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                    <select id="sex"  required  name="sex" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
               <button type="submit" id="save" class=" w-full py-2 px-4 text-white bg-green-600 rounded-md focus:outline-none focus:ring-opacity-50">Save</button>
               <br>
              
            </form>
            <br>
             <button type="submit" onclick="goToNextPage()" id="save" class=" w-full py-2 px-4 text-white bg-green-600 rounded-md focus:outline-none focus:ring-opacity-50">Back</button>
        
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.1/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
             function goToNextPage() {
        window.location.href = 'admin.php'; // Replace 'next_page.php' with the actual URL of the next page you want to go to
    }
            </script>
    
</body>

</html>
