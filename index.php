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
    <?php include 'nav.php'?>
</nav>
<section class="slider">
    <div class="slide_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-7 col-sm-12 float-left">
                        <h2 class="text-white font-weight-bold font-italic d-none d-lg-block" style="font-size: 70px; font-weight: 700; text-shadow: 5px 5px 3px #000; margin-top: 170px"><span style="color:yellow;">Gamers</span> <br/>
                            <span style="margin-left: 160px; color: red;">World</span>
                        </h2>
                    </div>
                    <div class="col-md-5 col-sm-12 float-left mt-5">
                        <div class="card mb-5 mt-5" style="border-color: #040507;">
                            <div class="card-header" style="background-color: green">
                                <h5 class="text-capitalize text-white text-center">Contact With us</h5>
                            </div>
                            <div class="card-body" style="background-color: #040507">
                                <?php
                                if (isset($_POST['btn']))
                                {
                                    $name    = $_POST['name'];
                                    $phone   = $_POST['phone'];
                                    $email   = $_POST['email'];
                                    $message = $_POST['message'];


                                    if ($name && $phone && $email && $message)
                                    {
                                        $date = date('Y-m-d');
                                        $sql_msg = "INSERT INTO public_msg (name, phone, email, message, date) VALUES ('$name', '$phone', '$email', '$message', '$date')";
                                        $res_msg = mysqli_query($connect, $sql_msg);

                                        echo "<span class='text-success'>Message Sent Successful</span>";
                                    }
                                }
                                ?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="phone" placeholder="Enter Your Phone Number" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Write Your Message" name="message" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success float-right" name="btn" value="Send Now">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about" id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-5 mt-5">
                <h3 class="text-center mt-4">About Us</h3>
                <?php
                    $about    = "SELECT * FROM about_us LIMIT 1";
                    $res_about = mysqli_query($connect, $about);


                ?>
                <?php while ($about_us = mysqli_fetch_assoc($res_about)){?>
                    <div class="text-justify mt-3">
                        <p class="text-justify"><?php echo $about_us['description'];?></p>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</section>

<section class="event" id="event" style="background-color: #cce5ff">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-5 mt-5">
                <h3 class="text-center mt-4">Event</h3>

                <?php
                    $event = "SELECT * FROM event LIMIT 3";
                    $res_ev = mysqli_query($connect, $event);

                    while ($events = mysqli_fetch_assoc($res_ev)){?>
                    <div class="col-md-4 col-sm-12 float-left mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h3><?php echo $events['event_title']?></h3>
                            </div>
                            <div class="card-body">
                                <label class="font-weight-bold">Price : <?php echo number_format($events['event_price'], 2);?> T.K</label><br/>
                                <label class="font-weight-bold">Start Date : <?php echo $events['start_date'];?></label><br/>
                                <label class="font-weight-bold">Registration Last Date : <span class="text-danger"><?php echo $events['end_date'];?></span></label><br/>
                            </div>
                            <div class="card-footer">
                                 <a href="event_dtls.php?event=<?php echo $events['event_id'];?>" class="btn btn-info float-right">Details</a>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
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