<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/23/2020
 * Time: 10:46 AM
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
                        <div class="col-md-8 mx-auto mt-2">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Add New Post</h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        <?php
                                            if (isset($_POST['btn']))
                                            {
                                                $user_id  = $_POST['user_id'];
                                                $event_id = $_POST['event_id'];
                                                $cat_id   = $_POST['category_id'];

                                                if ($user_id && $event_id && $cat_id){

                                                    $sql = "INSERT INTO event_post (user_id, event_id, category_id, post_status) VALUES ('$user_id', '$event_id', '$cat_id', '1')";
                                                    $res = mysqli_query($connect, $sql);

                                                    echo "<span class='text-success'>Event Post Successful</span>";
                                                }else{
                                                    echo "<span class='text-danger'>Event Post Failed</span>";
                                                }
                                            }
                                        ?>
                                    </p>
                                    <form action="" method="post">
                                        <input name="user_id" hidden value="<?php echo $userdata['user_id'];?>">
                                        <div class="form-group">
                                            <label>Select Category</label>
                                            <select name="category_id" class="form-control">
                                                <?php
                                                $get_cat = "SELECT * FROM category";
                                                $res_cat   = mysqli_query($connect, $get_cat);

                                                echo "<option>---------Select One--------</option>";

                                                while ($rows = mysqli_fetch_assoc($res_cat)){?>
                                                    <option value="<?php echo $rows['category_id'];?>"><?php echo $rows['category_name'];?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Select Your Event</label>
                                            <select name="event_id" class="form-control">
                                                <?php
                                                    $get_event = "SELECT * FROM event WHERE user_id = $userdata[user_id]";
                                                    $res_get   = mysqli_query($connect, $get_event);

                                                    echo "<option>---------Select One--------</option>";

                                                    while ($row = mysqli_fetch_assoc($res_get)){?>
                                                    <option value="<?php echo $row['event_id'];?>"><?php echo $row['event_title'];?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <input type="submit" name="btn" class="btn btn-success" value="Post Now">
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
</section>


<section class="footer bg-dark">
    <?php include "../footer.php";?>
</section>

<?php
include "script.php";
?>
</body>
</html>



