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
                            // change password
                            if (isset($_POST['change_pass'])){
                                $old_pass = $_POST['old_pass'];
                                $new_pass = $_POST['password'];

                                $has_pass = hash('md5', $old_pass); // hash password
                                $new_pass_hash = hash('md5', $new_pass); // passsword hash into sha256

                                if ($old_pass == ''){
                                    echo "<span class='text-danger'>Type Your Old Password</span><br/>";
                                }elseif ($new_pass == ''){
                                    echo "<span class='text-danger'>Type Your New Password</span><br/>";
                                }elseif (preg_match('/\s/', $new_pass)) {
                                    echo "<span class='text-danger'>Password Must Have No Space</span><br/>";
                                }else{
                                    if ($old_pass && $has_pass){
                                        $sql = "SELECT * FROM users WHERE user_id = '$userdata[user_id]' AND password = '$has_pass'"; // check password hash
                                        $result = mysqli_query($connect, $sql); // connect with query and database

                                        $up = mysqli_fetch_assoc($result);

                                        if ($up !=0){
                                            $change_pass = "UPDATE users SET password = '$new_pass_hash' WHERE user_id = '$userdata[user_id]'"; // update password
                                            $res_change  = mysqli_query($connect, $change_pass);// connect with query and database

                                            $_SESSION['success'] = 'Password Change Successful';
                                            echo "<script>document.location.href='change_pass.php'</script>";
                                        }else{
                                            $_SESSION['error'] = 'Password Does Not Match With Current Password';
                                            echo "<script>document.location.href='change_pass.php'</script>";                                        }
                                    }
                                }
                            }
                            ?>

                        </h3>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Type Your Old Password</label>
                                <input type="password" placeholder="Enter Old Password" name="old_pass" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Type New Password</label>
                                <input type="password" placeholder="Enter New Password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="change_pass" class="btn btn-success" value="Change Password">
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


