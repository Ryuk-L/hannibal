<?php
session_start();
session_destroy();
header("location:/project_stage/admin/loginAdmin.php");
?>