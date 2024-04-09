<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 3:48 PM
 */
    session_start();
        if (!isset($_SESSION['user'])){
            header('Location: ../login.php');
    }


    include '../php/db_connect.php';

    if (isset($_GET['status'])){
        $status1 = $_GET['status'];

        $sql = "SELECT * FROM users WHERE user_id ='$status1'";

        $result = mysqli_query($connect, $sql);

        while ($row = mysqli_fetch_object($result)){
            $status_var = $row->status;

            if ($status_var == '0'){
                $status_state = 1;
            }else{
                $status_state = 0;
            }
            $update = "UPDATE users SET status = '$status_state' WHERE user_id = '$status1'";

            $res = mysqli_query($connect, $update);

            if ($res){
                $_SESSION['success'] = 'Status Changed';
                header('Location: manage_users.php');
            }else{
                echo  mysqli_error($res);
            }
        }
    }

?>



