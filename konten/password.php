<?php 
session_start();
require '../sinyal/config.php';
require ('../sinyal/cek.php');

require '../sinyal/function.php';

if(isset($_COOKIE['ku'])){
    $user = $_COOKIE['ku'];
    $user = mysqli_query($connect, "SELECT * FROM user WHERE kode = '$user'");
    $user = mysqli_fetch_assoc($user);
}

if(isset($_POST["sandi"])){
    $oldpassword = $_POST["oldpassword"];
    $password1 = mysqli_real_escape_string($connect, $_POST["password1"]);
    $password2 = mysqli_real_escape_string($connect, $_POST["password2"]);
    $id = $user["id"];

    if(password_verify($oldpassword, $user["password"])){
        if($password1 == $password2){
            $password1 = password_hash($password1, PASSWORD_DEFAULT);

            mysqli_query($connect, "UPDATE user SET password='$password1' WHERE id='$id'");
            echo "<script>alert('Password telah berubah')</script>";
            header("Location: profile.php");
            exit;
        }else{
            $warningPP = "Password tidak sama";
        }
    }else{
        $warningP = "Password salah";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Password</title>
    <link rel="stylesheet" href="/global/css/password.css">
    <link rel="stylesheet" href="/global/css/minecraft.css">
</head>
<body>
    <nav>
        <img class="logo" src="/img/MC1.svg">
    </nav>
    <div class="luar">
        <div class="konten">
            <div class="card_password">
                <form action="" method="post">
                    <h4>Pilih sandi yang kuat dan jangan gunakan lagi untuk akun lain.</h4>
                    <div class="formulir">
                        <label for="oldpassword">Sandi Lama</label>
                        <input type="password" name="oldpassword" id="oldpassword" required placeholder="password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"onkeyup="this.setAttribute('value', this.value);" value="" minlength="8" >
                        <p id="warningE"><?php if (isset($warningP)){echo $warningP; } ?></p>
                    </div>
                    <p>Gunakan setidaknya 8 karakter. 
                        Jangan gunakan sandi dari situs lain atau 
                        sesuatu yang mudah ditebak, 
                        seperti nama hewan peliharaan Anda.</p>
                    <div class="formulir">
                        <label for="password1">Sandi baru</label>
                        <input type="password" name="password1" id="password1" required placeholder="password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" minlength="8">
                    </div>
                    <div class="formulir">
                        <label for="password2">Konfirmasi sandi baru</label>
                        <input type="password" name="password2" id="password2" required placeholder="konfirmasi password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"onkeyup="this.setAttribute('value', this.value);" value="" minlength="8">
                        <p id="warningE"><?php if (isset($warningPP)){echo $warningPP; } ?></p>
                    </div>
                    <div class="formulir">
                        <button type="submit" name="sandi">Ubah sandi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<script src="/global/js/sidenav.js"></script>
</body>
</html>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>