<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/22/2020
 * Time: 12:14 PM
 */
?>
<style>
    #navbarSupportedContent ul li a{
        font-size: 15px;
        /*font-weight: 400;*/
        padding: 15px;
        text-transform: capitalize;
        color: darkblue;
        font-weight: bold;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto text-dark">
            <li class="nav-item">
                <a class="nav-link" href="index.php"> Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Profile
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php"> Profile</a>
                    <a class="dropdown-item" href="update_profile.php">Update Profile</a>
                    <a class="dropdown-item" href="change_pass.php">Change password</a>
                    <a class="dropdown-item" href="change_pic.php">Change Profile Photo</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="event_booking.php"> Event Booking</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    My Booking
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="my_booking.php">Booking List</a>
                    <a class="dropdown-item" href="my_booking_payment.php">Payment List</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Payment
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="event_payment.php">Total Payment</a>
                    <a class="dropdown-item" href="my_paymet_event.php">Share Payment</a>
                </div>
            </li>

        </ul>
    </div>
</nav>
