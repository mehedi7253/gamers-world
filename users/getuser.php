<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 7/8/2020
 * Time: 3:27 PM
 */

    include '../php/db_connect.php';

    $q = intval($_GET['q']);
    $sql="SELECT * FROM booking, event, users WHERE
        booking.event_id = event.event_id AND
        booking.user_id = users.user_id AND 
        booking.event_id = '".$q."'";
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
            <th>Date</th>
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
                <td><?php echo $row['booking_date'];?></td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>