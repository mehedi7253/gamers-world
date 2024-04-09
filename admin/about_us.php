<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 9:27 PM
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
                <li class="breadcrumb-item active">About US</li>
            </ol>

            <!-- Icon Cards-->

            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto mb-5 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add About US</h3>
                            </div>
                            <div class="card-body">
                                <h5>
                                    <?php
                                    if (isset($_POST['btn']))
                                    {
                                        $sql = "insert into about_us (description) VALUES ('$_POST[description]')";
                                        $res = mysqli_query($connect, $sql);

                                        if ($res){
                                            echo "<span class='text-success'>About Us Added Successful</span>";
                                        }else{
                                            echo "<span class='text-danger'>About Us Added Successful</span>";

                                        }
                                    }
                                    ?>
                                </h5>

                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="application" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="btn" class="btn btn-success" value="Add About US">
                                    </div>
                                </form>
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

