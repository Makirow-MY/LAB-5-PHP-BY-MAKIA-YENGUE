<?php
session_start();
session_unset();
session_destroy();
header("Location: /crud-app/lab_5/exercise4/login.php");
exit();
?>
