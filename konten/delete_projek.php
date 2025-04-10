<?php 

session_start();
require ('../sinyal/config.php');
require ('../sinyal/cek.php');

if (isset($_GET['no'])) {
    $no = $_GET['no'];
    switch ($no) {
        case $no:
            $sql = "DELETE FROM `data` WHERE id = '$no'";
            mysqli_query($connect, $sql);
            header("location: projek.php");
            break;
        default :
            header("location:marketing.php");
            exit;
    }
}else{
    header("location:marketing.php");
    exit;
}

?>