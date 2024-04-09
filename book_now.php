<?php
session_start();
include 'php/db_connect.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gamers_World</title>
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

    .slider{
        background-image: url("images/banner.jpg");
        height: 550px;
        width: 100%;
        background-repeat: no-repeat;
        background-attachment: fixed;

    }
    .slide_section{
        height: 550px;
        opacity: 1;
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0.5);
        overflow: hidden;
    }
    .title{
        margin-top: 250px;
        font-size: 60px;
        font-weight: 400;
        color: white;
    }
</style>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark m-0 p-0">
    <?php
    /**
     * Created by PhpStorm.
     * User: ASUS
     * Date: 11/21/2020
     * Time: 10:36 PM
     */
    ?>
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

                    }else{
                        echo "
                    <li class='nav-item dropdown'>
                        <a class='nav-link  dropdown-toggle' data-toggle='dropdown' href='#'>Manage Event</a>
                            <div class='dropdown-menu bg-dark' id='drop' aria-labelledby='navbarDropdown'>
                                <a href='users/add_event.php' class='dropdown-item text-capitalize'>Add Event</a>
                                <a href='users/manage_event.php' class='dropdown-item text-capitalize'>Manage Event</a>
                            </div>
                        </li>
                    ";
                    }

                    ?>
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

    <section class="booking">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <?php
                            if (isset($_GET['event'])){

                                $event_id = $_GET['event'];

                                $sql_get = "SELECT * FROM event WHERE event_id = '$event_id'";
                                $res_get = mysqli_query($connect, $sql_get);

                                $event = mysqli_fetch_assoc($res_get);
                            }
                                $total_event = "SELECT event_id, COUNT(event_id) AS TotalEvent FROM booking WHERE event_id = '$event_id'";
                                $res_event   = mysqli_query($connect, $total_event);

                                $total = mysqli_fetch_assoc($res_event);

                                $event_left = $event['book_limit'] - $total['TotalEvent'];
                            ?>
                            <h3>Book Now <span class="float-right text-danger">
                                    <?php
                                        if ($event_left == 0){
                                            echo "Event Booking Full";
                                        }else{
                                            echo $event_left.' '.'Left';
                                        }
                                    ?>
                                </span>
                            </h3>
                            <?php
                                 if (!isset($_SESSION['user'])){

                                     echo "All ready have Account?<a href='login.php' class='text-decoration-none'>Sign in / <a href='registration.php' class='text-decoration-none'>Sign up Here</a></a>";
                                 }
                            ?>

                        </div>
                        <div class="card-body">
                            <h3 class="ml-3">
                                <?php
                                if (!isset($_SESSION['user'])){

                                        echo "<span class='text-danger'>Please Login First</span><b/>";
                                }else{
                                    if (isset($_POST['btn'])){

                                        $user_id  = $_POST['user_id'];
                                        $event_id = $_POST['event_id'];

                                        $booking_date = date('Y-m-d');

                                        $sql_booking = "INSERT INTO booking (user_id, event_id, booking_date) VALUES ('$user_id', '$event_id', '$booking_date')";
                                        $res_booking = mysqli_query($connect, $sql_booking);

                                        if ($res_booking){
                                            echo "<script>document.location.href='users/my_booking_payment.php'</script>";
                                            echo "<span class='text-success'>Booking Successful</span><br/>";
                                        }else{
                                            echo "<script>document.location.href='users/my_booking_payment.php'</script>";
                                            echo "<span class='text-danger'>Booking Failed...!!</span><br/>";
                                        }
                                    }
                                }
                                ?>
                            </h3>

                            <form action="" method="post">
                                <div>
                                    <input name="user_id" hidden value="<?php echo $userdata['user_id'];?>">
                                    <input name="event_id" hidden value="<?php echo $event['event_id'];?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="font-weight-bold">Event Title</label>
                                    <input type="text" class="form-control" disabled value="<?php echo $event['event_title'];?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="font-weight-bold">Event Price</label>
                                    <input type="text" class="form-control" disabled value="<?php echo number_format($event['event_price'], 2);?> T.K" >
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Your Name" disabled value="<?php if (isset($userdata)){echo $userdata['first_name'].' '.$userdata['last_name'];}?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="font-weight-bold">Email</label>
                                    <input type="text" class="form-control"  placeholder="Enter Your Email" disabled value="<?php if (isset($userdata)){echo $userdata['email'];}?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="font-weight-bold">Phone</label>
                                    <input type="text" class="form-control"  placeholder="Enter Your Phone Number" disabled value="<?php if (isset($userdata)){echo $userdata['phone'];}?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <?php
                                        if ($event_left == 0){
                                            echo "<input  class='btn btn-danger mt-4 btn-block' value='Booking Limit Full'>";
                                        }else{
                                            echo "<input type='submit' name='btn' class='btn btn-success mt-4 btn-block' value='Book Now'>";
                                        }
                                    ?>
<!--                                    <input type="submit" name="btn" class="btn btn-success mt-4 btn-block" value="Book Now">-->
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
