<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 9:30 AM
 */
include '../php/db_connect.php';

    $q = intval($_GET['q']);
    $sql="SELECT * FROM booking, event, users, booking_invoice WHERE
        booking_invoice.event_id = event.event_id AND
        booking_invoice.user_id = users.user_id AND
        booking_invoice.booking_id = booking.booking_id AND 
        booking_invoice.event_id = '".$q."'";
    $result = mysqli_query($connect,$sql);

?>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Event</th>
            <th>Price</th>
            <th>Payment By</th>
            <th>Invoice</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i =1;
        while ($row = mysqli_fetch_assoc($result)){?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $row['first_name'].' '.$row['last_name'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['event_title'];?></td>
                <td><?php echo number_format($row['event_price'], 2);?>T.K</td>
                <td><?php echo $row['payment_by'];?></td>
                <td>
                    <a href="invoice.php?invoice=<?php echo $row['invoice_number'];?>"><?php echo $row['invoice_number'];?></a>
                </td>
            </tr>
        <?php }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><span class="float-right">Total Amount <br/><span class="text-danger float-left">[N.B-Without COD]</span></span></td>
                <td>
                    <?php
                        $total_earn = "SELECT pay_amount, SUM(pay_amount) AS Total FROM booking_invoice WHERE booking_invoice.event_id = '".$q."'";
                        $res_total = mysqli_query($connect, $total_earn);

                        $total = mysqli_fetch_assoc($res_total);

                        echo number_format($total['Total'], 2).' '.'T.K';
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
