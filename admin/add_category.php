
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
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Add New Category</li>
            </ol>

            <!-- Icon Cards-->
            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add New Category</h3>
                            </div>
                            <div class="card-body">
                                <p>
                                    <?php
                                        if (isset($_POST['btn']))
                                        {
                                            $category_name = $_POST['category_name'];

                                            if ($category_name == ''){
                                                echo "<span class='text-danger'>Please Enter Category Name</span><br/>";
                                            }

                                            //add new category
                                            $sql_add_category = "INSERT INTO category (category_name) VALUES ('$category_name')";
                                            $res_categry      = mysqli_query($connect, $sql_add_category);

                                            if ($res_categry){
                                                echo "<span class='text-success'> Category Added Successful</span>";
                                            }else{
                                                echo "<span class='text-danger'> Category Added Failed</span>";
                                            }
                                        }
                                    ?>
                                </p>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" name="category_name" placeholder="Category Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="btn"  class="btn btn-success" value="Add New Category">
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
