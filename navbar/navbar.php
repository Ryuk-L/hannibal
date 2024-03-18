<?php
session_start();
?>

<link href="/project_stage/navbar/navbar.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Grape+Nuts&family=Moirai+One&family=Prompt:wght@200&family=Roboto+Slab&family=Rubik+Burned&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rubik+Burned&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playpen+Sans&family=Rubik+Burned&display=swap" rel="stylesheet">
<header>
  <div class="navbar">
    <div class="logo">Hannibal</div>
    <nav class="nav-links">
      <?php
      if (isset($_SESSION["admin"])) {
        ?>
        <a href="/project_stage/admin/session.php">session</a>
        <a href="/project_stage/admin/semester.php">semester</a>
        <a href="/project_stage/admin/department.php">department</a>
        <a href="/project_stage/admin/course.php">course</a>
        <a href="/project_stage/admin/registration.php">registration</a>
        <a href="/project_stage/admin/enrollHistory.php">enroll history</a>
        <a href="/project_stage/admin/studentLogs.php">student logs</a>
        <a href="/project_stage/admin/news.php">news</a>
        <a href="/project_stage/admin/logout.php">logout</a>
        <?php
      }
      elseif(isset($_SESSION["user"])){
        ?>
        <a class="mt-3" href="/project_stage/user/verificationPincode.php"> <i class=" mx-1 fa-regular fa-registered"></i> enroll for course</a>
        <a class="mt-3" href="/project_stage/user/enrollHistory.php"><i class=" mx-1 fa-solid fa-clock-rotate-left"></i> enroll history   </a>
        
        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="  mb-1 w-10 h-10 rounded-full cursor-pointer" src="../avatar2.jpg" alt="User dropdown">
        <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
              <div><?php print $_SESSION['user']["student_name"]; ?></div>
            </div>
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My profile</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
              </li>
              <li>
                <a href="/project_stage/user/change_password.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">change password</a>
              </li>
            </ul>
            <div class="py-1">
              <a href="/project_stage/user/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">log out</a>
            </div>
        </div>

        <?php
      }
      
      else {
        ?>
        <a href="/project_stage/index.php">Home</a>
        <a href="/project_stage/admin/loginAdmin.php">Login Admin</a>
        <a href="/project_stage/user/loginUser.php">Login Student</a>
        <?php
      }
      ?>
    </nav>
    <div class="burger-menu">&#9776;</div>
  </div>
</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const burgerMenu = document.querySelector(".burger-menu");
    const navLinks = document.querySelector(".nav-links");

    burgerMenu.addEventListener("click", function () {
      navLinks.classList.toggle("show");
    });
  });
</script>