<?php
include('./db_connect/connect.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-4">

                <form method="POST">

                    <div class='row'>
                        <div class='col'>
                            <h1 style="text-align: center">User Login</h1>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col'>
                            <h4 style="text-align: center" class="text-danger">
                                <?php
                                if (isset($_SESSION['login'])) {
                                    echo $_SESSION['login'];
                                    unset($_SESSION['login']);
                                }
                                ?>
                            </h4>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" name="username" aria-describedby="emailHelp"
                            placeholder="Enter Username">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                    </div>

                    <br>

                    <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">Don't have an account? <a class='text-primary' style="cursor: pointer;"
                                href="signup.php">Create new</a></p>
                        <!-- <button type="button" class="btn btn-outline-success">Create new</button> -->
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>

<?php

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

    $run = mysqli_query($conn, $sql);

    // To check how many ros are available into the table tbl_admin (For restaurant verification purpose)
    if (mysqli_num_rows($run) == 1) {

        $rows = mysqli_fetch_assoc($run);

        // Assigning restaurant id to get the result and send it to the other page
        $_SESSION['user_id'] = $rows['user_id'];

        // Login Success
        // $_SESSION['cust-login-success-msg'] = "<div class='success'>Login Successfully</div>";

        ?>

        <script>
            window.location.href = "http://localhost/todo_list/index.php?user_id=<?php echo $rows['user_id']; ?>";
        </script>

        <!-- header('Location: ' . SITEURL . 'index.php?cust_id=' . $user_id); -->
        <?php

    } else {

        $_SESSION['login'] = "<div class='error'>Username or Password did not matched</div>";
        ?>

        <script>
            window.location.href = "http://localhost/todo_list/login.php";
        </script>

        <?php

        die("Error: " . mysqli_error($conn));

    }
}

?>