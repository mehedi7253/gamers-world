<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/22/2020
 * Time: 8:12 PM
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
                        <h3 class="text-center">My Event List</h3>

                        <h3 class="ml-3">
                            <?php
                            if (isset($_SESSION['success'])){
                                echo '<span class="text-success">'.$_SESSION['success'].'</span>';

                                unset($_SESSION['success']);
                            }

                            if (isset($_SESSION['error'])){
                                echo '<span class="text-danger">'.$_SESSION['error'].'</span>';

                                unset($_SESSION['error']);
                            }

                            ?>
                        </h3>
                        <?php
                            // get all event list which i have create
                            $get_event = "SELECT * FROM event WHERE user_id = $userdata[user_id]";
                            $res_get   = mysqli_query($connect, $get_event);

                            while ($row = mysqli_fetch_assoc($res_get)){?>
                                <div class="col-md-6 col-sm-12 float-left">
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h3><?php echo $row['event_title']?></h3>
                                        </div>
                                        <div class="card-body">
                                            <label class="font-weight-bold">Price : <?php echo number_format($row['event_price'], 2);?> T.K</label><br/>
                                            <label class="font-weight-bold">Start Date : <?php echo $row['start_date'];?></label><br/>
                                            <label class="font-weight-bold">booking Limit : <?php echo $row['book_limit'];?></label><br/>
                                            <label class="font-weight-bold">Registration Last Date : <span class="text-danger"><?php echo $row['end_date'];?></span></label><br/>
                                        </div>
                                        <div class="card-footer">
                                            <a href="edit_event.php?event=<?php echo $row['event_id'];?>" class="btn btn-primary float-left">Edit</a>
                                            <a href="event_full.php?event=<?php echo $row['event_id'];?>" class="btn btn-success float-right">View Full Details</a>
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
    <?php include "../footer.php";?>
</section>

<?php
include "script.php";
?>
</body>
</html>



