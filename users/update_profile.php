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
                        <h3 class="ml-2">
                            <?php
                            if (isset($_SESSION['success'])){
                                echo '<span class="text-success">'.$_SESSION['success'].'</span>';

                                unset($_SESSION['success']);
                            }

                            if (isset($_SESSION['error'])){
                                echo '<span class="text-danger">'.$_SESSION['error'].'</span>';

                                unset($_SESSION['error']);
                            }

                            ?>
                        </h3>
                        <h3 class="ml-3 mb-3">
                            <?php
                            if (isset($_POST['user_update']))
                            {
                                $id         = $_POST['user_id'];
                                $first_name = $_POST['first_name'];
                                $last_name  = $_POST['last_name'];
                                $phone      = $_POST['phone'];
                                $address    = $_POST['address'];
                                $gender     = $_POST['gender'];


                                if ($first_name == '') {
                                    echo "<span class='text-danger'>First Name Must Not Empty.!!</span>";
                                } elseif ($last_name == '') {
                                    echo "<span class='text-danger'>Last Name Must Not Empty.!!</span>";
                                } elseif ($phone == '') {
                                    echo "<span class='text-danger'>Phone Number Must Not Empty.!!</span>";
                                }elseif (strlen($phone)<11){
                                    echo "<span class='text-danger'>Phone Number Must Be 11 Digit!</span>";
                                }elseif (strlen($phone)>11){
                                    echo "<span class='text-danger'>Phone Number Must Be 11 Digit!</span>";
                                }elseif ($address == ''){
                                    echo "<span class='text-danger'>Address Must Not Empty.!!</span>";
                                }elseif ($gender == '') {
                                    $_SESSION['gender'] = 'Gender Must Not Empty.!!';
                                }else{
                                    //update profile
                                    if ($first_name && $last_name  && $phone  && $address && $gender) {
                                        $sql = "UPDATE users SET 
                                                    first_name    = '$first_name',
                                                    last_name     = '$last_name',
                                                    phone         = '$phone',
                                                    address       = '$address', 
                                                    gender        = '$gender'
                                                    
                                                    WHERE user_id = '$id'
                                                ";
                                        $res = mysqli_query($connect, $sql);

                                        $_SESSION['success'] = 'Profile Update Successful';

//                                        echo "<span class='text-success'>Profile Update Successful</span>";
                                        echo "<script>document.location.href='update_profile.php'</script>";
                                    }else{
                                        $_SESSION['error'] = 'Profile Update Failed';
//                                        echo "<span class='text-danger'>profile Update Failed</span>";
                                        echo "<script>document.location.href='update_profile.php'</script>";
                                    }
                                }

                            }
                            ?>

                        </h3>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-6 float-left">
                                <label>First Name</label>
                                <input type="text" name="user_id" hidden placeholder="Enter First Name" class="form-control" value="<?php echo $userdata['user_id'];?>">
                                <input type="text" name="first_name" placeholder="Enter First Name" class="form-control" value="<?php echo $userdata['first_name'];?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Last Name</label>
                                <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control" value="<?php echo $userdata['last_name'];?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Email</label>
                                <input type="email"  placeholder="Enter Email Address" disabled class="form-control"value="<?php echo $userdata['email']; ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Phone</label>
                                <input type="number" name="phone" placeholder="Enter Phone Number" class="form-control" value="<?php echo $userdata['phone']; ?>">
                            </div>
                            <div class="form-group col-md-12 float-left">
                                <label>Address</label>
                                <textarea name="address" placeholder="Enter Address" class="form-control"><?php echo $userdata['address'];?></textarea>
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Gender </label><br/>
                                <input type="radio" checked name="gender" value="Male"> Male
                                <input type="radio" name="gender" value="Fe Male"> Fe-Male
                            </div>

                            <div class="form-group col-md-6 float-left">
                                <label class="p-2"></label>
                                <input type="submit" name="user_update" class="btn btn-info btn-block" value="Update">
                            </div>
                        </form>
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


