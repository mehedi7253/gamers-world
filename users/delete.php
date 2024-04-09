<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/23/2020
 * Time: 10:39 PM
 */

    include '../php/db_connect.php';

    if (isset($_GET['withdraw']))
    {
        $id = $_GET['withdraw'];

        $withdraw     = "DELETE FROM booking WHERE booking_id = '$id'";
        $res_withdraw = mysqli_query($connect, $withdraw);

        header('Location: my_booking.php');
    }

?>

