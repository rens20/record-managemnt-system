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
 .btn {
            background: #16a34a;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .btn:hover {
            background: #166534;
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
                    <h1 class="text-center font-bold mb-9 text-3xl">Daily</h1>
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
                     <button class="btn"  onclick="window.print()">Print Daily Table</button>
                    <?php
               require_once __DIR__ . '/config/configuration.php';

// Query for daily data
$sql_daily = "SELECT * FROM users";
$result_daily = $conn->query($sql_daily);

// Process daily data
if ($result_daily->num_rows > 0) {
    while ($row_daily = $result_daily->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='border px-4 py-2'>" . $row_daily['name'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_daily['email'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_daily['contact'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_daily['age'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_daily['sex'] . "</td>";
                            echo "<td class='border px-4 py-2'>";
                            echo "<a href='edit_user.php?id=" . $row_daily['id'] . "' class='text-blue-500 hover:underline'>Edit</a> ";
                          
                            echo "</td>"; // Edit and Delete buttons
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No data available</td></tr>";
                    }
                  
                    ?>
                </tbody>
            </table>
             <!-- Weekly Table -->
            <table class="table-auto w-full">
                <thead>
                    <h1 class="text-center font-bold mb-3 text-3xl">Weekly</h1>
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
                    // Modify the SQL query to fetch weekly data
                      require_once __DIR__ . '/config/configuration.php';
                    $sql_weekly = "SELECT * FROM users";
                    $result_weekly = $conn->query($sql_weekly);

                    if ($result_weekly->num_rows > 0) {
                        while ($row_weekly = $result_weekly->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='border px-4 py-2'>" . $row_weekly['name'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_weekly['email'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_weekly['contact'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_weekly['age'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_weekly['sex'] . "</td>";
                            echo "<td class='border px-4 py-2'>";
                            echo "<a href='edit_weekly_user.php?id=" . $row_weekly['id'] . "' class='text-blue-500 hover:underline'>Edit</a> | ";

                            echo "</td>"; // Edit and Delete buttons
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No data available</td></tr>";
                    }
                
                    ?>
                </tbody>
            </table>
            <!-- montly -->
             <table class="table-auto w-full">
                <thead>
                    <h1 class="text-center font-bold mb-3 text-3xl">Monthly</h1>
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
                      <button class="btn"  onclick="window.print()">Print Weekly Table</button>
                    <?php
                    // Modify the SQL query to fetch weekly data
                      require_once __DIR__ . '/config/configuration.php';
                    $sql_monthly = "SELECT * FROM users";
                    $result_monthly = $conn->query($sql_monthly);

                    if ($result_weekly->num_rows > 0) {
                        while ($row_monthly = $result_monthly->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='border px-4 py-2'>" . $row_monthly['name'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_monthly['email'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_monthly['contact'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_monthly['age'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_monthly['sex'] . "</td>";
                            echo "<td class='border px-4 py-2'>";
                            echo "<a href='edit_weekly_user.php?id=" . $row_monthly['id'] . "' class='text-blue-500 hover:underline'>Edit</a>  ";

                            echo "</td>"; // Edit and Delete buttons
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No data available</td></tr>";
                    }
                  
                    ?>
                </tbody>
            </table>
            

            <!-- yearly -->

             <table class="table-auto w-full">
                <thead>
                    <h1 class="text-center font-bold mb-3 text-3xl">Yearly</h1>
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
                                <button class="btn"  onclick="window.print()">Print Monthly Table</button>
                    <?php
                    // Modify the SQL query to fetch weekly data
                      require_once __DIR__ . '/config/configuration.php';
                    $sql_yearly = "SELECT * FROM users";
                    $result_yearly = $conn->query($sql_yearly);

                    if ($result_weekly->num_rows > 0) {
                        while ($row_yearly = $result_yearly->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='border px-4 py-2'>" . $row_yearly['name'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_yearly['email'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_yearly['contact'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_yearly['age'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row_yearly['sex'] . "</td>";
                            echo "<td class='border px-4 py-2'>";
                            echo "<a href='edit_weekly_user.php?id=" . $row_yearly['id'] . "' class='text-blue-500 hover:underline'>Edit</a> ";
                           
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
              <button class="btn" onclick="window.print()">Print Yearly Table</button>
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
   function printTable(tableId) {
            var printContents = document.getElementById(tableId).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

    </script>

</body>

</html>