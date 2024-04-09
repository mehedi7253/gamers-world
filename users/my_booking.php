
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
                        <h3 class="mb-5 mt-4 text-center">My Booking List</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event</th>
                                    <th>Date</th>
                                    <th>Withdraw</th>
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
                                        <td><?php echo $row['booking_date'];?></td>
                                        <td>
                                            <?php
                                                $sql = "select * from booking_invoice, users, event WHERE 
                                                        booking_invoice.event_id = $row[event_id] AND 
                                                        booking_invoice.user_id = $userdata[user_id]
                                                       ";

                                                $res = mysqli_query($connect, $sql);

                                                $cancel = mysqli_fetch_assoc($res);

                                                if ($cancel == true){
                                                    echo "<a class='text-danger'> You Can Not Able To withdraw Now</a>";
                                                }else{
                                                    echo "<a href='delete.php?withdraw=$row[booking_id]' class='btn btn-danger'>Withdraw</a>";
                                                }
                                            ?>
<!--                                            <a href="delete.php?=--><?php //echo $row['booking_id'];?><!--" class="btn btn-danger" onclick="return confirm('Are You Sure To Withdraw')"></a>-->
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


