<?php

require_once __DIR__ . '../config/configuration.php';
require_once __DIR__ . '../config/validation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];


  // Validate login credentials
    $admin = ValidateLogin($email, $password,$username,$confirm);

    if (!empty($admin)) {
      // Redirect to admin.php if login is successful
      header('Location:admin.php');
      exit;
    } else {
      echo '<script>alert("Login failed!");</script>';
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<style>
    button{
        background: #ea580c;
    }
    span{
        color: #ea580c;
    }
    #login{
      background: #16a34a;
    }
    </style>
<body class="bg-gray-100">
 <div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
       <div class="flex items-center">
                <img src="/image/logo.jpg" alt="Logo" class=" w-14 rounded-full mr-10">
                <span class="text-xl font-bold text-green-600">EJS Memorial Services</span>
            </div>
            <br>
      <form action="admin.php" method="POST">
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" id="username" name="username" required placeholder="Enter your username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
        </div>
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" required  placeholder="Enter your email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <div class="relative">
            <input type="password" id="password" required  name="password" placeholder="Enter your password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
            <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePasswordVisibility()">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a8 8 0 0 0-8 8c0 1.813.623 3.548 1.682 4.908a14.07 14.07 0 0 0 1.755-1.757l-.708-.708C1.942 11.395 1 9.79 1 8a7 7 0 0 1 7-7c1.79 0 3.395.943 4.441 2.408l-.708.708a14.07 14.07 0 0 0-1.757 1.755C11.548 2.623 9.813 2 8 2zM0 8a12 12 0 0 1 2.93-8.071l.707.707A11 11 0 0 0 1 8a11 11 0 0 0 2.636 7.364l.708-.707A12 12 0 0 1 0 8zm3.364 3.364l1.414 1.414A3 3 0 0 0 8 13a3 3 0 0 0 2.222-1H10v-.5a1.5 1.5 0 0 0-1.5-1.5h-3A1.5 1.5 0 0 0 4 11.5V12h-.722a3 3 0 0 0-.914-.636l1.414-1.414z"/>
              </svg>
            </span>
          </div>
        </div>
        <div class="mb-4">
          <label for="confirm" class="block text-sm font-medium text-gray-700">Confirm Password</label>
          <div class="relative">
            
            <input type="password" id="confirm" name="confirm" placeholder="Confirm password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
          <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword()">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi-gg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a8 8 0 0 0-8 8c0 1.813.623 3.548 1.682 4.908a14.07 14.07 0 0 0 1.755-1.757l-.708-.708C1.942 11.395 1 9.79 1 8a7 7 0 0 1 7-7c1.79 0 3.395.943 4.441 2.408l-.708.708a14.07 14.07 0 0 0-1.757 1.755C11.548 2.623 9.813 2 8 2zM0 8a12 12 0 0 1 2.93-8.071l.707.707A11 11 0 0 0 1 8a11 11 0 0 0 2.636 7.364l.708-.707A12 12 0 0 1 0 8zm3.364 3.364l1.414 1.414A3 3 0 0 0 8 13a3 3 0 0 0 2.222-1H10v-.5a1.5 1.5 0 0 0-1.5-1.5h-3A1.5 1.5 0 0 0 4 11.5V12h-.722a3 3 0 0 0-.914-.636l1.414-1.414z"/>
              </svg>
          </div>
        </div>
        <button type="submit"  id="login" class="w-full py-2 px-4 text-white rounded-md ">Login</button>
      </form>
    </div>
  </div>

  <script>
    function togglePasswordVisibility() {
      const passwordField = document.getElementById("password");
      const  icon = document.querySelector(".bi-eye");

      if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
      } else {
        passwordField.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
      }
    }

     function togglePassword() {
      const passwordField = document.getElementById("confirm");
      const  icon = document.querySelector(".bi-gg");

      if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("bi-gg");
        icon.classList.add("bi-eye-slash");
      } else {
        passwordField.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-gg");
      }
    }
  </script>
</body>
</html>
