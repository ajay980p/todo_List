<?php
include './layout/navbar.php';

session_destroy();

header('location:' . 'http://localhost/todo_list/login.php');
exit();

?>