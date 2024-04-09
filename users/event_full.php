<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/22/2020
 * Time: 9:13 PM
 */
?>

<?php
include 'top_header.php';
?>

<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark m-0 p-0">
    <?php include 'nav.php'?>
</nav>

<section class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-5 mb-5">

                <div class="card">
                    <div class="card-header">
                        <?php include "side_bar.php";?>
                    </div>

                    <div class="card-body">
                        <?php
                            //get event by event id
                            if (isset($_GET['event'])){
                                $event_id = $_GET['event'];

                                $sql = "select * from event WHERE event_id = $event_id";
                                $res = mysqli_query($connect, $sql);

                                $data = mysqli_fetch_assoc($res);

                            }
                        ?>
                        <div class="col-md-8 mx-auto mt-2">
                            <div class="card">
                                <img src="../images/<?php echo $data['event_image']?>" style="height: 250px" class="card-img-top">

                                <div class="card-body">
                                    <h3 class="text-center"><?php echo $data['event_title']?></h3>
                                    <p><span class="font-weight-bold">Event Price : </span><?php echo number_format($data['event_price'], 2)?> T.K</p>
                                    <p><span class="font-weight-bold">Start Date : </span><?php echo $data['start_date']?></p>
                                    <p><span class="font-weight-bold">Booking Limit : </span><?php echo $data['book_limit']?></p>
                                    <p class="font-weight-bold"><span class="font-weight-bold">Registration Last Date : </span><span class="text-danger"><?php echo $data['end_date']?></span></p>
                                    <p><span class="font-weight-bold text-justify">Description : </span> <?php echo $data['description']?></p>
                                </div>
                                <div class="card-footer">
                                    <a href="edit_event.php?event=<?php echo $data['event_id'];?>" class="btn btn-primary float-right">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="footer bg-dark">
    <?php include "../footer.php";?>
</section>

<?php
include "script.php";
?>
</body>
</html>



