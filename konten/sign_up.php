<?php 
session_start();

require '../sinyal/config.php';
require '../sinyal/function.php';

if (isset($_POST["submit"])) {

    if (register($_POST) > 0) {
        echo "<script>alert('Data Berhasil di Tambahkan')</script>";
        $result = mysqli_query($connect, "SELECT * FROM `user` WHERE email='$_POST\[\"email\"]'");
        $row=mysqli_fetch_assoc($result);
        setcookie('ma', $row['id'] , time() + 60 * 60 * 24 * 7);
        setcookie('ku', hash('sha256', $row['username']) , time() + 60 * 60 * 24 * 7);
        $_SESSION["login"] = true;
        header("Location: marketing.php");
        exit;
    }elseif (register($_POST) == -1) {
        $warningU = "Username sudah terdaftar";
    }elseif (register($_POST) == -2) {
        $warningE = "EMAIL sudah terdaftar";
    }elseif (register($_POST) == -3) {
        $warningC = "Password Tidak Sama!";
    }
     else {
        echo mysqli_error($connect);
    }
}

if(isset($_SESSION["login"])){
    header("Location: marketing.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCFo</title>
    <link rel="stylesheet" href="/global/css/sign_up.css">
    <link rel="stylesheet" href="/global/css/minecraft.css">
</head>
<body>
    <div class="log">
        <div class="nav">
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="marketing.php">Marketplace</a></li>
            </ul>
            <br>
            <h1>Create Account</h1>
            <h3>please fill the input blow here</h3>
        </div>
        
        <div class="acc">
            <form action="" method="post">
                <ul>
                    <li>
                        <input type="text" name="username" id="username" value="" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);warningu(this.Value)">
                        <img src="/img/log/login.png" alt="">
                        <label for="username">FULL NAME</label>
                        <p id="warningU"><?php if (isset($warningU)){echo $warningU; } ?></p>
                    </li>
                    <li>
                        <input type="email" name="email" id="email" value="" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);warninge(this.Value)">
                        <img src="/img/log/email.png" alt="">
                        <label for="email">EMAIL</label>
                        <p id="warningE"><?php if (isset($warningE)){echo $warningE; } ?></p>
                    </li>
                    <li>
                        <input type="password" name="password" id="password" minlength="8" value="" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);">
                        <img src="/img/log/password.png" alt="">
                        <label for="password">PASSWORD</label>
                    </li>
                    <li>
                        <input type="password" name="password2" id="password2" minlength="8" value="" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);">
                        <img src="/img/log/password.png" alt="">
                        <label for="password2">CONFIRM PASSWORD</label>
                        <p id="warningC"><?php if (isset($warningC)){echo $warningC; } ?></p>
                    </li>
                    <li>
                        <div class="footer">
                            <button type="submit" name="submit">SIGN UP</button>
                            <p>Already have a account?<a href="login.php">Sign In</a></p>
                        </div>
                    </li>
                </ul>
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