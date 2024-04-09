<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 8:40 PM
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
                                <div class="card-header">
                                    <h3>My Payment From Admin</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Event Name</th>
                                                    <th>Amount</th>
                                                    <th>Amount Percent</th>
                                                    <th>Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = "SELECT * FROM event, event_payment_invoice, users WHERE 
                                                            event_payment_invoice.event_id = event.event_id AND
                                                            event.user_id = users.user_id AND 
                                                            event.user_id = '$userdata[user_id]'";
                                                    $res = mysqli_query($connect, $sql);

                                                    $i = 1;

                                                    while ($row = mysqli_fetch_assoc($res)){?>
                                                        <tr>
                                                            <td><?php echo $i++;?></td>
                                                            <td><?php echo $row['event_title']?></td>
                                                            <td><?php echo number_format($row['payment'], 2)?> T.K</td>
                                                            <td><?php echo $row['percent']?></td>
                                                            <td>
                                                                <a href="user_invoice.php?invoice=<?php echo $row['id'];?>"><?php echo $row['id']?></a>
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


