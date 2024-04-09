<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/23/2020
 * Time: 10:26 PM
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
                        <div class="col-md-10 mx-auto">
                            <div class="card">
                                <div class="card-header" >
                                    <h4>My Invoice</h4>
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
<script type="application/javascript">
    // print invoice
    $(document).ready(function () {

        $('#prntPSS').click(function() {
            var printContents = $('#mainFrame').html();
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        });

    });
</script>
</body>
</html>



