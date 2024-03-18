<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enroll history</title>
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
        #table{
            margin-top: 10% ;
        }
    </style>

    <?php 
    include("../navbar/navbar.php");
    if (!isset($_SESSION["user"])) {
        header('Location:loginUser.php');
      }
    include("../database.php");
    ?>
    <?php




?>
  
  <div class="content  ">
        <div class="title">
            <h5> ENROLL HISORY</h5>
            <hr class="mt-2">
        </div>


        <div id="table" class=" mt-7 relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100">
        <thead style="background-color: #222629;  color:#86c232 " class="text-xs uppercase  dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                reg No
                </th>
                <th scope="col" class="px-6 py-3">
                student Name
                </th>
                <th scope="col" class="px-6 py-3">
                    department
                </th>
                <th scope="col" class="px-6 py-3">
                    Session
                </th>
                <th scope="col" class="px-6 py-3">
                    semester
                </th>
                <th scope="col" class="px-6 py-3">
                Course Name
                </th>
                <th scope="col" class="px-6 py-3">
                  enrollment date
                </th>
            </tr>
        </thead>
        <tbody>
        <?php 
    $student_id = $_SESSION["user"]["id"];
    $result = $conn->query("SELECT * FROM enroll e 
    JOIN registrations r ON e.student_id = r.id 
    JOIN departments d ON e.department_id = d.id 
    JOIN sessions s ON e.session_id = s.id 
    JOIN SEMESTERS sm ON e.SEMESTER_id = sm.id 
    JOIN courses c ON e.course_id = c.id
    WHERE e.student_id = $student_id order by enrollment_date desc" );

    while ($row = $result->fetch_assoc()) {
     

 
        ?>
        <tr  style="background-color: #222629;" >
                <td class="px-6 py-4"><?php echo $row["id"]; ?></td>
                <td class="px-6 py-4"><?php echo $row["reg_no"];  ?></td>
                <td class="px-6 py-4"><?php print($row["student_name"])?></td>
                <td class="px-6 py-4"><?php echo $row["department_value"]; ?></td>
                <td class="px-6 py-4"><?php echo $row["session_value"]; ?></td>
                <td class="px-6 py-4"><?php echo $row["semester_value"]; ?></td>
                <td class="px-6 py-4"><?php echo $row["course_name"]; ?></td>
                <td class="px-6 py-4"><?php print($row["enrollment_date"])?></td>
            </tr>
        <?php
    }
?>
               
            
           
        </tbody>
    </table>
</div>

    </div>



    <?php 
    include("../footer/footer.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
