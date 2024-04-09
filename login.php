<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/21/2020
 * Time: 7:58 PM
 */
    session_start();
    require_once 'php/db_connect.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    <link rel="stylesheet" href="assets/style/bootstrap.css">
    <link rel="icon" href="images/logo.jpg">
</head>
<style>
    #main_nav ul li{
        text-align: center;
    }
    #main_nav ul li a{
        font-size: 15px;
        color: #fff;
        font-weight: 500;
        padding: 25px;
        text-transform: capitalize;
    }

    #drop a:hover{
        color: white;
        background-color: black;
    }
</style>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark m-0 p-0">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="#"><span style="color: yellow">Gamers</span> <span style="color: red">World</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="news_feed.php">News feed</a>
                </li>
                <li class="nav-item dropdown bg-dark">
                    <?php
                    //check user login or not

                    if (!isset($_SESSION['user']))
                    {
                        echo "<a href='login.php' class='nav-link'>Login</a>";
                    }else{
                        $sql = "SELECT * FROM users WHERE email = '$_SESSION[user]'";
                        $res = mysqli_query($connect, $sql);

                        $userdata = mysqli_fetch_assoc($res);
                        echo "
                        <li class='nav-item dropdown'>
                        <a class='nav-link  dropdown-toggle' data-toggle='dropdown' href='#'> $userdata[first_name] <img src='images/$userdata[image]' style='height: 30px; width: 30px; border-radius: 50%'></a>
                            <div class='dropdown-menu bg-dark' id='drop' aria-labelledby='navbarDropdown'>
                                <a href='users/index.php' class='dropdown-item text-capitalize'>Profile</a>
                                <a href='users/logout.php' class='dropdown-item text-capitalize'>Logout</a>
                            </div>
                        </li>
                   ";
                    }

                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-7 mx-auto mt-5 mb-5">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-center">User Login</h3>
                        <?php

                        global  $connect;

                        if (isset($_POST['btn'])) {
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $has = hash('md5', $password);
                            if ($email == ''){
                                echo "<span class='text-danger'>Please Enter Email</span><br/>";
                            } elseif ($password == ''){
                                echo "<span class='text-danger'>Please Enter Password</span><br/>";
                            }else{

                                $sql = "SELECT * FROM users WHERE email ='$email' AND password = '$has' AND status = '0'";

                                $result = mysqli_query($connect, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $data = mysqli_fetch_assoc($result);

                                    if ($data['role'] == 'user') {
                                        $_SESSION['user'] = $data['email'];
                                        echo "<script>document.location.href='users/index.php'</script>";
                                    } elseif ($data['role'] == 'admin') {
                                        $_SESSION['admin'] = $data['email'];
                                        echo "<script>document.location.href='admin/index.php'</script>";
                                    }
                                }else {
                                    echo "<span class='text-danger'>User Name Or Password Doesn't match or Blocked by admin</span>";
                                }
                            }
                        }

                        ?>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Enter Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Enter Password" class="form-control">
                            </div>
                            <div>
                                <a href="registration.php" class="nav-link float-right">New User Registraion</> </a>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="btn" value="Login" class="btn btn-success mt-4">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>



<section class="footer bg-dark">
    <?php include "footer.php";?>
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>
