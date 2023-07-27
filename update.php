<?php
include './db_connect/connect.php';
?>

<?php
$id = $_GET['note_id'];
$sql = "SELECT note from notes WHERE id=$id";
$run = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($run);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form class="container mt-5 mb-5 w-50" method="POST" action="">
            <h1 class="text-center">Update Your Notes</h1>
            <div class="form-group mt-5">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="textarea"
                    type="text"><?php echo $row['note']; ?></textarea>
            </div>
            <div class="row mt-4">
                <div class="col d-flex justify-content-center">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>

<?php
if (isset($_POST['update'])) {

    $textarea = $_POST['textarea'];

    $sql = "UPDATE notes SET note='$textarea' WHERE id=$id";

    $run = mysqli_query($conn, $sql);

    if ($run) {
        ?>
        <script>
            window.location.href = "http://localhost/todo_list/index.php";
        </script>

        <?php
    } else {
        echo "Failed";
    }
}

?>