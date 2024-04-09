<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/23/2020
 * Time: 11:32 AM
 */
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

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

<section class="main_content mt-5">
    <div class="container">
        <div class="row">
            <?php
            $sql_get_event = "SELECT * FROM event, users, category WHERE
                             event.user_id = users.user_id AND 
                             event.event_id = event.event_id AND
                             event.category_id = category.category_id AND
                             event.event_status = '0' 
                             GROUP BY event.event_id"; //fetch all data from event table
            $res_event     = mysqli_query($connect, $sql_get_event); //execute query
            ?>
            <div class="col-md-3 col-sm-12 float-left mt-5 mb-5">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-center">All Category</h3>
                    </div>
                    <div class="card-body">
                        <?php
                            $sql_cat = "select * from category";
                            $res_Cat = mysqli_query($connect, $sql_cat);

                            while ($category = mysqli_fetch_assoc($res_Cat)){?>
                                <a href="category.php?category=<?php echo $category['category_id'];?>" class="text-decoration-none"><?php echo $category['category_name'];?></a><br/>
                        <?php }
                        ?>

                    </div>
                </div>
            </div>

            <div class="col-md-9 col-sm-12 float-left mb-5 mt-5">
                <h3 class="text-center font-weight-bold">Our All Events</h3>
                <div class="card">
                    <div class="card-body">
                        <?php while ($row = mysqli_fetch_assoc($res_event)){?>
                            <div class="col-md-12 col-sm-12 mt-4 float-left">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-md-5 mx-auto float-left p-2">
                                            <div class="card">
                                                <img src="images/<?php echo $row['event_image']?>" class="card-img-top" style="height: 200px">
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-12 float-left">
                                            <p class="font-weight-bold mt-3"><?php echo $row['event_title']?></p>
                                            <p class="font-italic font-weight-normal" style="font-size: 17px; color: darkred;margin-top: -3%; margin-left: 5%;">Category: <?php echo $row['category_name'];?> </p>

                                            <p class="text-justify">
                                                <?php
                                                $blog_id = $row['event_id'];
                                                $desc = $row['description'];
                                                $strcut = substr($desc,0,200); // after 430 word full content will not seen
                                                $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="event_dtls.php?event='.$row['event_id'].'" class="text-decoration-none">Read More</a>';
                                                echo $desc;
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <?php
                                        if (!isset($_SESSION['user'])){
                                            echo "<a href='users/like_unlike.php?like=$row[event_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";

                                            $sql_like_1 = "SELECT like_unlike, SUM(like_unlike) as TotaLike_1 FROM event_like WHERE event_like.event_id = $row[event_id]";
                                            $res_like_1 = mysqli_query($connect, $sql_like_1);

                                            $totla_like_1 = mysqli_fetch_assoc($res_like_1);

                                            if ($totla_like_1['TotaLike_1'] == 0) {
                                                echo "<span> 0 Like</span>";
                                            } else {
                                                echo "<span> $totla_like_1[TotaLike_1] Like</span>";
                                            }

                                        }else {
                                            $like_unlike = "SELECT * FROM event_like, users, event WHERE 
                                                                event_like.event_id = $row[event_id] AND 
                                                                event_like.user_id = $userdata[user_id]";

                                            $res_like_unlike = mysqli_query($connect, $like_unlike);

                                            $count = mysqli_fetch_assoc($res_like_unlike);

                                            if ($count == true) {
                                                if ($count['like_unlike'] == '0') {
                                                    echo "<a href='users/like_unlike.php?unlike_up=$row[event_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                                } else {
                                                    echo "<a href='users/like_unlike.php?unlike=$row[event_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-down'></i></button></a>";
                                                }
                                            } elseif ($count !== true) {
                                                echo "<a href='users/like_unlike.php?like=$row[event_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                            }


                                            $sql_like = "SELECT like_unlike, SUM(like_unlike) as TotaLike FROM event_like WHERE event_like.event_id = $row[event_id]";
                                            $res_like = mysqli_query($connect, $sql_like);

                                            $totla_like = mysqli_fetch_assoc($res_like);

                                            if ($totla_like['TotaLike'] == 0) {
                                                echo "<span> 0 Like</span>";
                                            } else {
                                                echo "<span> $totla_like[TotaLike] Like</span>";
                                            }

                                        }
                                        ?>
                                    </div>
                                </div>
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
