<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/21/2020
 * Time: 10:36 PM
 */
?>
<div class="container">
    <a class="navbar-brand font-weight-bold" href="#"><span style="color: yellow">Gamers</span> <span style="color: red">World</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../index.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Event</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../news_feed.php">News feed</a>
            </li>
            <li class="nav-item dropdown bg-dark">
                <?php
                //check user login or not

                if (!isset($_SESSION['user']))
                {

                }else{
                    echo "
                    <li class='nav-item dropdown'>
                        <a class='nav-link  dropdown-toggle' data-toggle='dropdown' href='#'>Manage Event</a>
                            <div class='dropdown-menu bg-dark' id='drop' aria-labelledby='navbarDropdown'>
                                <a href='add_event.php' class='dropdown-item text-capitalize'>Add Event</a>
                                <a href='manage_event.php' class='dropdown-item text-capitalize'>Manage Event</a>
                            </div>
                        </li>
                    ";
                }

                ?>
            </li>
            <li class="nav-item dropdown bg-dark">
                <?php
                //check user login or not

                if (!isset($_SESSION['user']))
                {
                    echo "<a href='../login.php' class='nav-link'>Login</a>";
                }else{
                    echo "
                        <li class='nav-item dropdown'>
                        <a class='nav-link  dropdown-toggle' data-toggle='dropdown' href='#'> $userdata[first_name] <img src='../images/$userdata[image]' style='height: 30px; width: 30px; border-radius: 50%'></a>
                            <div class='dropdown-menu bg-dark' id='drop' aria-labelledby='navbarDropdown'>
                                <a href='index.php' class='dropdown-item text-capitalize'>Profile</a>
                                <a href='logout.php' class='dropdown-item text-capitalize'>Logout</a>
                            </div>
                        </li>
                   ";
                }

                ?>
            </li>
        </ul>
    </div>
</div>
