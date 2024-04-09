<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 9:48 PM
 */

include "front/header.php"; ?>

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
                <li class="breadcrumb-item active">Public Message</li>
            </ol>

            <!-- Icon Cards-->

            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">All Message List</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                //get all message
                                $sql = "SELECT * FROM public_msg";
                                $res = mysqli_query($connect, $sql);
                                ?>
                                <?php

                                if (isset($_SESSION['success'])){
                                    echo '<span class="text-success">'.$_SESSION['success'].'</span>';

                                    unset($_SESSION['success']);
                                }

                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="bootstrap-data-table">
                                        <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        <?php
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($res)){?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td class="text-capitalize"><?php echo $row['name'];?></td>
                                                <td><?php echo $row['phone'];?></td>
                                                <td><?php echo $row['email'];?></td>
                                                <td><?php echo $row['message'];?></td>
                                                <td><?php echo $row['date'];?></td>
                                                <td>
                                                    <a href="delete.php?msg=<?php echo $row['id'];?>" class="btn btn-danger"> Delete</a>
                                                </td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
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

</body>
</html>
