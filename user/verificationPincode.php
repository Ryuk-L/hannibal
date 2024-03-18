<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verification pincode</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .content {
            padding: 22px 40px;
        }

        footer {
            position: relative;
            margin-top: auto;
        }

        .form {
            width: 35%;
            margin-left: 35%;
            margin-top: 10%;
        }
    </style>
</head>
<body>

<?php
include("../navbar/navbar.php");
if (!isset($_SESSION["user"])) {
    header('Location:loginUser.php');
  }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $pincode = $_POST["pincode"];
    if ($pincode == $_SESSION["user"]["pincode"]) {
        header("Location: enrollCourse.php");
        exit();
    }
}
?>

<div class="content">
    <div class="title">
        <h5>STUDENT VERIFICATION PINCODE</h5>
        <hr class="mt-2">
    </div>
    <div class="form">
        <div style="background-color: #222629;" class=" mt-5 w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form method="post">
                <div class="mb-6">
                    <label for="pincode" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">enter pincode</label>
                    <input type="text" name="pincode" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <button type="submit" name="submit" style="background-color: #86c232; color:white" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">verify</button>
            </form>
        </div>
    </div>
</div>

<?php
include("../footer/footer.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
