<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/23/2020
 * Time: 9:08 PM
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
                        <h3 class="text-center mt-4 mb-3">My Booking Payment </h3>

                        <h3 class="ml-5">
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

                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event</th>
                                    <th>Price</th>
                                    <th>Booking Date</th>
                                    <th>Payment Status</th>
                                    <th>Invoice</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql_event = "SELECT * FROM booking, event WHERE booking.event_id = event.event_id AND booking.user_id = $userdata[user_id]";
                                $result_event = mysqli_query($connect, $sql_event);

                                $i =1;
                                while ($row = mysqli_fetch_assoc($result_event)){?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $row['event_title'];?></td>
                                        <td><?php echo number_format($row['event_price'], 2);?>T.K</td>
                                        <td><?php echo $row['booking_date'];?></td>
                                        <td>
                                            <?php
                                                $booking_id = $row['booking_id'];
                                                $sql_invoice = "SELECT * FROM booking_invoice, users, event, booking WHERE 
                                                                booking_invoice.booking_id = $booking_id AND 
                                                                booking_invoice.event_id = event.event_id AND 
                                                                booking_invoice.user_id = '$userdata[user_id]'";
                                                $res_invoice = mysqli_query($connect, $sql_invoice);

                                                $pay_btn = mysqli_fetch_assoc($res_invoice);

                                                if ($pay_btn == 0){
                                                    echo "<a href='pay_now.php?pay=$row[booking_id]' class='btn btn-info'>Pay Now</a>";
                                                }else{
                                                    echo "<a class='btn btn-success text-white'>Paid</a>";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($pay_btn == 0){
                                                echo "<a class='btn btn-danger text-white'>Pay First</a>";
                                            }else{
                                                echo "<a href='invoice.php?invoice=$pay_btn[invoice_number]' class='btn btn-success'>Invoice</a>";

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
</section>


<section class="footer bg-dark">
    <?php include "../footer.php";?>
</section>

<?php
include "script.php";
?>
</body>
</html>



