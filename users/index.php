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
                        <div class="col-md-4 col-sm-12 float-left">
                            <div class="card mt-5">
                                <div class="card-header">
                                    <center class="m-t-30"> <img src="../images/<?php echo $userdata['image'];?>" title="<?php echo $userdata['first_name'];?>" width="100%" height="200" />
                                        <h4 class="card-title m-t-10 text-capitalize mt-3"><?php echo $userdata['first_name'];?> <span><?php echo $userdata['last_name'];?></span></h4>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-12 float-left">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mt-4">
                                        <tr>
                                            <th>Name </th>
                                            <td class="font-weight-bold text-capitalize"><?php echo $userdata['first_name'].' '.$userdata['last_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email </th>
                                            <td class="font-weight-bold"><?php echo $userdata['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Gender  </th>
                                            <td class="font-weight-bold"><?php echo $userdata['gender']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address  </th>
                                            <td class="font-weight-bold"><?php echo $userdata['address']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone </th>
                                            <td class="font-weight-bold"><?php echo $userdata['phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Join Date </th>
                                            <td class="font-weight-bold"><?php echo @date('d-M-Y', strtotime($userdata['join_date'])); ?></td>
                                        </tr>
                                    </table>
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

