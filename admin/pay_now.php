<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 8:26 PM
 */

    session_start();

    include '../php/db_connect.php';


    if (isset($_GET['event']))
    {

        $id = $_GET['event'];

        $sql = "SELECT * FROM event WHERE event_id = $id";
        $res = mysqli_query($connect, $sql);



        $total_earn = "SELECT pay_amount, SUM(pay_amount) AS Total FROM booking_invoice WHERE booking_invoice.event_id = $id";
        $res_total = mysqli_query($connect, $total_earn);

        $total = mysqli_fetch_assoc($res_total);

        $event_total = $total['Total'];
        $percent  = $event_total * 85/100;

        $create = date('Y-m-d');
        $sql_pay = "insert into event_payment_invoice (payment, event_id, percent, payment_date) VALUES ('$percent', '$id', '85%', '$create')";
        $res_pay = mysqli_query($connect, $sql_pay);

        $_SESSION['success'] = 'Payment Given Successful';

        header('Location: give_payment.php');

    }
//    if (isset($_POST['btn']))
//    {
//        $pament = $_POST['payment'];
//        $event_id = $_POST['event_id'];
//
//        $sql = "insert into event_payment_invoice (payment, event_id) VALUES ('$pament', '$event_id')";
//        $res = mysqli_query($connect, $sql);
//    }


?>

