<?php         
function query($query){
    global $connect;
    $result = mysqli_query($connect, $query);
    $rows = [];
    while ($row=mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function register($data){
    global $connect;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower($data["email"]);
    $password = mysqli_real_escape_string($connect, $data["password"]);
    $password2 = mysqli_real_escape_string($connect, $data["password2"]);

    $result1 = mysqli_query($connect, "SELECT username FROM user WHERE username='$username'");

    if(mysqli_fetch_assoc($result1)){
        return -1;
    }
    
    $result2 = mysqli_query($connect, "SELECT email FROM user WHERE email='$email'");
    
    if(mysqli_fetch_assoc($result2)){ 
        return -2;
    }

    if($password !== $password2){
        return -3;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $kode = hash('sha256', $username);

    mysqli_query($connect, "INSERT INTO `user`(`image`, `username`, `email`, `password`, `kode`) VALUES ('default','$username','$email','$password','$kode')");

    return mysqli_affected_rows($connect);
    
}

function create($data){

    global $connect;

    $user = $_COOKIE['ku'];
    $user = mysqli_query($connect, "SELECT * FROM user WHERE kode = '$user'");
    $user = mysqli_fetch_assoc($user);
    
    $kategori = $data["kategori"];
    $judul = $data["judul"];
    $pembuat = $user["username"];   
    $harga = $data["harga"];
    $deskripsi = $data["deskripsi"];

    $image = upload();
    if(!$image){
        return false;
    }

    $result1 = mysqli_query($connect, "SELECT judul FROM data WHERE judul='$judul'");

    if(mysqli_fetch_assoc($result1)){
        echo "<script>alert('Judul sudah terdaftar')</script>";

        return false;
    }

    mysqli_query($connect, "INSERT INTO `data` (`kategori`, `image`, `judul`, `pembuat`, `harga`, `deskripsi`, `populer`) VALUES ('$kategori','$image','$judul','$pembuat','$harga','$deskripsi','0')");

    return mysqli_affected_rows($connect);
    
}

function upload(){
    
    $namaFile = $_FILES['image']['name'];
    $ukuranFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    // Cek apakah tidak ada gambar yang di upload
    if (!empty($error)) {
      die("pilih gambar terlebih dahulu");
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

function edit($edit){
    global $connect;
    $user = $_COOKIE['ku'];
    $user = mysqli_query($connect, "SELECT * FROM user WHERE kode = '$user'");
    $user = mysqli_fetch_assoc($user);
    $userr = $user["username"];

    $username = mysqli_query($connect, "SELECT username FROM user WHERE `username` = '$userr'");
    $newusername = $edit["username"];
    $result1 = mysqli_query($connect, "SELECT username FROM user WHERE username='$newusername'");
    if ($username!==$newusername) {
        if(mysqli_num_rows($result1) > 1){ 
            return -1;
        }
    }

    $email = mysqli_query($connect, "SELECT email FROM user WHERE `username` = '$userr'");
    $newemail = $edit["email"];
    $result2 = mysqli_query($connect, "SELECT email FROM user WHERE email='$newemail'");
    if ($email!==$newemail) {
        if(mysqli_num_rows($result2) > 1){ 
            return -2;
        }
    }
    
    $kode = hash('sha256', $newusername);
    $update = "UPDATE `user` SET `username` = '$newusername',email = '$newemail',kode = '$kode' WHERE `username` = '$userr'";
    $updatee = "UPDATE `data` SET `pembuat` = '$newusername' WHERE `pembuat` = '$userr'";
    mysqli_query($connect, $updatee);
    mysqli_query($connect, $update);

    setcookie('ku', $kode , time() + 60 * 60 * 24 * 7);
    $_SESSION["refresh"] = 3;
}