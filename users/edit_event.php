
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
                                    <h3>Update Event</h3>
                                </div>
                                <div class="card-body">
                                    <h4 class="mb-4">
                                        <?php
                                            if (isset($_GET['event']))
                                            {
                                                $id = $_GET['event'];

                                                $sql_get_event = "SELECT * FROM event WHERE event_id = $id";
                                                $res_event     = mysqli_query($connect, $sql_get_event);

                                                $data = mysqli_fetch_assoc($res_event);
                                            }

                                            if (isset($_POST['btn']))
                                            {
                                                $event_id   = $_POST['event_id'];
                                                $title      = $_POST['event_title'];
                                                $price      = $_POST['event_price'];
                                                $start_date = $_POST['start_date'];
                                                $end_date   = $_POST['end_date'];
                                                $desc       = $_POST['description'];
                                                $book_limit = $_POST['book_limit'];

                                                $update_event = "UPDATE event SET 
                                                              event_id    = '$event_id',
                                                              event_title = '$title',
                                                              event_price = '$price',
                                                              start_date  = '$start_date',
                                                              end_date    = '$end_date',
                                                              book_limit  = '$book_limit',
                                                              description = '$desc'
                                                              
                                                              WHERE event_id = '$event_id'";

                                                $res_update = mysqli_query($connect, $update_event);

                                                if ($res_update){
                                                    $_SESSION['success'] = 'Event Update Successful';
                                                    echo "<script>document.location.href='manage_event.php'</script>";
                                                }else{
                                                    $_SESSION['error'] = 'Event Update Failed';
                                                    echo "<script>document.location.href='manage_event.php'</script>";

                                                }
                                            }
                                        ?>
                                    </h4>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Event Title <span class="text-danger">*</span></label>
                                            <input type="text" name="event_id" hidden class="form-control" placeholder="Enter Event Title" value="<?php echo $data['event_id'];?>">
                                            <input type="text" name="event_title" class="form-control" placeholder="Enter Event Title" value="<?php echo $data['event_title'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Event Price <span class="text-danger">*</span></label>
                                            <input type="text" name="event_price" class="form-control" placeholder="Enter Event Price"  value="<?php echo $data['event_price'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Event Booking Limit <span class="text-danger">*</span></label>
                                            <input type="text" name="book_limit" class="form-control" placeholder="Enter Event Price"  value="<?php echo $data['book_limit'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Start Date <span class="text-danger">*</span></label>
                                            <input type="date" name="start_date" class="form-control"  value="<?php echo $data['start_date'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Registration Last Date <span class="text-danger">*</span></label>
                                            <input type="date" name="end_date" class="form-control"  value="<?php echo $data['end_date'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Event Description <span class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control" id="application"><?php echo $data['description'];?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="btn" class="btn btn-success col-md-4" value="Update Event">
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




