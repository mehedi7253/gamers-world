<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 6:38 PM
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
                <li class="breadcrumb-item active">Invoice</li>
            </ol>

            <!-- Icon Cards-->

            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto mt-4 mb-5">
                        <div class="card">
                            <div class="card-header" >
                                <h4> Invoice</h4>
                                <?php
                                if (isset($_GET['invoice'])){
                                    $invoice = $_GET['invoice'];

                                    $sql1 = "SELECT * FROM booking_invoice, users WHERE booking_invoice.user_id = users.user_id AND invoice_number = '$invoice'"; // select invoice by user id
                                    $res1 = mysqli_query($connect, $sql1); // connect with query and database
                                    $data1 = mysqli_fetch_assoc($res1);

                                }
                                ?>
                            </div>
                            <div class="card-body" id="mainFrame">
                                <div class="col-md-12">
                                    <div class="invoice-title">
                                        <div class="invoice-number font-weight-bold">Invoice Number:  #<?php echo $data1['invoice_number'];?>
                                            <span class="float-right">
                                        </span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>Billed To:</strong><br>
                                                <span class="text-capitalize"><?php echo $data1['first_name']. ' '.$data1['last_name'];?></span><br>
                                                <?php echo $data1['address'];?><br>
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>
                                                <strong>Payment Date:</strong><br>
                                                <?php echo $data1['payment_date'];?><br><br><br>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>Payment Method:</strong><br>
                                                <?php echo $data1['payment_by'];?><br>
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>
                                                <strong>Account Number:</strong><br>
                                                <?php echo $data1['account_number'];?><br><br><br>
                                            </address>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="section-title">Booking Summary</div>
                                            <p class="section-lead">All items here cannot be deleted.</p>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-md">
                                                    <tr>
                                                        <th class="text-center">Event Name</th>
                                                        <th class="text-center">Price</th>
                                                        <th class="text-center">Due</th>
                                                    </tr>
                                                    <?php
                                                    $sql = "SELECT * FROM booking, booking_invoice, event WHERE 
                                                                booking_invoice.booking_id = booking.booking_id AND
                                                                 booking_invoice.event_id = event.event_id AND 
                                                                 booking_invoice.invoice_number = '$invoice'"; // select user information and view invoice

                                                    $res = mysqli_query($connect, $sql); // connect with query and database
                                                    $i =1;
                                                    while ($row = mysqli_fetch_assoc($res)){?>
                                                        <tr>
                                                            <td><?php echo $row['event_title'];?></td>
                                                            <td class="text-center"><?php echo number_format($row['event_price'], '2');?> T.K</td>
                                                            <td class="text-right">
                                                                <?php
                                                                $pro_price = $row['price']; // total price
                                                                $pay_price = $row['pay_amount']; // totatl payble

                                                                $total_price = $pro_price - $pay_price; // due amount
                                                                echo number_format($total_price,2 ); // due amount
                                                                ?> T.K
                                                            </td>
                                                        </tr>
                                                    <?php }?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-md-right">
                                    <button class="btn btn-warning btn-icon icon-left" type="pss" id="prntPSS"><i class="fas fa-print"></i> Print</button>
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

