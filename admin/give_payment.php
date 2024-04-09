<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 7:35 PM
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
                <li class="breadcrumb-item active">Give payment To Event Creator</li>
            </ol>

            <!-- Icon Cards-->

            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>Give payment To Event Creator</h3>
                            </div>
                            <div class="card-body">
                                <h4>
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
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Event Name</th>
                                            <th>Total Earn</th>
                                            <th>Give Amount</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $sql_payment = "SELECT * FROM booking_invoice, event WHERE booking_invoice.event_id = event.event_id GROUP BY booking_invoice.event_id";
                                            $res_payment = mysqli_query($connect, $sql_payment);
                                        $i =1;
                                        while ($row = mysqli_fetch_assoc($res_payment)){?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row['event_title'];?></td>
                                                <td>
                                                    <?php
                                                        $total_earn = "SELECT pay_amount, SUM(pay_amount) AS Total FROM booking_invoice WHERE booking_invoice.event_id = $row[event_id]";
                                                        $res_total = mysqli_query($connect, $total_earn);

                                                        $total = mysqli_fetch_assoc($res_total);

                                                        echo number_format($total['Total'], 2).' '.'T.K';
                                                    ?>
                                                </td>
                                                <td>85%</td>
                                                <td>
                                                    <?php

                                                        $event_total = $total['Total'];
                                                        $percent  = $event_total * 85/100;

                                                        echo number_format($percent,2).' '.'T.K';
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $sql = "SELECT * FROM event_payment_invoice WHERE event_id = $row[event_id]";
                                                        $res = mysqli_query($connect, $sql);

                                                        $count = mysqli_fetch_assoc($res);

                                                        if ($count == true){
                                                            echo "<a class='btn btn-success text-white'>Payment Complete</a>";
                                                        }else{
                                                            echo "
                                                                   <a href='share_payment.php?event=$row[event_id]' class='btn btn-success'>Give Now</a>
                                                            ";
                                                        }
                                                    ?>

                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                        </tbody>
                                    </table>
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

