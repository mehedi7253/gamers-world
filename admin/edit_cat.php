<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 3:24 PM
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
                <li class="breadcrumb-item active">Update Category</li>
            </ol>

            <!-- Icon Cards-->

            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto mt-5 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>Update Category</h3>
                                <?php
                                    if (isset($_GET['category']))
                                    {
                                        $id = $_GET['category'];

                                        $sql = "SELECT * FROM category WHERE category_id = '$id'";
                                        $res = mysqli_query($connect, $sql);

                                        $data = mysqli_fetch_assoc($res);
                                    }

                                    if (isset($_POST['btn']))
                                    {
                                        $category_id   = $_POST['category_id'];
                                        $category_name = $_POST['category_name'];

                                        $update = "UPDATE category SET category_name = '$category_name' WHERE category_id = $category_id";
                                        $res_up = mysqli_query($connect, $update);

                                        if ($res_up){
                                            $_SESSION['success'] = 'Category Update Successful';
                                            echo "<script>document.location.href='manage_category.php'</script>";
                                        }else{
                                            $_SESSION['error'] = 'Category Update Failed';
                                            echo "<script>document.location.href='manage_category.php'</script>";
                                        }
                                    }
                                ?>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" hidden name="category_id" value="<?php echo $data['category_id'];?>" class="form-control">
                                        <input type="text" name="category_name" value="<?php echo $data['category_name'];?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="btn"  class="btn btn-success" value="Update Category">
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

