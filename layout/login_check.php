<?php
if (!isset($_SESSION['user_id'])) {
    ?>
    <script>
        window.location.href = "http://localhost/todo_list/login.php";
    </script>
    <?php
}
?>