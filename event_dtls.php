<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/23/2020
 * Time: 11:12 AM
 */
    include "php/db_connect.php";
?>
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
<nav class="navbar navbar-expand-lg bg-dark navbar-dark m-0 p-0 fixed-top">
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
                                <a href='add_event.php' class='dropdown-item text-capitalize'>Add Event</a>
                                <a href='manage_event.php' class='dropdown-item text-capitalize'>Manage Event</a>
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

    <section class="main mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-5 mb-5">
                    <?php
                    //get event by event id
                    if (isset($_GET['event'])){
                        $event_id = $_GET['event'];

                        $sql = "select * from event WHERE event_id = $event_id";
                        $res = mysqli_query($connect, $sql);

                        $data = mysqli_fetch_assoc($res);

                    }
                    ?>
                    <div class="col-md-8 col-sm-12 float-left mt-3 mb-3" s>
                        <div class="card">
                            <div class="card-header">
                                <img src="images/<?php echo $data['event_image']?>" style="height: 250px" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h3 class="text-center"><?php echo $data['event_title']?></h3>
                                <p><span class="font-weight-bold">Event Price : </span><?php echo number_format($data['event_price'], 2)?> T.K</p>
                                <p><span class="font-weight-bold">Start Date : </span><?php echo $data['start_date']?></p>
                                <p><span class="font-weight-bold">Booking Limit : </span><?php echo $data['book_limit']?></p>
                                <p class="font-weight-bold"><span class="font-weight-bold">Registration Last Date : </span><span class="text-danger"><?php echo $data['end_date']?></span></p>
                                <p><span class="font-weight-bold text-justify">Description : </span> <?php echo $data['description']?></p>
                            </div>
                            <div class="card-footer">
                                <a href="book_now.php?event=<?php echo $data['event_id'];?>" class="float-right btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 float-left mt-3 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">More Event</h3>
                            </div>
                            <?php
                                $sql_get_event = "SELECT * FROM event WHERE event_status = '0'"; //fetch all data from blog table
                                $res_event     = mysqli_query($connect, $sql_get_event); //execute query
                            while ($row = mysqli_fetch_assoc($res_event)){?>
                                <div class="card-body" style="border-bottom: 1px solid silver">
                                    <img class="float-left" src="images/<?php echo $row['event_image'];?>"  style="height: 100px; width: 100px; margin: 9px">
                                    <p style="text-align: justify; padding: 3px; margin-top: -40p%">
                                        <span class="font-weight-bold"><?php echo $row['event_title'];?></span><br/>
                                        <?php
                                        $blog_id = $row['event_id'];
                                        $desc = $row['description'];
                                        $strcut = substr($desc,0,100);
                                        $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="event_dtls.php?event='.$blog_id.'" class="text-decoration-none">Read More</a>';
                                        echo $desc;
                                        ?>
                                    </p>
                                </div>
                            <?php }?>
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
