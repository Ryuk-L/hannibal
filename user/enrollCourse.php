<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enroll course</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .form {
            width: 50%;
            margin-left: 35%;
          
        }
    </style>

    <?php 
    include("../navbar/navbar.php");
    if (!isset($_SESSION["user"])) {
        header('Location:loginUser.php');
      }
   
    ?>

  <div class="content  ">
        <div class="title">
            <h5> ENROLL COURSE</h5>
            <hr class="mt-2">
        </div>
        <?php
         include("../database.php");
         if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $student_id = $_SESSION["user"]["id"];
            $session = $_POST["session"];
            $semester = $_POST["semester"];
            $course = $_POST["course"];
            $department = $_POST["department"];
        
            $checkQuery = "SELECT * FROM enroll WHERE student_id = ? AND session_id = ? AND semester_id  = ? AND course_id = ? AND department_id = ?";
            $checkStatement = $conn->prepare($checkQuery);
            $checkStatement->bind_param("sssss", $student_id, $session, $semester, $course, $department);
            $checkStatement->execute();
            $checkResult = $checkStatement->get_result();
            if ($checkResult->num_rows > 0) {
                echo "<script>alert('Record already exists.');</script>";
            } else {
            
                $courseQuery = "SELECT * FROM courses WHERE id = ?";
                $courseStatement = $conn->prepare($courseQuery);
                $courseStatement->bind_param("s", $course);
                $courseStatement->execute();
                $result = $courseStatement->get_result();
        
                if ($row = $result->fetch_assoc()) {
                  
                    if ($row['seat_limit'] > 0) {
                        $insertQuery = "INSERT INTO enroll (student_id, session_id, semester_id, course_id, department_id) VALUES (?, ?, ?, ?, ?)";
                        $insertStatement = $conn->prepare($insertQuery);
                        $insertStatement->bind_param("sssss", $student_id, $session, $semester, $course, $department);
        
                        if ($insertStatement->execute()) {
                            $updateQuery = "UPDATE courses SET seat_limit = seat_limit - 1 WHERE id= ?";
                            $updateStatement = $conn->prepare($updateQuery);
                            $updateStatement->bind_param("s", $course);
        
                            if ($updateStatement->execute()) {
                                ?>
                                <div class="mt-5 flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                    <i class="mx-1 fa-solid fa-check"></i>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <?php echo "Record added successfully."; ?>
                                    </div>
                                </div>
                                <?php
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                        } else {
                            echo "Error inserting record: " . $conn->error;
                        }
                    } else {
                        echo "<script>alert('No seats available for this  course ');</script>";
                    }
                }
            }
        }
        ?>


        <div class="form" >
        <div style="background-color: #222629;" class=" mt-5 w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form method="post" onsubmit="return validateForm();">
                <div class="mb-6">
                    <label  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">student name</label>
                    <input type="text" name="student_name" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="<?php print($_SESSION["user"]["student_name"])?>">
                </div>
                
                <div class="mb-6">
                    <label  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">student reg no</label>
                    <input type="text" name="reg_no" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="<?php print($_SESSION["user"]["reg_no"])?>">
                </div>
                <div class="mb-6">
                    <label  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">pincode</label>
                    <input type="text" name="pincode" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="<?php print($_SESSION["user"]["pincode"])?>">
                </div>

                <div class="mb-6">
                <label  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">department</label>
                <select  id="department" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option  value="" selected>Choose a department</option>
                    <?php 
                        $result = $conn->query("SELECT * FROM departments");
                        while ($row = $result->fetch_assoc()) {
                    ?>
                     <option value="<?php print $row["id"] ?>"><?php print $row["department_value"] ?></option>
                    <?php
                     }
                    ?>
                </select>
                </div>
                <div class="mb-6">
                <label  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">session</label>
                <select id="session" name="session" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                   <option value="" selected>Choose a session</option>
                   <?php 
                        $result = $conn->query("SELECT * FROM sessions ");
                        while ($row = $result->fetch_assoc()) {
                    ?>
                   <option value="<?php print $row["id"] ?>"><?php print $row["session_value"] ?></option>
                
                    <?php
                     }
                    ?>
                </select>
                </div>

                <div class="mb-6">
                <label  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">semester</label>
                <select id="semester" name="semester" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected>Choose a semester</option> 
                    <?php 
                        $result = $conn->query("SELECT * FROM semesters ");
                        while ($row = $result->fetch_assoc()) {
                    ?>
                     <option value="<?php print $row["id"] ?>"><?php print $row["semester_value"] ?></option>
                    <?php
                     }
                    ?>
                </select>
                </div>

                <div class="mb-6">
                <label  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">course</label>
                <select  id="course" name="course" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option  value="" selected>Choose course</option>
                    <?php 
                        $result = $conn->query("SELECT * FROM courses ");
                        while ($row = $result->fetch_assoc()) {
                    ?>
                     <option value="<?php print $row["id"] ?>"><?php print $row["course_name"] ?></option>
                    <?php
                     }
                    ?>
                </select>
                </div>
                <button type="submit" name="submit"  style="background-color: #86c232; color:white" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">enroll</button>
            </form>
        </div>
     </div>
    </div>



    <?php 
    include("../footer/footer.php");
    ?>
    <script>
function validateForm() {
    var sessionSelect = document.getElementById('session');
    var semesterSelect = document.getElementById('semester');
    var courseSelect = document.getElementById('course');
    var departmentSelect = document.getElementById('department');
    if (departmentSelect.value === "") {
        alert("Please select a department.");
        return false; 
    }
    if (sessionSelect.value === "") {
        alert("Please select a session.");
        return false; 
    }
    if (semesterSelect.value === "") {
        alert("Please select a semester.");
        return false; 
    }
    if (courseSelect.value === "") {
        alert("Please select a course.");
        return false; 
    }
    return true; 
}
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
