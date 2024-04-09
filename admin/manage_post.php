<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 5:40 PM
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
                <li class="breadcrumb-item active">Manage Post</li>
            </ol>

            <!-- Icon Cards-->

            <!-- main content-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>All Event Post</h3>
                            </div>
                            <div class="card-body">

                                <?php
                                if (isset($_POST['search']))
                                {
                                    $searchKey = $_POST['src'];
                                    $sql_s = "SELECT * FROM  event, users, category WHERE 
                                                                event.event_id = event.event_id AND
                                                                event.user_id = users.user_id AND
                                                                event.category_id = category.category_id AND 
                                                                event.category_id = '$searchKey'";
                                    $res_s = mysqli_query($connect, $sql_s);

                                    $rows = $res_s->num_rows;
                                }
                                ?>
                                <form action="" method="post">
                                    <div class="form-group input-group col-md-4">
                                        <select class="form-control" name="src">
                                            <?php
                                                $sql = "SELECT * FROM category";
                                                $res = mysqli_query($connect, $sql);

                                               echo "<option>---Select Category----</option>";
                                                 while ($cat = mysqli_fetch_assoc($res)){?>
                                                        <option value="<?php echo $cat['category_id'];?>"><?php echo $cat['category_name'];?></option>
                                            <?php }
                                            ?>
                                        </select>
                                        <input type="submit" class="btn btn-info ml-2" name="search" value="Submit">
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Post By</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>View</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if (isset($_POST['search'])== true) {
                                                    if ($rows > 0) {
                                                        $i = 1;
                                                        while ($row = mysqli_fetch_assoc($res_s)) {?>
                                                            <tr>
                                                                <td><?php echo $i++;?></td>
                                                                <td><?php echo $row['event_title'];?></td>
                                                                <td class="text-capitalize"><?php echo $row['first_name'].' '.$row['last_name'];?></td>
                                                                <td><?php echo number_format($row['event_price'], 2);?> T.K</td>
                                                                <td><?php echo $row['category_name'];?></td>
                                                                <td>
                                                                    <?php
                                                                    $status = $row['event_status'];
                                                                    if (($status) == '0'){?>
                                                                        <a href="event_publish.php?status=<?php echo $row['event_id'];?>" class="btn btn-success" onclick="return confirm('Are You Sure To Un-publish')">Published</a>
                                                                        <?php
                                                                    }
                                                                    if (($status) == '1'){?>
                                                                        <a href="event_publish.php?status=<?php echo $row['event_id'];?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Published')">Publish Now</a>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <a href="event_dtls.php?event=<?php echo $row['event_id'];?>" class="btn btn-primary">More</a>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                } else {
                                                    $sql_get_event = "SELECT * FROM event, users, category WHERE 
                                                                    event.event_id = event.event_id AND
                                                                    event.user_id = users.user_id AND
                                                                    event.category_id = category.category_id"; //fetch all data from event table
                                                    $res_event    = mysqli_query($connect, $sql_get_event); //execute query

                                                    $i = 1;
                                                    while ($data = mysqli_fetch_assoc($res_event)){?>
                                                        <tr>
                                                            <td><?php echo $i++;?></td>
                                                            <td><?php echo $data['event_title'];?></td>
                                                            <td class="text-capitalize"><?php echo $data['first_name'].' '.$data['last_name'];?></td>
                                                            <td><?php echo number_format($data['event_price'], 2);?> T.K</td>
                                                            <td><?php echo $data['category_name'];?></td>
                                                            <td>
                                                                <?php
                                                                $status = $data['event_status'];
                                                                if (($status) == '0'){?>
                                                                    <a href="event_publish.php?status=<?php echo $data['event_id'];?>" class="btn btn-success" onclick="return confirm('Are You Sure To Un-publish')">Published</a>
                                                                    <?php
                                                                }
                                                                if (($status) == '1'){?>
                                                                    <a href="event_publish.php?status=<?php echo $data['event_id'];?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Published')">Publish Now</a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a href="event_dtls.php?event=<?php echo $data['event_id'];?>" class="btn btn-primary">More</a>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                }
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

