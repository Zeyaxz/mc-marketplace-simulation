<?php 
session_start();
require '../sinyal/config.php';


if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($connect, "SELECT * FROM `user` WHERE email='$email'");
    if(mysqli_num_rows($result) === 1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            if(isset($_POST["checkbox"])){
                setcookie('ma', $row['id'] , time() + 60 * 60 * 24 * 7);
                setcookie('ku', hash('sha256', $row['username']) , time() + 60 * 60 * 24 * 7);
                header("Location: marketing.php");
                $_SESSION["login"] = true;
            }else{
                setcookie('ma', $row['id'] , time() + 60 * 60 * 24 );
                setcookie('ku', hash('sha256', $row['username']) , time() + 60 * 60 * 24 );
                header("Location: marketing.php");
                $_SESSION["login"] = true;
            }
            
        }else{
            $warningP = "Password salah";
        }

    }else{
        $warningE = "Email tidak ada";
    }
}

if(isset($_COOKIE['ma']) && isset($_COOKIE['ku'])){
    $ma = $_COOKIE['ma'];
    $ku = $_COOKIE['ku'];

    $result = mysqli_query($connect, "SELECT username FROM user WHERE id=$ma");
    $row = mysqli_fetch_assoc($result);

    if($ku === hash('sha256', $row['username'])){
        $_SESSION["login"] = true;
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
    <link rel="stylesheet" href="/global/css/login.css">
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
            <h1>Login</h1>
            <h3>please sign in to continue</h3>
        </div>
        
        <div class="acc">
            <form action="" method="post">
                <ul>
                    <li>
                        <input type="email" name="email" id="email" value="" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);">
                        <img src="/img/log/email.png" alt="">
                        <label for="email">EMAIL</label>
                        <p id="warningE"><?php if (isset($warningE)){echo $warningE; } ?></p>
                    </li>
                    <li>
                        <input type="password" name="password" id="password" value="" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);">
                        <img src="/img/log/password.png" alt="">
                        <label for="password">PASSWORD</label>
                        <p id="warningP"><?php if (isset($warningP)){echo $warningP; } ?></p>
                    </li>
                    <li style="margin-left: 45px;">
                        <label style="font-size: 15px;" for="checkbox">Remember Me</label>
                        <input style="width: 50px;height: 20px;" type="checkbox" name="checkbox" id="checkbox">
                    </li>
                    <li>
                        <div class="footer">
                            <button type="submit" name="submit">SIGN IN</button>
                            <p>Create account <a href="sign_up.php">Sign Up</a></p>
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