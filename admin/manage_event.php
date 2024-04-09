<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 6:29 PM
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
                <li class="breadcrumb-item active">All Event Payment</li>
            </ol>

            <!-- Icon Cards-->

            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>All Event Payment</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Select Event</label>
                                    <select class="form-control" name="batch_id"  onchange="showUser(this.value)">
                                        <option>------------Select One----------</option>
                                        <?php
                                        $sql_batch = "SELECT * FROM event, event_post WHERE event_post.event_id = event.event_id";
                                        $result_batch = mysqli_query($connect, $sql_batch);

                                        while ($row = mysqli_fetch_assoc($result_batch)){?>
                                            <option value="<?php echo $row['event_id'];?>"><?php echo $row['event_title'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div id="txtHint"></div>
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

<script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","getpayment.php?q="+str,true);
            xmlhttp.send();
        }
    }
</script>
</body>
</html>

