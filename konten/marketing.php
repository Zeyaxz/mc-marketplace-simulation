<?php

session_start();

require ('../sinyal/config.php');
require ('../sinyal/function.php');

if(isset($_COOKIE['ma']) && isset($_COOKIE['ku'])){
    $ma = $_COOKIE['ma'];
    $ku = $_COOKIE['ku'];

    $result = mysqli_query($connect, "SELECT username FROM user WHERE id=$ma");
    $row = mysqli_fetch_assoc($result);

    if($ku === hash('sha256', $row['username'])){
        $_SESSION["login"] = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en" style="background-color: black;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace MCFo</title>
    <link rel="stylesheet" href="/global/css/market.css">
    <link rel="stylesheet" href="/global/css/minecraft.css">
</head>
<body style="background-image: url(/img/Site-background-light.webp);">
    <nav id="navbar">
        <img class="logo" src="/img/MC1.svg">
        <button id="button-side" onclick="sidenav()"></button>
        <img id="img-side" src="/img/profile.png" alt="profile">
        <span id="span1"></span>
        <span id="span2"></span>
        <div class="side-luar" id="sidenav-luar">
            <div class="sidenav" id="sidenav">
                <ul>
                    <?php if(isset($_SESSION["login"])){
                            if(!isset($_COOKIE["ma"]) || !isset($_COOKIE["ku"])){ ?>
                            <?php
                            header("Location: logout.php");
                            } else{?>
                        <li>
                            <a href=<?= "profile.php?u=" . $_COOKIE["ku"] ?>>
                                <img src="/img/login.png" alt="login"> 
                                <p>Profile</p>
                            </a>
                        </li>
                        <li>
                            <a href=<?= "projek.php?u=" . $_COOKIE["ku"] ?>>
                                <img src="/img/projek.png" alt="login"> 
                                <p>Projects</p>
                            </a>
                        </li>
                        <li>
                            <a href=<?= "redeem.php?u=" . $_COOKIE["ku"] ?>>
                                <img src="/img/projek.png" alt="login"> 
                                <p>Redeem</p>
                            </a>
                        </li>
                        <?php }
                    }else{ ?>
                    <li>
                        <a href="login.php">
                            <img src="/img/login.png" alt="login"> 
                            <p>Login</p>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="iklan" id="iklan">
        <h3>BELI MINECRAFT DLC MARKETPLACE</h3>
        <p>Tingkatkan gameplay anda dengan Minecraft DLC. 
            Beli peta, skin, dan paket teksture unik dari pembuat komunitas Minecraft favorit anda!</p>
        <div class="kolom-pencarian">
            <form action="" method="post">
                <input type="text" name="keyword" placeholder="Search" autofocus autocomplete="off">
                <button type="submit" name="cari"></button>
            </form>
        </div>
    </div>
    <div class="kotak-konten">
        <?php

            if(isset($_GET['page'])){
                $page = $_GET['page'];

                switch ($page){
                    case 'all' :
                        include '../tampilan/all.php';
                        break;
                    case 'skin' :
                        include '../tampilan/skin.php';
                        break;
                    case 'texture' :
                        include '../tampilan/texture.php';
                        break;
                    case 'maps' :
                        include '../tampilan/maps.php';
                        break;
                    case 'mini-games' :
                        include '../tampilan/mini-games.php';
                        break;
                    default :
                        ?><center><h3>Maaf. Halaman tidak di temukan !</h3></center><br><center><a href="marketing.php"><h4>back to market</h4></a></center><br><br><br><?php
                        break;
                }
            }else{
                include '../tampilan/all.php';
            }

        ?>
    </div>
    <footer>
       | Ⓒ2023 by Minecraft Informasi | 
    </footer>
</body>
</html>
<script src="/global/js/market.js"></script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>