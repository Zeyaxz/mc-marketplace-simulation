<?php 

session_start();
require ('../sinyal/config.php');
require ('../sinyal/cek.php');

if(isset($_COOKIE['ku'])){
    $user = $_COOKIE['ku'];
    $user = mysqli_query($connect, "SELECT * FROM user WHERE kode = '$user'");
    $user = mysqli_fetch_assoc($user);
    $user = $user["username"];
}


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

if(isset($_POST["simpan"])){
    $kategori = $_POST["kategori"];
    $judul = $_POST["judul"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    
    $image = upload();
    if($image == "kosong"){
        $update = "UPDATE `data` SET `kategori`='$kategori',`judul`='$judul',`pembuat`='$user',`harga`='$harga',`deskripsi`='$deskripsi' WHERE `id`='$no'";
    }else{
        $update = "UPDATE `data` SET `kategori`='$kategori',`image`='$image',`judul`='$judul',`pembuat`='$user',`harga`='$harga',`deskripsi`='$deskripsi' WHERE `id`='$no'";
    }
        mysqli_query($connect, $update);
        header("location: projek.php");
}

function upload(){
    
    $namaFile = $_FILES['image']['name'];
    $ukuranFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    // Cek apakah tidak ada gambar yang di upload
    if (!empty($error)) {
        return "kosong";
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg','png','jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo"<script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    // Cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
       echo"<script>
                alert('gambar terlalu besar!');
           </script>";
       return false;
   }
    
   // Lolos dari kondisi, gambar di upload
   //generate nama gambar baru
   $namaBaru = uniqid();
   $namaBaru .= '.';
   $namaBaru .= $ekstensiGambar;
   move_uploaded_file($tmpName,'../img/data/'.$namaBaru); 
   return $namaBaru;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit projek</title>
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
                <h3>Edit Project</h4>
                <a href="projek.php">back</a>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form">
                    <label for="image">image</label>
                    <input name="image" type="file" id="image" accept=".jpg,.jpeg,.png" onchange="validateFileType()"/>
                </div>
                <hr>
                <br>
                <div class="form">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" value=<?= $result["judul"] ?> required autocomplete="off">
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
                    <input type="text" name="harga" id="harga" value=<?= $result["harga"] ?> required autocomplete="off" maxlength="5" >
                </div>
                <div class="form">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" required autocomplete="off" rows="10" style="resize: none;"><?= $result["deskripsi"] ?></textarea>
                </div>
                <div class="form">
                    <button type="submit" name="simpan" >simpan</button>
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