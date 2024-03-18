<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login admin</title>
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
    $error = isset($_GET['error']) ? $_GET['error'] : '';
    ?>
     <div class="content  ">
        <div class="title">
            <h5> PLEASE LOGIN TO ENTER IN ADMIN PANNEL </h5>
            <hr class="mt-2">
        </div>
        <?php
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
        ?>
        <div class="formluaire mt-5 w-1/2">
            <form action="process-login.php" method="post">
                <div class="mb-4" >
                    <label for="small-input" class="block  mb-3 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">enter username</label>
                    <input type="text" name="username" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4" >
                    <label for="password" class="block mb-3 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">enter Password</label>
                    <input type="password"  name="password" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg  bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">        </div>
                
                </div>
                 <button type="submit" style="background-color: #61892f; color:white" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"> <i class="fa fa-sign-in" aria-hidden="true"></i> log me in </button>  
            </form>
  
        </div>
    


    <?php 
    include("../footer/footer.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
