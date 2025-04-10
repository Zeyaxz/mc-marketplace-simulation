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

if (isset($_POST["create"])) {

    if (create($_POST) > 0) {
        echo "<script>alert('Project Berhasil di Tambahkan')</script>";
        header("Location: projek.php");
        exit;
    } else {
        echo mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Projek</title>
    <link rel="stylesheet" href="/global/css/minecraft.css">
    <link rel="stylesheet" href="/global/css/view.css">
</head>
<body>
    <nav>
        <img class="logo" src="/img/MC1.svg">
    </nav>
    <div class="konten">
        <div class="luar">
            <div class="judull">
                <h3>Create Project</h4>
                <a href="projek.php">back</a>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form">
                    <label for="image">Image</label>
                    <input name="image" type="file" id="image" accept=".jpg,.jpeg,.png" required onchange="validateFileType()"/>
                </div>
                <hr>
                <br>
                <div class="form">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" placeholder="Judul" required autocomplete="off">
                </div>
                <div class="form">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" required>
                        <option value="skin">skin</option>
                        <option value="texture">texture</option>
                        <option value="maps">maps</option>
                        <option value="mini games">mini games</option>
                    </select>
                </div>
                <div class="form">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" id="harga" pattern="[0-9]*" placeholder="Harga(0-9)" required autocomplete="off">
                </div>
                <div class="form">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" required autocomplete="off" rows="10" style="resize: none;" placeholder="Deskripsi"></textarea>
                </div>
                <div class="form">
                    <button type="submit" name="create">Create</button>
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
<script type="text/javascript">
    function validateFileType(){
        var image = document.getElementById("image").value;
        var idxDot = image.lastIndexOf(".") + 1;
        var extFile = image.substr(idxDot, image.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
            location.reload();
        }   
    }
</script>