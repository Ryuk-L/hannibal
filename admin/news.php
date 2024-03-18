<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>news</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="loginAdmin.css" rel="stylesheet">
</head>

<body>
    <style>
         body{
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .content {
            padding: 22px 40px;
        }

        .form {
            width: 35%;
            margin-left: 35%;
        }

        footer {
            position: relative;
            margin-top: auto;
        }
    </style>

    <?php 
    include("../navbar/navbar.php");
    if (!isset($_SESSION["admin"])) {
        header('Location:loginAdmin.php');
      }
    include("../database.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $title = $_POST["title"];
        $comment = $_POST["comment"];
    
        $stmt = $conn->prepare("INSERT INTO news (title, comment) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $comment);
    
        if ($stmt->execute()) {
            ?>
            <div class= " mt-5 flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <i class="mx-1 fa-solid fa-check"></i>
                <span class="sr-only">Info</span>
                <div>
                     <?php print "News added successfully ."?>
                </div>
            </div>
            <?php
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
    }
    
    ?>

    <div class="content">
        <div class="title">
            <h5> ADD NEWS</h5>
            <hr class="mt-2">
        </div>
        <div class="form">
            <div style="background-color: #222629;" class="mt-5 w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form method="post">
    <div class="mb-6">
        <label for="title" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;" >Create news</label>
        <input type="text" name="title" id="title" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Write a comment..."> 
    </div>

    <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
        <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
            <label for="comment" class="sr-only">Your comment</label>
            <textarea id="comment" name="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
        </div>
        <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
            <button style="background-color: #86c232;" type="submit"  name="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                Post new
            </button>
            <div class="flex ps-0 space-x-1 rtl:space-x-reverse sm:ps-2"></div>
        </div>
    </div>
</form>

            </div>
        </div>

        <div>
        </div>
    </div>

    <?php 
    include("../footer/footer.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>
