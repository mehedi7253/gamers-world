
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
                <li class="breadcrumb-item active">Overview</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-6 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                    $sql = "SELECT count(user_id) AS totalUser FROM users WHERE role = 'user'"; //select all id from donor_php table
                                    $res = mysqli_query($connect, $sql);
                                    $values = mysqli_fetch_assoc($res);
                                    $num_rows = $values['totalUser']; //toatal number of available data in database
                                    echo "<span style='font-size: 30px;'>$num_rows</span>"; //print data
                                ?>

                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="manage_users.php">
                            <span class="float-left">Total User</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 mb-3">
                    <div class="card text-white bg-secondary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                    $sql = "SELECT count(event_id) AS TotalEvent FROM event"; //select all id from donor_php table
                                    $res = mysqli_query($connect, $sql);
                                    $values = mysqli_fetch_assoc($res);
                                    $num_rows = $values['TotalEvent']; //toatal number of available data in database
                                    echo "<span style='font-size: 30px;'>$num_rows</span>"; //print data
                                ?>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="manage_event.php">
                            <span class="float-left">Total Event</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>
            </div>

        <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-5">

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
