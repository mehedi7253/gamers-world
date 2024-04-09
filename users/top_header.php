<?php
    session_start();
    require_once '../php/db_connect.php';
    if (!isset($_SESSION['user'])){

        header('Location: ../login.php');
    }
    $sql = "SELECT * FROM users WHERE email = '$_SESSION[user]'";
    $res = mysqli_query($connect, $sql);

    $userdata = mysqli_fetch_assoc($res);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gamers_World</title>
    <link rel="stylesheet" href="../assets/style/bootstrap.css">
    <link rel="icon" href="../images/logo.jpg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

</head>
<style>
    #main_nav ul li{
        text-align: center;
    }
    #main_nav ul li a{
        font-size: 15px;
        color: #fff;
        font-weight: 500;
        padding: 25px;
        text-transform: capitalize;
    }

    #drop a:hover{
        color: white;
        background-color: black;
    }
</style>
