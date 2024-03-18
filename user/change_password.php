


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login User</title>
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

            footer {
            position: relative;
            margin-top: auto;
        }
    </style>

    <?php 
    include("../navbar/navbar.php");
    if (!isset($_SESSION["user"])) {
        header('Location:loginUser.php');
      }
    ?>
    <?php

include("../database.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    // Retrieve and process form data
    $currentPassword = $_POST["current_password"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];
    $reg_no= $_SESSION['user']['reg_no'];
    
    if($confirmPassword != $newPassword){
        header("Location: change_password.php?error=The password confirmation does not match.");
    }
    else{
        $query = "SELECT * FROM registrations WHERE reg_no= ? AND password = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("ss", $reg_no, $currentPassword);
        $statement->execute();
        $result = $statement->get_result();
    
        if ($result->num_rows > 0) {
    
            $updateQuery = "UPDATE registrations SET password = ? WHERE reg_no= ?";
            $updateStatement = $conn->prepare($updateQuery);
            $updateStatement->bind_param("ss", $newPassword, $reg_no);
            $updateStatement->execute();
         
            header("Location: change_password.php?success=updated successfully");
            exit();
        } else {
            
            header("Location: change_password.php?error=Incorrect current password");
            exit();
        }
    }


}

?>
  
  <div class="content  ">
        <div class="title">
            <h5>CHANGE PASSWORD </h5>
            <hr class="mt-2">
        </div>

        <?php
        $error = isset($_GET['error']) ? $_GET['error'] : '';
        $msg = isset($_GET['success']) ? $_GET['success'] : '';
        if($error){
            ?>
            <div  class=" mt-5 flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <i class=" mx-1 fa fa-exclamation-triangle" aria-hidden="true"></i>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">error !</span> <?php print $error ?>
                </div>
            </div>
            <?php
        }
        if($msg){
            ?>
            <div class= " mt-5 flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <i class="mx-1 fa-solid fa-check"></i>
                <span class="sr-only">Info</span>
                <div>
                     <?php print $msg ?>
                </div>
            </div>
            <?php
        }

        ?>
        
        <div class="form mt-10 w-1/2">
            <form  method="post">
                 <div class="mb-6">
                    <label for="password"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">current Password</label>
                    <input type="password" name="current_password" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                </div> 
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">new Password</label>
                    <input type="password" name="new_password" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                </div> 
                <div class="mb-6">
                    <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">Confirm password</label>
                    <input type="password" name="confirm_password" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div> 
                <button type="submit" name="update" style="background-color: #61892f; color:white" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"> <i class="fa fa-refresh" aria-hidden="true"></i> update</button>  
            </form>
            
        </div>
    </div>



    <?php 
    include("../footer/footer.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
