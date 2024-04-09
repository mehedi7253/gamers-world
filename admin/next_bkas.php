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
                    <div class="col-md-8 mx-auto mb-5 mt-5">
                        <div class="card" style="background-color: #E3106D; ">
                            <div class="card-header">
                                <h3 class="text-white"><span class="ml-3 text-white font-weight-bold"><img src="../images/bkas.JPG" style="width: 50px; height: 50px; color: white"> Bkash </span></h3>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_GET['event'])){
                                    $id = $_GET['event'];

                                    $sql = "SELECT * FROM event, event_payment_invoice WHERE event_payment_invoice.event_id = $id";
                                    $res = mysqli_query($connect, $sql); // connect with query and database

                                    $customer_data = mysqli_fetch_assoc($res);

                                }
                                if (isset($_POST['btn']))
                                {

                                    $sql_up = "UPDATE event_payment_invoice SET payment_by = 'Bkash' WHERE event_id = $id"; // update payment
                                    $res    = mysqli_query($connect, $sql_up); // connect with query and database

                                    $_SESSION['success'] = 'Payment Successful';
                                    echo "<script>document.location.href='give_payment.php'</script>";
                                }
                                if (isset($_POST['cancel']))
                                {
                                    $sql_up = "DELETE FROM event_payment_invoice WHERE event_id = $id"; // cancel payment
                                    $res    = mysqli_query($connect, $sql_up); // connect with query and database

                                    $_SESSION['error'] = 'Payment Canceled';
                                    echo "<script>document.location.href='give_payment.php'</script>";
                                }
                                ?>
                                <form action="" method="post">
                                    <div class="form-group col-md-6 mx-auto">
                                        <label class="text-white">Enter Amount</label>
                                        <input type="text" disabled class="form-control" value="<?php echo number_format($customer_data['payment'], 2);?>">

                                    </div>
                                    <div class="form-group col-md-6 mx-auto"">
                                        <input type="checkbox"> <span class="text-white ml-2">I Agree To The Term And Condition</span>
                                    </div>
                                    <div class="form-group col-md-6 mx-auto"">
                                        <input type="submit" class="btn col-md-5 p-1" value="Submit" name="btn" style="background-color: #B6195E; color: white">
                                        <input type="submit" class="btn col-md-5 p-1" value="Cancel" name="cancel" style="background-color: #B6195E; color: white">
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

