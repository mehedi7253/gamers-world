<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 6:04 PM
 */
?>

<?php include "front/header.php"; ?>

<body id="page-top">

<?php include "front/nav.php";?>



<div id="wrapper">
    <?php include "front/sidebar.php";?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Full Event Details</li>
            </ol>

            <!-- Icon Cards-->

            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-5">
                        <?php
                        //get event by event id
                        if (isset($_GET['event'])){
                            $event_id = $_GET['event'];

                            $sql = "select * from users, event WHERE event.user_id = users.user_id AND event_id = $event_id";
                            $res = mysqli_query($connect, $sql);

                            $data = mysqli_fetch_assoc($res);

                        }
                        ?>
                        <div class="col-md-8 mx-auto mt-3 mb-3" s>
                            <div class="card">
                                <div class="card-header">
                                    <img src="../images/<?php echo $data['event_image']?>" style="height: 250px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h3 class="text-center"><?php echo $data['event_title']?></h3>
                                    <p><span class="font-weight-bold">Event Price : </span><?php echo number_format($data['event_price'], 2)?> T.K</p>
                                    <p><span class="font-weight-bold">Start Date : </span><?php echo $data['start_date']?></p>
                                    <p class="font-weight-bold"><span class="font-weight-bold">Registration Last Date : </span><span class="text-danger"><?php echo $data['end_date']?></span></p>
                                    <p><span class="font-weight-bold text-justify">Description : </span> <?php echo $data['description']?></p>
                                </div>
                                <div class="card-footer">
                                    <p class="font-weight-bold float-right font-italic">Post By : <?php echo $data['first_name'].' '.$data['last_name'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of main content-->
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <?php include "../admin/front/main_footer.php";?>
        </footer>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<?php include "front/footer.php";?>

</body>
</html>

