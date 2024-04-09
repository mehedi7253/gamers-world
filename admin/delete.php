<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 3:24 PM
 */
    session_start();
    if (!isset($_SESSION['user'])){
        header('Location: ../login.php');
    }
    include '../php/db_connect.php';

    if (isset($_GET['category']))
    {
        $id = $_GET['category'];

        $withdraw     = "DELETE FROM category WHERE category_id = '$id'";
        $res_withdraw = mysqli_query($connect, $withdraw);

        $_SESSION['success'] = 'Category Delete Successful';
        header('Location: manage_category.php');
    }

    if (isset($_GET['about']))
    {
        $about_id = $_GET['about'];

        $withdraw     = "DELETE FROM about_us WHERE id = '$about_id'";
        $res_withdraw = mysqli_query($connect, $withdraw);

        $_SESSION['success'] = 'About US Delete Successful';
        header('Location: manage_about_us.php');
    }

    if (isset($_GET['msg']))
    {
        $msg_id = $_GET['msg'];

        $del_msg = "DELETE FROM public_msg WHERE id = '$msg_id'";
        $res_msg = mysqli_query($connect, $del_msg);

        $_SESSION['success'] = 'Message Delete successful';

        header('Location: public_msg.php');
    }

?>

