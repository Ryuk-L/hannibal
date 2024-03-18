<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>course</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <style>
body {
    margin: 0;
    padding: 0;
    font-family: 'Playpen Sans', cursive;
    background-color: #474B4F;
    color: #fff;
    display: flex;
    flex-direction: column;
    min-height: 100vh; 
}



.content {
    padding: 22px 40px;
    flex: 1; 
}
 



        .form {
            width: 35%;
            margin-left: 35%;
        }
    </style>

    <?php 
    include("../navbar/navbar.php");
    include("../database.php");
    if (!isset($_SESSION["admin"])) {
        header('Location:loginAdmin.php');
      }

    // Handling form submission for adding a new course
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]) && !empty($_POST["courseCode"]) && !empty($_POST["courseName"]) && !empty($_POST["courseUnit"]) && !empty($_POST["seatLimit"])) {
        $courseCode = $_POST["courseCode"];
        $courseName = $_POST["courseName"];
        $courseUnit = $_POST["courseUnit"];
        $seatLimit = $_POST["seatLimit"];
        $courseImage = $_FILES["courseImage"];
        $imageName = $courseImage["name"];
        $imageTmpName = $courseImage["tmp_name"];
        $imageType = $courseImage["type"];


        $uploadDir = "../imageCourses/";
        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        if (in_array($imageType, $allowedTypes)) {
            $uniqueName = uniqid("image_") . "_" . time() . "." . pathinfo($imageName, PATHINFO_EXTENSION);

            move_uploaded_file($imageTmpName, $uploadDir . $uniqueName);
        }

        $query = "INSERT INTO courses (course_code, course_name, course_unit, seat_limit, course_image) VALUES (?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->bind_param("sssss", $courseCode, $courseName, $courseUnit, $seatLimit, $uniqueName);
        $statement->execute();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"]) && !empty($_POST["courseCode"]) && !empty($_POST["courseName"]) && !empty($_POST["courseUnit"]) && !empty($_POST["seatLimit"])) {
        $courseCode = $_POST["courseCode"];
        $courseName = $_POST["courseName"];
        $courseUnit = $_POST["courseUnit"];
        $seatLimit = $_POST["seatLimit"];
        $courseId = $_POST["courseId"];

        $query = "UPDATE courses SET course_code = ?, course_name = ?, course_unit = ?, seat_limit = ? WHERE id = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("ssssi", $courseCode, $courseName, $courseUnit, $seatLimit, $courseId);
        $statement->execute();
    }
    ?>

    <div class="content">
        <div class="title">
            <h5> ADD COURSE</h5>
            <hr class="mt-2">
        </div>
        <div class="form">
            <div style="background-color: #474B4F;" class=" mt-5 w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                <form  method="post" enctype="multipart/form-data">
                    <div class="mb-6">
                        <label for="course"  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">course code </label>
                        <input type="text" name="courseCode" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"> 
                    </div> 
                    <div class="mb-6">
                        <label for="course"  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">course name </label>
                        <input type="text" name="courseName" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"> 
                    </div> 
                    <div class="mb-6">
                        <label for="course"  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">course unit </label>
                        <input type="text" name="courseUnit" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"> 
                    </div> 
                    <div class="mb-6">
                        <label for="course"  class="block mb-4 text-sm font-medium text-gray-900 dark:text-white" style="color: #86c232;">seat limit </label>
                        <input type="text" name="seatLimit" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"> 
                    </div> 
                    <div class="mb-6">
                        <label style="color: #86c232;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload file</label>
                        <input name="courseImage" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                    </div>
                    <button type="submit" name="submit" style="background-color: #86c232; color:white" class="px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">submit</button>
                </form>
            </div>
        </div>

        <!-- Table to display courses -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                <caption style="background-color: #474B4F; color:white;" class=" p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Manage Courses
                </caption>
                <thead style="background-color: #61892f;" class="text-xs text-white uppercase bg-gray-500  dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">courseCode</th>
                        <th scope="col" class="px-6 py-3">courseName</th>
                        <th scope="col" class="px-6 py-3">courseUnit</th>
                        <th scope="col" class="px-6 py-3">seatLimit</th>
                        <th scope="col" class="px-6 py-3">creation date</th>
                        <th scope="col" class="px-6 py-3">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $result = $conn->query("SELECT * FROM courses ORDER BY ID DESC");
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                <?php  print $row["id"]; ?>
                            </td>
                            <td class="px-6 py-4 ">
                                <?php print $row["course_code"] ?>
                            </td>
                            <td class="px-6 py-4 ">
                                <?php print  $row['course_name'];?>
                            </td>
                            <td class="px-6 py-4 ">
                                <?php print  $row['course_unit'];?>
                            </td>
                            <td class="px-6 py-4 ">
                                <?php print  $row['seat_limit'];?>
                            </td>
                            <td class="px-6 py-4 ">
                                <?php print date ($row['date']);?>
                            </td>
                            <td class="px-6 py-4 text-left">
                                <a  onclick="confirm('Are you sure?');" href="./deleteCourse.php?id=<?php  print $row["id"]; ?>" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800"><i class="fa-sharp fa-solid fa-trash"></i></a>
                                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" data-id="<?php echo $row['id']; ?>" data-cCode="  <?php print  $row['course_code'];?>"  data-cName="<?php print  $row['course_name'];?>"  data-unit=" <?php print  $row['course_unit'];?>" data-seat="<?php print  $row['seat_limit'];?>" style="background-color: #86c232; color:white" class="px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
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
                    <h3 style="color: #86c232;" class="text-xl font-semibold">Edit course</h3>
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
                            <label for="courseCode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">course code</label>
                            <input type="text" name="courseCode" id="courseCode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="courseName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">course name</label>
                            <input type="text" name="courseName" id="courseName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="courseUnit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">course unit</label>
                            <input type="text" name="courseUnit" id="courseUnit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="seatLimit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">seat limit</label>
                            <input type="text" name="seatLimit" id="seatLimit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <input type="hidden" name="courseId" id="courseId" value="">
                        </div>
                        <button name="update" style="background-color: #61892f;" type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">update</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 

    <?php 
    include("../footer/footer.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var editButtons = document.querySelectorAll('[data-modal-toggle="authentication-modal"]');
            var modal = document.getElementById('authentication-modal');
            var courseIdInput = document.getElementById('courseId');
            var courseCodeInput = document.getElementById('courseCode');
            var courseNameInput = document.getElementById('courseName');
            var courseUnitInput = document.getElementById('courseUnit');
            var seatLimitInput = document.getElementById('seatLimit');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var courseId = this.getAttribute('data-id');
                    var courseCode = this.getAttribute('data-cCode');
                    var courseName = this.getAttribute('data-cName');
                    var courseUnit = this.getAttribute('data-unit');
                    var seatLimit = this.getAttribute('data-seat');

                    courseIdInput.value = courseId;
                    courseCodeInput.value = courseCode;
                    courseNameInput.value = courseName;
                    courseUnitInput.value = courseUnit;
                    seatLimitInput.value = seatLimit;

                    modal.classList.remove('hidden');
                });
            });
        });
    </script>
</body>
</html>
