<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/22/2020
 * Time: 10:54 AM
 */
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


<section class="login"  style="background-color: #ced4da">
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto mt-5 mb-5">
                <div class="card mb-5 mt-5">
                    <div class="card-header">
                        <h3 class="text-center">New User Registration</h3>
                    </div>
                    <div class="card-body">
                        <h4 class="ml-3 mb-4">
                            <?php
                            require_once 'php/db_connect.php';
                            global  $connect;

                            if (isset($_POST['user_reg']))
                            {
                                $first_name = $_POST['first_name'];
                                $last_name  = $_POST['last_name'];
                                $email      = $_POST['email'];
                                $phone      = $_POST['phone'];
                                $password   = $_POST['password'];
                                $image      = $_FILES['image']['name'];

                                $has = hash('md5', $password);

                                if ($first_name == ''){
                                    echo "<span class='text-danger'>Please Enter First Name</span><br/>";
                                }elseif ($last_name == ''){
                                    echo "<span class='text-danger'>Please Enter Last Name</span><br/>";
                                }elseif ($email == ''){
                                    echo "<span class='text-danger'>Please Enter Email</span><br/>";
                                }elseif ($phone == ''){
                                    echo "<span class='text-danger'>Please Enter Phone</span><br/>";
                                }elseif ($password == ''){
                                    echo "<span class='text-danger'>Please Enter Password</span><br/>";
                                }elseif ($image == ''){
                                    echo "<span class='text-danger'>Please Select Image</span><br/>";
                                }else{

                                    $sqlCheck = "SELECT * FROM users WHERE email = '$email'";
                                    $result = mysqli_query($connect, $sqlCheck);
                                    $count = mysqli_num_rows($result);
                                    if ($count > 0) {
                                        echo "<span class='text-danger'>Email All ready Registered.... Please Try Agin With New Email!</span><br/>";
                                    }else{

                                        $fileinfo = PATHINFO($_FILES['image']['name']);
                                        $newfilename = $fileinfo['filename'] . "." . $fileinfo['extension'];
                                        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $newfilename);
                                        $location = $newfilename;

                                        $join_date = date('Y-m-d');
                                        $reg_user = "INSERT INTO users (first_name, last_name, email, phone, password, image, role, status, join_date) VALUES ('$first_name', '$last_name', '$email', '$phone', '$has', '$image', 'user', '0', '$join_date')";
                                        $res_reg  = mysqli_query($connect, $reg_user);

                                        if ($res_reg)
                                        {
                                            echo "<span class='text-success'>Registration Successful</span><br/>";
                                        }else{
                                            echo "<span class='text-danger'>Registration Failed...Try Again...!!!</span><br/>";
                                        }
                                    }
                                }
                            }

                            ?>
                        </h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-6 float-left">
                                <label>First Name <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="text" name="first_name" placeholder="Enter First Name" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['first_name'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Last Name <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control"value="<?php if($_POST) {
                                    echo $_POST['last_name'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Email <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="email" name="email" placeholder="Enter Email Address" class="form-control"value="<?php if($_POST) {
                                    echo $_POST['email'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Phone <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="text" name="phone" placeholder="Enter Phone Number" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['phone'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Password <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="password" name="password"  placeholder="Enter Your Password" class="form-control">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Image <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="file" name="image" class="form-control"  value="<?php if($_POST) {
                                    echo $_POST['image'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label></label>
                                <input type="submit" name="user_reg" class="btn btn-success btn-block" value="Submit">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="login.php" class="float-right nav-link">All Ready Registered Login</a>
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

