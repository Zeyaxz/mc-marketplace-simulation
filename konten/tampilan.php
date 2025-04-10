<?php

session_start();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    switch ($id) {
        case $id:
            $sql = "SELECT * FROM `data` WHERE id=$id";
            require '../sinyal/config.php';
            $tampilkan = mysqli_query($connect, $sql);
            $result = mysqli_fetch_assoc($tampilkan);
            $populer = $result['populer'];
            $populer += 1;
            $popul = "UPDATE `data` SET `populer`='$populer' WHERE id=$id";
            $kirimpop = mysqli_query($connect,$popul);
            break;
        default :
            header("location:marketing.php");
            exit;
    }
}else{
    header("location:marketing.php");
    exit;
}

if(isset($_COOKIE['ku'])){
    $user = $_COOKIE['ku'];
    $user = mysqli_query($connect, "SELECT * FROM user WHERE kode = '$user'");
    $user = mysqli_fetch_assoc($user);
    $id = $user["id"];
    $email = $user["email"];
}

$judul = $result["judul"];
$item = $result["id"]; 


    function formatCurrency($number) {
        return number_format($number, 0, ',', '.');
    }
    
    $hargaRp = $result['harga'] * 90;
    $hargaRp = formatCurrency($hargaRp);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace MCFo</title>
    <link rel="stylesheet" href="/global/css/tampilan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
<body style="background-color: black;">
    <nav><img loading="lazy" src="/img/MC1.svg"></nav>
    
    <div class="kotak-jual">
        <a href="marketing.php">BACK TO MARKET</a>
        <div class="kotak-dalam">
            <img class="items" src=<?= "/img/data/".$result['image'] ?> alt="NeonGamerMobs">
            <div class="terdalam" id="konten">
                <h2><?= $result['judul'] ?></h2>
                <p class="pembuat">BY <?= $result['pembuat'] ?></p>
                <?php 
                            if(!$result['harga'] == 0){?>
                                <div class="harga-bayar">
                                    <p><?= $result['harga'] ?></p>
                                    <img src="/img/Minecraft_Desktop_1366_Minecoin.png" >
                                </div>
                            <?php }
                            else{ ?>
                                <div class="harga-bayar">
                                    <p>
                                        FREE
                                    </p>
                                 </div>
                            <?php }
                        ?>
                <div class="desk">
                    <?= nl2br($result['deskripsi']) ?>
                </div>
                <br>
                <?php if(isset($_SESSION["login"])){
                    if(!isset($_COOKIE["ma"]) || !isset($_COOKIE["ku"])){ ?>
                                <button onclick="get()">GET THIS ITEM</button>
                            <?php } else{?>
                                <button onclick="buy()">GET THIS ITEM</button>
                            <?php }
                }else{ ?>
                        <button onclick="get()">GET THIS ITEM</button>
                        <?php } ?>
                    </div>
                    <script src="/global/js/tampilan.js"></script>
        </div>
        <br>
        <div id="buy" class="buy" >
        <div class="out">
            <div class="konten">
                <div class="judul">
                    <h2>Detail Pembelian</h2>
                </div>
                <div class="konten-dalam">
                    <h3>Mohon konfirmasi pembelian anda sudah benar.</h3>
                    <div><p>Username:</p><p><?= isset($user["username"]) ?></p></div>
                    <div><p><?= isset($result['kategori']) ?></p><p><?= isset($result['judul']) ?></p></div>
                    <div>
                        <p>Harga</p>
                        <?php 
                            if(!$result['harga'] == 0){?>
                                <p><?= isset($result['harga']) ?>
                                <img src="/img/Minecraft_Desktop_1366_Minecoin.png" >= Rp <?= isset($hargaRp) ?></p>
                            <?php }
                            else{ ?>
                                 <p>FREE</p>
                            <?php }
                        ?>
                    </div>
                    <div><p>Email</p><p><?= isset($user["email"]) ?></p></div>
                    <div><p>Metode pembayaran</p><p>QRIS - Instant 1 Detik</p></div>
                </div>
                <div class="button">
                    <button onclick="buy()">Cancel</button>
                    <form action="" method="post">
                        <button type="submit" name="submit">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
        
        </div>
    </div>
    
    
    
    <footer>
       | Ⓒ2023 by Minecraft Informasi | 
    </footer>

    <?php 
        if(isset($_POST['submit'])){
            for($i=1;$i <= 3;$i++){
            $random[$i] = random_bytes(2);
            $random[$i] = bin2hex($random[$i]);
            }
            $kode = implode(" ",$random);
            $fullkode = $random[1] . $random[2] . $random[3];
            $sql = "INSERT INTO `redeem` (`id_user`,`id_item`, `email`, `metode`, `item`, `kode`)
            VALUES ('$id', '$item', '$email', 'QRIS - Instant 1 Detik', '$judul', '$fullkode')";
            mysqli_query($connect, $sql);
            $id = $_GET['id'];
            ?>
            <script>
                Swal.fire({
                    position: "top",
                    width: "400",
                    title: "Kode redeem anda :",
                    text: "<?= $kode ?>",
                    confirmButtonColor: "green",
                    showClass: {
                        popup: 'animated fadeInDown '
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp',
                    }
                    });
            </script>
            <?php
        }
    ?>
</body>
</html>