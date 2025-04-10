<?php 

require '../sinyal/config.php';

if(isset($_COOKIE['ma']) && isset($_COOKIE['ku'])){
    $ma = $_COOKIE['ma'];
    $ku = $_COOKIE['ku'];

    $result = mysqli_query($connect, "SELECT username FROM user WHERE id=$ma");
    $row = mysqli_fetch_assoc($result);

    if($ku === hash('sha256', $row['username'])){
        $_SESSION["login"] = true;
    }else{
        header("Location: login.php");
        exit;
    }
}else{
    header("Location: login.php");
    exit;
}

?>