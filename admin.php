<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<style>
button{
    background: #020617;
}
    </style>
<body>
    <div class="container mx-auto py-8">
            <header class="bg-green-600 text-white py-4 rounded">
        <div class="container mx-auto flex justify-between items-center px-4">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="/image/logo.jpg" alt="Logo" class=" w-12 rounded-full mr-10">
                <span class="text-xl font-bold">EJS Memorial Services</span>
            </div>
            <!-- Buttons -->
            <div class="flex space-x-4">
                <button  class="bg-slate-950  text-white py-2 px-4 rounded-md focus:outline-none "  onclick="goToNextPage1()">Add</button>
                <button onclick="goToNextPage2()" class="bg-slate-950  text-white py-2 px-4 rounded-md focus:outline-none ">Report</button>
                <button onclick="goToNextPage4()" class="bg-slate-950  text-white py-2 px-4 rounded-md focus:outline-none ">Admin</button>
                <button onclick="goToNextPage5()" class="bg-slate-950   text-white py-2 px-4 rounded-md focus:outline-none ">Log out</button>

            </div>
        </div>
    </header>
      
        <div class="bg-white p-8 rounded-lg shadow-md">
           
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Contact</th>
                        <th class="px-4 py-2">Age</th>
                        <th class="px-4 py-2">Sex</th>
                        <th class="px-4 py-2">Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once __DIR__ . '/config/configuration.php'; // Include your database connection file
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='border px-4 py-2'>" . $row['name'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row['email'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row['contact'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row['age'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row['sex'] . "</td>";
                            echo "<td class='border px-4 py-2'>";
                            echo "<a href='edit_user.php?id=" . $row['id'] . "' class='text-blue-500 hover:underline'>Edit</a> | ";
                            echo "<a href='delete_user.php?id=" . $row['id'] . "' class='text-red-500 hover:underline'>Delete</a>";
                            echo "</td>"; // Edit and Delete buttons
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No data available</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
    
  function goToNextPage1() {
    window.location.href = 'add.php';
  }

  function goToNextPage2() {
    window.location.href = 'report.php';
  }


  function goToNextPage4() {
    window.location.href = 'admin.php';
  }

  function  goToNextPage5() {
    window.location.href = 'index.php';
  }
 

    </script>

</body>

</html>

