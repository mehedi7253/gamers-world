<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/23/2020
 * Time: 10:34 AM
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
                <li class="breadcrumb-item active">Manage Category</li>
            </ol>

            <!-- Icon Cards-->

            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-5 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>Manage Category</h3>
                            </div>
                            <div class="card-body">
                                <h3 class="ml-2 mb-3">
                                    <?php
                                    if (isset($_SESSION['success'])){
                                        echo '<span class="text-success p-5">'.$_SESSION['success'].'</span>';

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
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $sql = "SELECT * FROM category";
                                            $res = mysqli_query($connect, $sql);

                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($res)){?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo $row['category_name'];?></td>
                                                    <td>
                                                        <a href="edit_cat.php?category=<?php echo $row['category_id'];?>" class="btn btn-primary text-white">Edit</a> |
                                                        <a href="delete.php?category=<?php echo $row['category_id'];?>" class="btn btn-danger text-white">Delete</a>
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

