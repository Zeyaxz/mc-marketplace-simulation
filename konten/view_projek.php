<?php 

session_start();
require ('../sinyal/config.php');
require ('../sinyal/cek.php');


if (isset($_GET['no'])) {
    $no = $_GET['no'];
    switch ($no) {
        case $no:
            $sql = "SELECT * FROM `data` WHERE id=$no";
            $tampilkan = mysqli_query($connect, $sql);
            $result = mysqli_fetch_assoc($tampilkan);
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Projek</title>
    <link rel="stylesheet" href="/global/css/minecraft.css">
    <link rel="stylesheet" href="/global/css/view.css">
</head>
<body>
    <nav>
        <img class="logo" src="../img/MC1.svg">
    </nav>
    <div class="konten">
        <div class="luar">
            <div class="judull">
                <h3>View Project</h4>
                <a href="projek.php">back</a>
            </div>
            <form action="" method="post">
                <img src=<?= "../img/data/" . $result["image"] ?>>
                <hr>
                <br>
                <div class="form">
                    <label for="judul">Judul</label>
                    <input type="text" disabled readonly name="judul" id="judul" value=<?= $result["judul"] ?> required autocomplete="off">
                </div>
                <div class="form">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" disabled readonly required>
                        <option value=<?= $result["kategori"] ?>><?= $result["kategori"] ?></option>
                    </select>
                </div>
                <div class="form">
                    <label for="harga">Harga</label>
                    <input type="text" disabled readonly name="harga" id="harga" value=<?= $result["harga"] ?> required autocomplete="off">
                </div>
                <div class="form">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea disabled readonly name="deskripsi" id="deskripsi" required autocomplete="off" rows="10" style="resize: none;"><?= $result["deskripsi"] ?></textarea>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>