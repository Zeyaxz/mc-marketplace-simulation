<?php 
session_start();
error_reporting(0);
ini_set('display_errors', 0);
require ('../sinyal/config.php');
require ('../sinyal/cek.php');
require ('../sinyal/function.php');

    $user = $_COOKIE['ku'];
    $user = mysqli_query($connect, "SELECT * FROM user WHERE kode = '$user'");
    $user = mysqli_fetch_assoc($user);

    if (isset($_POST["edit"])) {

        if (edit($_POST) > 0) {
            exit;
        }elseif (edit($_POST) == -1) {
            $warningU = "Username sudah digunakan";
        }elseif (edit($_POST) == -2) {
            $warningE = "EMAIL sudah digunakan";
        }
    }

    if (isset($_SESSION["refresh"])) {
        if ($_SESSION["refresh"] > 2) {
            echo "<script>location.replace(location.href)</script>" ;
            $_SESSION["refresh"] = $_SESSION["refresh"] - 1 ;
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cropperjs/dist/cropper.min.css">
    <link rel="stylesheet" href="/global/css/sidenav.css">
    <link rel="stylesheet" href="/global/css/redeem.css">
    <link rel="stylesheet" href="/global/css/minecraft.css">
</head>
<style type="text/css">
    img{
        display: block;
        max-height: 100%;
    }
    .preview{
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }
    </style>
<body>
    <nav>
        <img class="logo" src="/img/MC1.svg">
    </nav>
    <div class="luar">
        <div class="sidenav">
            <div class="img">
                <div class="btn" id="btn_back">
                    <a href="marketing.php"></a>
                    <h2>Profile</h2>
                </div>

                <?php
                    if ($user["image"]=="default") {?>
                        <div class="imgg">
                            <img src="/img/profile.png">
                            <div class="edit_img" onclick="editimg()">
                                <div class="edit_img_list luar-list" id="edit-img">
                                    <div id="tes" ></div>
                                    <ul>
                                        <!-- <li onclick="lihatFoto()">Lihat foto</li> -->
                                        <li>
                                            <form method="post">
                                                <label for="Update_foto">Update foto</label>
                                                <input type="file" name="image" class="image" id="Update_foto">
                                            </form>
                                        </li>
                                        <a class="delete" href="delete_img.php"><li>Hapus foto</li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                <?php }else{ 
                        $user = $_COOKIE['ku'];
                        $user = mysqli_query($connect, "SELECT * FROM user WHERE kode = '$user'");
                        $user = mysqli_fetch_assoc($user);
                        ?>
                        <div class="imgg">
                            <img src= <?= "/img/profile_img/" . $user["image"] . ".png" ?> >
                            <div class="edit_img" onclick="editimg()">
                                <div class="edit_img_list luar-list" id="edit-img">
                                    <div id="tes" ></div>
                                    <ul>
                                        <!-- <li onclick="lihatFoto()">Lihat foto</li> -->
                                        <li>
                                            <form method="post">
                                                <label for="Update_foto">Update foto</label>
                                                <input type="file" name="image" class="image" id="Update_foto">
                                            </form>
                                        </li>
                                        <a class="delete" href="delete_img.php"><li>Hapus foto</li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                
                
                <h2><?= $user["username"] ?></h2>
                <button onclick="edit()" id="btn">Edit Profile</button>
            </div>
            <ul id="list">
                <a href="password.php"><li>Change Password</li></a>
                <a href="projek.php"><li>My Store</li></a>
                <?php if ($user["username"] == "asd") {
                    ?>
                    <a href="#">asdm</a>
                    <?php
                } ?>
                <a href="redeem.php"><li>Redeem</li></a>
                <a href="logout.php"><li>Log Out</li></a>
            </ul>
            <div id="profile">
                <form action="profile.php" method="post">
                    <div class="form_list">
                        <label for="username"><p id="warningU"><?php if (isset($warningU)){echo $warningU; } ?></p>Full name</label>
                        <input type="text" value="<?=$user["username"]?>" name="username" id="username" required placeholder="username" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                    </div>
                    <div class="form_list">
                        <label for="email">
                        <p id="warningE"><?php if (isset($warningE)){echo $warningE; } ?></p>Email</label>
                        <input type="email" value="<?=$user["email"]?>" name="email" id="email" required placeholder="Email@gmail.com" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                    </div>
                    <button type="submit" name="edit">Save</button>
                </form>
            </div>

        </div>
        <div class="konten">
            <p class="judul-awal">Profile</p>
            <div class="card">
                <div class="konten-card">
                    <p class="welcome" >welcome <?= $user["username"] ?></p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLacbel" aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" >
                <div class="modal-header" >
                    <h5 class="modal-title" id="modalLabel" >Crop image</h5>
                </div>
                <div class="modal-body" >
                    <div class="img-container" >
                        <div class="row" >
                            <div class="col-md-8" >
                                <img id="image" >
                            </div>
                            <div class="col-md-4" >
                                <div class="preview" ></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-secondary" id="cancel" data-dismiss="modal" >Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop" >Crop</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="/cropperjs/dist/cropper.min.js" type="text/javascript"></script>
    <script src="/global/js/sidenav.js"></script>
    <script>

        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper,reader,file;
        
        $("body").on("change", ".image", function(e){
            var files = e.target.files;
            var done = function(url){
                image.src = url;
                bs_modal.modal('show');
            };
            
            if (files && files[0].size > 0){
                file = files[0];
                
                if(URL) {
                    done(URL.createObjectURL(file));
            }else if (FileReader){
                reader = new FileReader;
                reader.onload = function(e){
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }else{
                alert("ukuran foto terlalu besar");
            }
        }
    });

    bs_modal.on('shown.bs.modal', function(){
        cropper = new Cropper(image,{
            aspectRatio: 1,
            viewMode :2,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function(){
        cropper.destroy();
        cropper = null;
    });

    $("#cancel").click(function () {
        cropper.destroy();
        cropper = null;
    });
    
    $("#crop").click(function () {
        console.log("klik");
        canvas = cropper.getCroppedCanvas({
            width:160,
            height: 160,
        });
        
        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
                var base64data = reader.result;
                
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "upload.php",
                    data: {image: base64data},
                    success: function(data){
                        bs_modal.modal('hide');
                        window.location.href = '';
                    }
                });
            }
        });
    });

    </script>
</body>
</html>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>