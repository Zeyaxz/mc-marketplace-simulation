<?php 
require ('../sinyal/config.php');
require ('../sinyal/cek.php');
$user = $_COOKIE['ku'];
$user = mysqli_query($connect, "SELECT * FROM user WHERE kode = '$user'");
$user = mysqli_fetch_assoc($user);
$userr = $user["username"];

$folderPath = '../img/profile_img/';

$image_parts = explode(";base64,",$_POST['image']);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$namaBaru = uniqid();
$file = $folderPath . $namaBaru . '.png';
mysqli_query($connect, "UPDATE `user` SET `image` = '$namaBaru' WHERE `username` = '$userr'");
file_put_contents($file, $image_base64);
echo json_encode(["image uploaded successfully"]);
?>