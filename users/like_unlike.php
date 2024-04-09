<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 10:38 AM
 */


    session_start();
    require_once '../php/db_connect.php';
    if (!isset($_SESSION['user'])){

        header('Location: ../login.php');
    }
    $sql = "SELECT * FROM users WHERE email = '$_SESSION[user]'";
    $res = mysqli_query($connect, $sql);

    $userdata = mysqli_fetch_assoc($res);


    if (isset($_GET['like'])){
        $event_id = $_GET['like'];

        $user_id = $userdata['user_id'];

        $sql = "SELECT * FROM event WHERE event_id = $event_id";
        $res = mysqli_query($connect, $sql);

        $like = "INSERT INTO event_like (user_id, event_id, like_unlike) VALUES ('$user_id', '$event_id', '1')";
        $res = mysqli_query($connect, $like);

        header('Location: ../news_feed.php');
    }


    if (isset($_GET['unlike'])){
        $event_id2 = $_GET['unlike'];

        $user_id2 = $userdata['user_id'];

        $sql2 = "SELECT * FROM event WHERE event_id = $event_id2";
        $res2 = mysqli_query($connect, $sql2);

        $like = "UPDATE event_like SET like_unlike = '0' WHERE event_id = '$event_id2' AND user_id = '$user_id2'";
        $res = mysqli_query($connect, $like);

        header('Location: ../news_feed.php');
    }

    if (isset($_GET['unlike_up'])){
        $event_id3 = $_GET['unlike_up'];

        $user_id3 = $userdata['user_id'];

        $sql3 = "SELECT * FROM event WHERE event_id = $event_id3";
        $res3 = mysqli_query($connect, $sql2);

        $like = "UPDATE event_like SET like_unlike = '1' WHERE event_id = '$event_id3' AND user_id = '$user_id3'";
        $res = mysqli_query($connect, $like);

        header('Location: ../news_feed.php');
    }


?>