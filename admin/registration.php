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


    function generatePincode($length = 6) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $pincode = '';
        for ($i = 0; $i < $length; $i++) {
            $pincode .= $characters[rand(0, $charactersLength - 1)];
        }
        return $pincode;
    }

    

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

        $studentName = $_POST["student_name"];
        $regNo = $_POST["reg_no"];
        $password = $_POST["password"];
        $randomPincode = generatePincode();
        // Your database query to insert data into the registration table
        $query = "INSERT INTO registrations (student_name, reg_no, password,pincode) VALUES (?, ?, ?,?)";
        $statement = $conn->prepare($query);
        $statement->bind_param("ssss", $studentName, $regNo, $password,$randomPincode);
        
        $statement->execute();

        $statement->close();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        $studentId = $_POST["studentId"];
        $password = $_POST["password"];
        $regNo = $_POST["reg_no"];
        $studentName = $_POST["student_name"];

        // Updating the existing course in the database
        $query = "UPDATE registrations SET password = ?, reg_no = ?, student_name = ? WHERE id = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("ssss", $password, $regNo, $studentName, $studentId);
        $statement->execute();
    }
    
    ?>

  
  <div class="content  ">
        <div class="title">
            <h5>STUDENT REGISTRATION</h5>
            <hr class="mt-2">
    </div>
    <div class="form">
        <div style="background-color: #474B4F;" class=" mt-5 w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form  method="post">
                        <div class="mb-6">
                            <label for="session"  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;"> student name </label>
                            <input required type="text" name="student_name" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                        </div> 
                        <div class="mb-6">
                            <label for="session"  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;"> student reg no </label>
                            <input required type="text" name="reg_no" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                        </div> 
                        <div class="mb-6">
                            <label for="session"  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;"> password </label>
                            <input required type="password" name="password" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                        </div> 
                        
                        <button type="submit" name="submit" style="background-color: #86c232; color:white" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">submit</button>
                    </form>
        </div>
    </div>

    <div>
        

<div  class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
    <table style="" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption  style="background-color: #474B4F; color:white;" class=" p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Manage Student Registration
        </caption>
        <thead  style="background-color: #61892f;" class="text-xs text-white uppercase bg-gray-500  dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th  scope="col" class="px-6 py-3">
                    #
                </th>
                <th  scope="col" class="px-6 py-3">
                student name
                </th>
                <th  scope="col" class="px-6 py-3">
                reg_no
                </th>
                <th  scope="col" class="px-6 py-3">
                    pincode
                </th>
                <th  scope="col" class="px-6 py-3">
                registration_date	
                </th>
                    <th  scope="col" class="px-6 py-3">
                    action
                </th>
            </tr>
        </thead>
        <tbody>
        <?php 
$result = $conn->query("SELECT * FROM registrations ORDER BY ID DESC");
while ($row = $result->fetch_assoc()) {
    ?>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <td class="px-6 py-4">
            <?php print $row["id"]; ?>
        </td>
        <td class="px-6 py-4 ">
            <?php print $row["student_name"]; ?>
        </td>
        <td class="px-6 py-4 ">
            <?php print $row['reg_no'];?>
        </td>
        <td class="px-6 py-4 ">
            <?php print $row['pincode'];?>
        </td>
        <td class="px-6 py-4 ">
            <?php print date('Y-m-d', strtotime($row['registration_date']));?>
        </td>
        <td class="px-6 py-4 text-left">
            <a  onclick="confirm('Are you sure?');" href="./deleteRegistration.php?id=<?php  print $row["id"]; ?>" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800"><i class="fa-sharp fa-solid fa-trash"></i></a>
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" data-id="<?php echo $row['id']; ?>" data-sName="<?php print $row['student_name'];?>"  data-reg="<?php print $row['reg_no'];?>"  data-pincode=" <?php print  $row['pincode'];?>" data-password=" <?php print  $row['password'];?>" style="background-color: #86c232; color:white" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="fas fa-edit"></i></button>

        </td>
    <?php
}
?>

                
            </tr>
        </tbody>
    </table>
</div>
    </div>
     <!-- Authentication Modal -->
     <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 style="color: #86c232;" class="text-xl font-semibold">Edit Student Registration</h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="#" method="post">
                        <div>
                            <label for="student_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">student name</label>
                            <input type="text" name="student_name" id="student_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="reg_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">reg no</label>
                            <input type="text" name="reg_no" id="reg_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">password</label>
                            <input type="text" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>

                        <div>
                            <input type="hidden" name="studentId" id="studentId" value="">
                        </div>
                        <button name="update" style="background-color: #61892f;" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">update</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>



    <?php 
    include("../footer/footer.php");
    ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var editButtons = document.querySelectorAll('[data-modal-toggle="authentication-modal"]');
        var modal = document.getElementById('authentication-modal');
        var studentNameInput = document.getElementById('student_name');
        var regNoInput = document.getElementById('reg_no');
        var studentIdInput = document.getElementById('studentId');
        var passwordInput = document.getElementById('password');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var studentId = this.getAttribute('data-id');
                var studentName = this.getAttribute('data-sName');
                var regNo = this.getAttribute('data-reg');
                var password = this.getAttribute('data-password');
                studentIdInput.value = studentId;
                studentNameInput.value = studentName;
                regNoInput.value = regNo;
                passwordInput.value=password;

                modal.classList.remove('hidden');
            });
        });
    });
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
