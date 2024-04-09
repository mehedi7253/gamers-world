<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/22/2020
 * Time: 3:18 PM
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
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="text-capitalize text-dark">Change Profile Picture</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($_POST['pic'])){
                                        $fileinfo = PATHINFO($_FILES['image']['name']); // file info
                                        $newfilename  = $fileinfo['filename']. "." .$fileinfo['extension']; // get file extention
                                        move_uploaded_file($_FILES['image']['tmp_name'],"../images/" .$newfilename); // get file path and upload image into path
                                        $location = $newfilename; // store image into path

                                        $update_profie_pic = "UPDATE users SET image = '$location' WHERE user_id = '$userdata[user_id]'"; // image upload into database
                                        mysqli_query($connect, $update_profie_pic); // connect with query and database


                                        $sql = "SELECT * FROM users WHERE user_id = '$userdata[user_id]'"; // get user id
                                        $records = mysqli_query($connect, $sql); // connect with query and database
                                        $count = mysqli_num_rows($records);

                                        if ($count == 1) {
                                            $row = mysqli_fetch_array($records);
                                            echo " $userdata[image]";

                                            echo "<script>document.location.href='change_pic.php'</script>";

                                        }
                                    }
                                    ?>
                                    <div class="text-center">
                                        <img src="../images/<?php echo $userdata['image'];?>" class="img-fluid" style="height: 200px; width: 200px; border-radius: 50%">
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Chose Photo</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="pic" class="btn btn-success" value="Change Profile Pic">
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


