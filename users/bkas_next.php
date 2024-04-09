<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/23/2020
 * Time: 10:02 PM
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
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-header" style="background-color: #E3106D">
                                    <h2 class="text-white text-center">Pay By Bkash</h2>
                                    <?php
                                    if (isset($_GET['pay'])){
                                        $id = $_GET['pay'];

                                        $sql = "SELECT * FROM booking, booking_invoice WHERE booking_invoice.booking_id = $id";
                                        $res = mysqli_query($connect, $sql); // connect with query and database

                                        $customer_data = mysqli_fetch_assoc($res);

                                        if (isset($_POST['btn']))
                                        {
                                            $pay_amount = $_POST['pay_amount'];
                                            $sql_up = "UPDATE booking_invoice SET pay_amount = '$pay_amount' WHERE booking_id = $id"; // update payment
                                            $res    = mysqli_query($connect, $sql_up); // connect with query and database

                                            $_SESSION['success'] = 'Payment Successful';
                                            echo "<script>document.location.href='my_booking_payment.php'</script>";
                                        }
                                        if (isset($_POST['cancel']))
                                        {
                                            $sql_up = "DELETE FROM booking_invoice WHERE booking_id = $id"; // cancel payment
                                            $res    = mysqli_query($connect, $sql_up); // connect with query and database

                                            $_SESSION['error'] = 'Payment Canceled';
                                            echo "<script>document.location.href='my_booking_payment.php'</script>";
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="card-body" style="background-color: #E3106D">
                                    <div class="col-md-8 mx-auto">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label class="text-white">Enter Amount</label>
                                                <input type="text"  name="pay_amount" hidden class="form-control" value="<?php echo $customer_data['price'];?>">
                                                <input type="text" disabled class="form-control" value="<?php echo number_format($customer_data['price'], 2);?>">

                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox"> <span class="text-white ml-2">I Agree To The Term And Condition</span>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn col-md-5 p-1" value="Submit" name="btn" style="background-color: #B6195E; color: white">
                                                <input type="submit" class="btn col-md-5 p-1" value="Cancel" name="cancel" style="background-color: #B6195E; color: white">
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
</section>


<section class="footer bg-dark">
    <?php include "../footer.php";?>
</section>

<?php
include "script.php";
?>
</body>
</html>



