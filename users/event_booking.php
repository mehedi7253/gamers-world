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

                    <div class="col-md-12 col-sm-12">
                        <div class="card mt-5 mb-5">
                            <div class="card-header">
                                <h3>Booking List</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Select Event</label>
                                    <select class="form-control" name="batch_id"  onchange="showUser(this.value)">
                                        <option>------------Select One----------</option>
                                        <?php
                                        $sql_batch = "SELECT * FROM event WHERE event.user_id = $userdata[user_id]";
                                        $result_batch = mysqli_query($connect, $sql_batch);

                                        while ($row = mysqli_fetch_assoc($result_batch)){?>
                                            <option value="<?php echo $row['event_id'];?>"><?php echo $row['event_title'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div id="txtHint"></div>
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
<script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","getuser.php?q="+str,true);
            xmlhttp.send();
        }
    }
</script>
</body>
</html>

