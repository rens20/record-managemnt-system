<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<style>
    button {
        background: #020617;
    }

    .highlight {
        background-color: yellow;
    }
</style>

<body>
    <div class="container mx-auto py-8">
        <header class="bg-green-600 text-white py-4 rounded">
            <div class="container mx-auto flex justify-between items-center px-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="/image/logo.jpg" alt="Logo" class="w-12 rounded-full mr-10">
                    <span class="text-xl font-bold">EJS Memorial Services</span>
                </div>
                <!-- Buttons -->
                <div class="flex space-x-4">
                    <button class="bg-slate-950 text-white py-2 px-4 rounded-md focus:outline-none "
                        onclick="goToNextPage1()">Add</button>
                    <button onclick="goToNextPage2()" class="bg-slate-950 text-white py-2 px-4 rounded-md focus:outline-none ">
                        Report</button>
                    <button onclick="goToNextPage4()" class="bg-slate-950 text-white py-2 px-4 rounded-md focus:outline-none ">
                        Admin</button>
                    <button onclick="goToNextPage5()" class="bg-slate-950 text-white py-2 px-4 rounded-md focus:outline-none ">
                        Log out</button>
                </div>
            </div>
        </header>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <!-- Search Input -->
             <input type="text" id="searchInput" placeholder="Search by Name"
                        class="mb-4 px-4 py-2 border border-gray-300 rounded-md focus:outline-none mr-4">
                    <button onclick="searchByName()" class="bg-slate-950 text-white py-2 px-4 rounded-md focus:outline-none">Search</button>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Billing</th>
                        <th class="px-4 py-2">Contact</th>
                        <th class="px-4 py-2">Age</th>
                        <th class="px-4 py-2">Sex</th>
                        <th class="px-4 py-2">Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once __DIR__ . '../config/configuration.php'; // Include your database connection file
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='border px-4 py-2'><span class='hidden'>" . $row['name'] . "</span>" . $row['name'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row['billing'] . "</td>";
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

        function goToNextPage5() {
            window.location.href = 'index.php';
        }

         function searchByName() {
            const searchValue = document.getElementById('searchInput').value.trim().toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const nameSpan = row.querySelector('td:first-child span');
                const name = nameSpan ? nameSpan.textContent.toLowerCase() : ''; // Check if span exists
                if (name.includes(searchValue)) {
                    row.classList.remove('hidden');
                    if (searchValue !== '') {
                        row.innerHTML = row.innerHTML.replace(new RegExp(searchValue, 'gi'), (match) => `<span class="highlight">${match}</span>`);
                    } else {
                        row.innerHTML = row.innerHTML.replace(/<span class="highlight">(.*?)<\/span>/gi, '$1'); // Remove highlighting if search is empty
                    }
                } else {
                    row.classList.add('hidden');
                }
            });
        }

     
        const userData = [
            { name: 'John Doe', billing: '$100', contact: '123-456-7890', age: 30, sex: 'Male', id: 1 },
            { name: 'Jane Doe', billing: '$150', contact: '987-654-3210', age: 25, sex: 'Female', id: 2 },
            { name: 'Mike Smith', billing: '$200', contact: '555-555-5555', age: 35, sex: 'Male', id: 3 }
        ];

        const userDataContainer = document.getElementById('userData');
        userData.forEach(user => {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class='border px-4 py-2'><span class='hidden'>${user.name}</span>${user.name}</td>
                <td class='border px-4 py-2'>${user.billing}</td>
                <td class='border px-4 py-2'>${user.contact}</td>
                <td class='border px-4 py-2'>${user.age}</td>
                <td class='border px-4 py-2'>${user.sex}</td>
                <td class='border px-4 py-2'>
                    <a href='edit_user.php?id=${user.id}' class='text-blue-500 hover:underline'>Edit</a> |
                    <a href='delete_user.php?id=${user.id}' class='text-red-500 hover:underline'>Delete</a>
                </td>`;
            userDataContainer.appendChild(newRow);
        });
    </script>
</body>

</html>
