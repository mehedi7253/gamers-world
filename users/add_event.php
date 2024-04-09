<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/22/2020
 * Time: 8:12 PM
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
                        <div class="col-md-10 mx-auto mt-2">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Add Event</h3>
                                </div>
                                <div class="card-body">
                                    <h4 class="mb-4">
                                        <?php
                                            // add new event
                                            if (isset($_POST['btn']))
                                            {
                                                $user_id    = $_POST['user_id'];
                                                $title      = $_POST['event_title'];
                                                $price      = $_POST['event_price'];
                                                $start_date = $_POST['start_date'];
                                                $end_date   = $_POST['end_date'];
                                                $desc       = $_POST['description'];
                                                $book_limit = $_POST['book_limit'];
                                                $image      = $_FILES['event_image']['name'];
                                                $category_id = $_POST['category_id'];

                                                if ($title == ''){
                                                    echo "<span class='text-danger'> Please Enter Event Title</span>";
                                                }elseif ($price == ''){
                                                    echo "<span class='text-danger'> Please Enter Event Price</span>";
                                                }elseif ($start_date == ''){
                                                    echo "<span class='text-danger'> Please Enter Event Start Date</span>";
                                                }elseif ($end_date == ''){
                                                    echo "<span class='text-danger'> Please Enter Event End Date</span>";
                                                }elseif ($desc == ''){
                                                    echo "<span class='text-danger'> Please Enter Event Description</span>";
                                                }elseif ($book_limit == ''){
                                                    echo "<span class='text-danger'> Please Enter Event Booking Limit</span>";
                                                } elseif ($image == ''){
                                                    echo "<span class='text-danger'> Please Choose A Banner</span>";
                                                }else{

                                                    $fileinfo = PATHINFO($_FILES['event_image']['name']);
                                                    $newFile = $fileinfo['filename']. "." . $fileinfo['extension'];
                                                    move_uploaded_file($_FILES['event_image']['tmp_name'], "../images/" .$newFile);
                                                    $location = $newFile;

                                                    $add_event = "INSERT INTO event (user_id, event_title, event_price, start_date, end_date, description, event_image, event_status, book_limit, category_id) VALUES ('$user_id', '$title', '$price', '$start_date', '$end_date', '$desc', '$image', '1', '$book_limit', '$category_id')";
                                                    $res_event = mysqli_query($connect, $add_event);

                                                    if ($res_event){
                                                        echo "<span class='text-success'> Event Create Successful</span>";
                                                    }else{
                                                        echo "<span class='text-danger'> Event Create Failed...!!</span>";
                                                    }
                                                }


                                            }
                                        ?>
                                    </h4>
                                    <form action="" method="post" enctype="multipart/form-data">
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
                                            <label class="font-weight-bold">Event Title <span class="text-danger">*</span></label>
                                            <input name="user_id" hidden value="<?php echo $userdata['user_id'];?>">
                                            <input type="text" name="event_title" class="form-control" placeholder="Enter Event Title" value="<?php if ($_POST){
                                                echo $_POST['event_title'];
                                            }?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Event Price <span class="text-danger">*</span></label>
                                            <input type="text" name="event_price" class="form-control" placeholder="Enter Event Price"  value="<?php if ($_POST){
                                                echo $_POST['event_price'];
                                            }?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Booking Limit <span class="text-danger">*</span></label>
                                            <input type="text" name="book_limit" class="form-control" placeholder="Enter Event Booking Limit"  value="<?php if ($_POST){
                                                echo $_POST['book_limit'];
                                            }?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Event Strat Date <span class="text-danger">*</span></label >
                                            <input type="date" name="start_date" class="form-control"  value="<?php if ($_POST){
                                                echo $_POST['start_date'];
                                            }?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Registration Last Date <span class="text-danger">*</span></label>
                                            <input type="date" name="end_date" class="form-control"  value="<?php if ($_POST){
                                                echo $_POST['end_date'];
                                            }?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Event Description <span class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control" id="application"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Event Banner <span class="text-danger">*</span></label>
                                            <input type="file" name="event_image" class="form-control" placeholder="Enter Event Title">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="btn" class="btn btn-success col-md-4" value="Add New Event">
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



