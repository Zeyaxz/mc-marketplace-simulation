<?php 
session_start();
require ('../sinyal/config.php');
require ('../sinyal/cek.php');
require ('../sinyal/function.php');

if(isset($_COOKIE['ku'])){
    $user = $_COOKIE['ku'];
    $user = mysqli_query($connect, "SELECT * FROM user WHERE kode = '$user'");
    $user = mysqli_fetch_assoc($user);
    $user = $user["username"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projek</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/global/css/projek.css">
    <link rel="stylesheet" href="/global/css/minecraft.css">
</head>
<body>
    <nav>
        <img class="logo" src="/img/MC1.svg">
    </nav>
    <div class="konten">
        <a href="marketing.php">back</a>
        <div class="luar">
            <div class="judul">
                <h3>Manage Projects</h4>
                <a href="form_projek.php">Create Project</a>
            </div>
            <ul>
                <?php
                $sql = "SELECT * FROM `data` WHERE `pembuat` = '$user'";
                $tampilkan = mysqli_query($connect, $sql);
                if(mysqli_fetch_assoc($tampilkan) > 0 ){
                    $tampilkan = mysqli_query($connect, $sql);
                    
                    while ($data = mysqli_fetch_assoc($tampilkan)): ?>
                    <li>
                        <div class="list">
                            <img src=<?="/img/data/" . $data["image"] ?> alt="item" width="100px" >
                            <div class="naha">
                                <div class="nama">
                                    <p><?= $data["judul"] ?></p>
                                </div>
                                <div class="harga">
                                <?php 
                                    if(!$data['harga'] == 0){?>
                                        <p><?= $data['harga'] ?>
                                        <img src="/img/Minecraft_Desktop_1366_Minecoin.png" ></p>
                                    <?php }
                                    else{ ?>
                                        <p>FREE</p>
                                    <?php }
                                ?>
                                </div>
                            </div>
                            <a class="view" href=<?= "view_projek.php?no=" . $data['id']?>></a>
                            <a class="edit" href=<?= "edit_projek.php?no=" . $data['id']?>></a>
                            <a class="delete" onclick="confirmSweetAlert('<?= $data['id'] ?>')"></a>
                        </div>
                    </li>
                    <?php endwhile?>
                <?php }else{ ?>
                <li>
                    <h4>projek tidak ada, silahkan membuat projek anda</h4>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <script>
        function confirmSweetAlert(id){
            Swal.fire({
            title: "Anda yakin menghapusnya?",
            text: " Menghapus projek ini tidak dapat dibatalkan.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href='delete_projek.php?no='+id;
            }
            });
        }
    </script>
</body>
</html>