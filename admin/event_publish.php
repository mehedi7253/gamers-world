<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/24/2020
 * Time: 5:58 PM
 */


require_once '../php/db_connect.php';

if (isset($_GET['status'])){
    $status1 = $_GET['status'];

    $sql = "SELECT * FROM event WHERE event_id ='$status1'";

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_object($result)){
        $status_var = $row->event_status;

        if ($status_var == '0'){
            $status_state = 1;
        }else{
            $status_state = 0;
        }
        $update = "UPDATE event SET event_status = '$status_state' WHERE event_id = '$status1'";

        $res = mysqli_query($connect, $update);

        if ($res){
            header('Location: manage_post.php');
        }else{
            echo  mysqli_error($res);
        }
    }
}

?>


?>