<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/23/2020
 * Time: 9:28 PM
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
                        <h3 class="text-center mt-3 mb-3">Payment Now</h3>

                        <?php
                            if (isset($_GET['pay']))
                            {
                                $book_id = $_GET['pay'];

                                $sql = "SELECT * FROM booking, event, users WHERE 
                                        booking.event_id = event.event_id AND 
                                        booking.user_id = users.user_id AND 
                                        booking.booking_id = $book_id";

                                $res = mysqli_query($connect, $sql);

                                $data = mysqli_fetch_assoc($res);

                            }
                        ?>

                        <div class="col-md-10 mx-auto">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <nav>
                                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="background-color: #E3106D; "><span class="ml-3 text-dark font-weight-bold"><img src="../images/bkas.JPG" style="width: 50px; height: 50px; color: white"> Bkash </span> </a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="background-color: #fcf8e3"> <span class="ml-3 mt-2 text-dark font-weight-bold"> Cash On Delivery</span></a>
                                        </div>
                                    </nav>

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="card-body" style="background-color: #E3106D">
                                                <?php
                                                if (isset($_POST['bkas']))
                                                {
                                                    $user_id          = $_POST['user_id'];
                                                    $booking_id       = $_POST['booking_id'];
                                                    $account_number   = $_POST['account_number'];
                                                    $price            = $_POST['price'];
                                                    $event_id         = $_POST['event_id'];
                                                    $invoice = (rand(10,1000000));
                                                    $create = @date('Y-m-d H:i:s');

                                                    if ($account_number == "")
                                                    {
                                                        echo "<span class='text-white ml-5'>Enter your Bkash Number</span><br/>";
                                                    }
                                                    if ($account_number) {
                                                        $sql_bkas = "INSERT INTO booking_invoice (account_number, user_id, booking_id, invoice_number, payment_by, price, event_id, payment_date) VALUES ('$account_number', '$user_id', '$booking_id', '$invoice', 'Bkash', '$price', '$event_id', '$create')";
                                                        $res_bkas = mysqli_query($connect, $sql_bkas); // connect with query and database
                                                        echo "<script>document.location.href='bkas_next.php?pay=$book_id'</script>";
                                                    }
                                                }
                                                ?>
                                                <form action="" method="post" class="mt-4">
                                                    <div class="form-group col-md-10 mx-auto">
                                                        <label class="text-white">Bkash Number</label>
                                                        <input name="user_id" hidden value="<?php echo $userdata['user_id'];?>">
                                                        <input name="booking_id" hidden value="<?php echo $data['booking_id'];?>">
                                                        <input name="event_id" hidden  value="<?php echo $data['event_id'];?>">
                                                        <input name="price" hidden value="<?php echo $data['event_price'];?>">
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

                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <div class="card-body" style="background-color: #fcf8e3;">
                                                <?php
                                                if (isset($_POST['cod']))
                                                {
                                                    $user_id          = $_POST['user_id'];
                                                    $booking_id       = $_POST['booking_id'];
                                                    $price            = $_POST['price'];
                                                    $event_id         = $_POST['event_id'];

                                                    $invoice = (rand(10,1000000));
                                                    $create = @date('Y-m-d H:i:s');

                                                        $sql_bkas = "INSERT INTO booking_invoice (account_number, user_id, booking_id, invoice_number, payment_by, price, event_id, payment_date) VALUES ('Cash On Delivary', '$user_id', '$booking_id', '$invoice', 'COD', '$price', '$event_id', '$create')";
                                                        $res_bkas = mysqli_query($connect, $sql_bkas); // connect with query and database

                                                        $_SESSION['success'] = 'Your Payment Will Receive Event Organizer By COD Method';
                                                        echo "<script>document.location.href='my_booking_payment.php'</script>";
                                                }
                                                ?>
                                                <form action="" method="post" class="mt-4">
                                                    <div class="form-group col-md-10 mx-auto">
                                                        <input name="user_id" hidden value="<?php echo $userdata['user_id'];?>">
                                                        <input name="booking_id" hidden value="<?php echo $data['booking_id'];?>">
                                                        <input name="event_id" hidden  value="<?php echo $data['event_id'];?>">
                                                        <input name="price" hidden value="<?php echo $data['event_price'];?>">
                                                    </div>
                                                    <div class="form-group col-md-10 mx-auto">
                                                        <input name="event_id" disabled class="form-control"  value="<?php echo $data['event_title'];?>">
                                                    </div>
                                                    <div class="form-group col-md-10 mx-auto">
                                                        <input name="event_id" disabled class="form-control"  value="<?php echo number_format($data['event_price'], 2);?>">
                                                    </div>
                                                    <div class="form-group col-md-10 mx-auto">
                                                        <input name="event_id" disabled class="form-control"  value="<?php echo $userdata['first_name'].' '.$userdata['last_name'];?>">
                                                    </div>
                                                    <div class="form-group col-md-10 mx-auto">
                                                        <input name="event_id" disabled class="form-control"  value="<?php echo $userdata['phone'];?>">
                                                    </div>
                                                    <div class="form-group col-10 mx-auto">
                                                        <label></label>
                                                        <input type="submit" name="cod" class="btn btn-success col-md-5" value="Submit">
                                                        <a href="pay_now.php" type="reset" class="btn btn-danger col-md-5">Cancel</a>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
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
</body>
</html>



