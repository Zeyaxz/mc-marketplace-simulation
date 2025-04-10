<?php 

require ('../sinyal/config.php');
require ('../sinyal/cek.php');
$user = $_COOKIE['ku'];
$user = mysqli_query($connect, "SELECT * FROM user WHERE kode = '$user'");
$user = mysqli_fetch_assoc($user);
$userr = $user["image"];

    $sql = "UPDATE `user` SET `image` = 'default' WHERE `username` = '$userr'";
    mysqli_query($connect, $sql);
    header("location: profile.php");

?>