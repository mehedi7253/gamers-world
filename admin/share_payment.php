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
                <li class="breadcrumb-item active">Share payment To Event Creator</li>
            </ol>

            <!-- Icon Cards-->

            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto mb-5 mt-5">
                        <div class="card" style="background-color: #E3106D; ">
                            <div class="card-header">
                                <h3 class="text-white"><span class="ml-3 text-white font-weight-bold"><img src="../images/bkas.JPG" style="width: 50px; height: 50px; color: white"> Bkash </span></h3>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_GET['event'])){
                                    $id = $_GET['event'];

                                    $sql = "SELECT * FROM event WHERE event_id = $id";
                                    $res = mysqli_query($connect, $sql);

                                }
                                if (isset($_POST['bkas']))
                                {

                                    $total_earn = "SELECT pay_amount, SUM(pay_amount) AS Total FROM booking_invoice WHERE booking_invoice.event_id = $id";
                                    $res_total = mysqli_query($connect, $total_earn);

                                    $total = mysqli_fetch_assoc($res_total);

                                    $event_total = $total['Total'];
                                    $percent  = $event_total * 85/100;

                                    $create = date('Y-m-d');

                                    $account_number = $_POST['account_number'];

                                    if ($account_number == ''){
                                        echo "<span class='text-white ml-5 mt-3'>Please Enter BKash Number</span>";
                                    }
                                    if ($account_number) {
                                        $sql_pay = "INSERT INTO event_payment_invoice (payment, event_id, percent, payment_date, account_number) VALUES ('$percent', '$id', '85%', '$create', '$account_number')";
                                        $res_pay = mysqli_query($connect, $sql_pay);

                                        echo "<script>document.location.href='next_bkas.php?event=$id'</script>";
                                    }
                                }
                                ?>
                                <form action="" method="post" class="mt-4">
                                    <div class="form-group col-md-10 mx-auto">
                                        <label class="text-white">Bkash Number</label>
                                        <input type="text" name="account_number"  class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX">
                                    </div>
                                    <div class="form-group  col-md-10 mx-auto">
                                        <input type="checkbox"> <span class="text-white">I Agree To The Term And Condition</span>
                                    </div>
                                    <div class="form-group col-10 mx-auto">
                                        <label></label>
                                        <input type="submit" name="bkas" class="btn btn-success col-md-5" value="Next">
                                        <a href="pay_now.php" type="reset" class="btn btn-danger col-md-5">Cancel</a>
                                    </div>
                                </form>
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

