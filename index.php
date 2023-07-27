<?php
include './db_connect/connect.php';
$user_id = $_GET['user_id'];
include('./layout/login_check.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo List Web App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        /* Custom style to remove bullet points from the list */
        li {
            list-style-type: none;
        }

        /* Custom style to wrap text in the table cells */
        td {
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    <div class='container'>

        <div class="container mt-5 mb-5">
            <h1 class="text-center">Todo Application</h1>
            <form class="d-flex justify-content-center align-items-center mt-4" method="POST" action="">
                <div class="input-group w-75">
                    <input name="notes" type="text" class="form-control" placeholder="Enter anything" minlength="1"
                        maxlength="70" required />
                    <button type="submit" name="submit" class="btn btn-primary ms-3">Add</button>

                    <!-- <button type="submit" name="logout" class="btn btn-primary ms-3">Logout</button> -->
                </div>
            </form>
            <form method="POST" action="logout.php">
                <!-- Your other form elements -->
                <button type="submit" name="logout" class="btn btn-primary ms-3">Logout</button>
            </form>
        </div>

        <div class="container">
            <ul>
                <?php
                $req1 = "SELECT * FROM notes";
                $run1 = mysqli_query($conn, $req1);
                $count = mysqli_num_rows($run1);

                $count1 = 1;

                if ($count > 0) {
                    ?>
                    <table class="table container-xxl table-bordered">
                        <thead>
                            <tr align="center">
                                <th scope="col">S.No.</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row1 = mysqli_fetch_assoc($run1)) {
                                ?>

                                <tr>
                                    <th scope="row" style="width: 10%; text-align: center;">
                                        <?php echo $count1 ?>
                                    </th>

                                    <td style="width: 70%">
                                        <?php echo $row1['note'] ?>
                                    </td>

                                    <td style="width: 20%">
                                        <form method="POST" action="" align="center">
                                            <input type="hidden" name="note_id" value="<?php echo $row1['id']; ?>">
                                            <button type="submit" name="update" class="btn btn-secondary"><i
                                                    class="fa-solid fa-pen"></i></button>
                                            <button type="submit" name="delete" class="btn btn-danger"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>
                                <?php
                                $count1++;
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                } else {
                    ?>
                    <div class="container d-flex justify-content-center vh-100">
                        <div class="row">
                            <div class="col text-center">
                                <h4>No Notes Found</h4>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submission
    if (isset($_POST['submit'])) {
        // Assuming $conn is your database connection object
        $note = $_POST['notes'];

        $sql = "INSERT INTO notes(note) VALUES('$note')";

        $run = mysqli_query($conn, $sql);

        if ($run) {
            echo 'Success';
            echo '<meta http-equiv="refresh" content="0">';
            exit;
        } else {
            // Display the specific error message
            echo 'Error: ' . mysqli_error($conn);
        }
    }

    // To delete data from the database
    if (isset($_POST['delete'])) {
        // Assuming $conn is your database connection object
        $id = $_POST['note_id'];

        $sql = "DELETE FROM notes WHERE id = $id";

        $run = mysqli_query($conn, $sql);

        if ($run) {

            // Use the meta refresh tag to reload the page after a delay (in this case, 0 seconds)
            echo '<meta http-equiv="refresh" content="0">';
            exit;
        } else {
            // Display the specific error message
            echo 'Delete failed: ' . mysqli_error($conn);
        }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['note_id'];
        ?>
        <script>
            window.location.href = "http://localhost/todo_list/update.php?note_id=<?php echo $id; ?>";
        </script>
        <?php
    }
}
?>