<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>session</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <style>
        body{
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content{
            padding: 22px 40px;
        }
        .form{
            width: 35%;
            margin-left:35%;
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]) && !empty($_POST["session"])) {
        $sessionValue = $_POST["session"];
        $query = "INSERT INTO sessions (session_value) VALUES (?)";
        $statement = $conn->prepare($query);        
        $statement->bind_param("s", $sessionValue);    
        $statement->execute();
    }
    ?>

  
  <div class="content  ">
        <div class="title">
            <h5> ADD SESSION</h5>
            <hr class="mt-2">
    </div>
    <div class="form">
        <div style="background-color: #474B4F;" class=" mt-5 w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form  method="post">
                        <div class="mb-6">
                            <label for="session"  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">create session </label>
                            <input type="text" name="session" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                        </div> 
                        <button type="submit" name="submit" style="background-color: #86c232; color:white" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">submit</button>
                    </form>
        </div>
    </div>

    <div>
        

<div  class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
    <table style="" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption  style="background-color: #474B4F; color:white;" class=" p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Manage Session
        </caption>
        <thead  style="background-color: #61892f;" class="text-xs text-white uppercase bg-gray-500  dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th  scope="col" class="px-6 py-3">
                    #
                </th>
                <th  scope="col" class="px-6 py-3">
                    session
                </th>
                <th  scope="col" class="px-6 py-3">
                    creation date 
                </th>
                    <th  scope="col" class="px-6 py-3">
                    action
                </th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $result = $conn->query("SELECT * FROM sessions ORDER BY ID DESC");
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">
                   <?php  print $row["id"]; ?>
                </td>
                <td class="px-6 py-4 ">
                    <?php print $row["session_value"] ?>
                </td>
                <td class="px-6 py-4 ">
                    <?php print date($row['date']);?>
                </td>
                <td class="px-6 py-4 text-left">
                <a  onclick="confirm('Are you sure?');" href="./deleteSession.php?id=<?php  print $row["id"]; ?>" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800"><i class="fa-sharp fa-solid fa-trash"></i></a>
                </td>
            <?php
        }
        ?>

                
            </tr>
        
 
        </tbody>
    </table>
</div>

    </div>
</div>


    <?php 
    include("../footer/footer.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
