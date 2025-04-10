<div class="list">
    <ul>
        <li><a href="/index.php">home</a></li>
        <li><a href="marketing.php?page=all">all</a></li>
        <li><a href="marketing.php?page=skin">skin</a></li>
        <li class="active"><a>texture</a></li>
        <li><a href="marketing.php?page=maps">adventure maps</a></li>
        <li><a href="marketing.php?page=mini-games">mini games</a></li>
    </ul>
</div>

<div class="market-konten">
    <div class="judul">
        <h3>MOST POPULAR TEXTURE</h3>
    </div>
    <div class="isi-konten" id="menu1">
        <?php
        if(isset($_POST["cari"])){
            $tampilkan = $_POST["keyword"];
            $sql = "SELECT * FROM data WHERE judul LIKE '%$tampilkan%' AND `kategori` = 'texture' ORDER BY `data`.`populer` DESC LIMIT 0,4";
        }else{
            $sql = "SELECT * FROM `data` WHERE `kategori` = 'texture' ORDER BY `data`.`populer` DESC LIMIT 0,4";   
        }
        $tampilkan = mysqli_query($connect, $sql);
        while ($data = mysqli_fetch_assoc($tampilkan)): ?>
            <a href=<?= "tampilan.php?id=" . $data['id']?>>
                <div class="marketing-konten">
                    <div class="image-konten">
                        <img loading="lazy" loading="lazy" src=<?= "/img/data/" . $data['image'] ?> alt=<?= $data['judul'] ?> />
                    </div>
                    <div>
                        <p>
                            <?= $data['judul'] ?>
                        </p>
                        <p>
                        BY <?= $data['pembuat'] ?>
                        </p>
                        <?php 
                            if(!$data['harga'] == 0){?>
                                <div class="harga">
                                    <p>
                                        <?= $data['harga'] ?>
                                    </p>
                                    <img loading="lazy" src="/img/Minecraft_Desktop_1366_Minecoin.png" />
                                </div>
                            <?php }
                            else{ ?>
                                <div class="harga">
                                                    <p>
                                                        FREE
                                                    </p>
                                    </div>
                            <?php }
                        ?>
                    </div>
                </div>
            </a>
        <?php endwhile ?>
    </div>
</div>

<div class="market-konten">
    <div class="judul">
        <h3>RECENTLY ADDED TEXTURE</h3>
    </div>
    <div class="isi-konten" id="menu1">
        <?php
        if(isset($_POST["cari"])){
            $tampilkan = $_POST["keyword"];
            $sql = "SELECT * FROM data WHERE judul LIKE '%$tampilkan%' AND `kategori` = 'texture' ORDER BY `data`.`id` DESC";
        }else{
            $sql = "SELECT * FROM `data` WHERE `kategori` = 'texture' ORDER BY `data`.`id` DESC";   
        }
        $tampilkan = mysqli_query($connect, $sql);
        while ($data = mysqli_fetch_assoc($tampilkan)): ?>
            <a href=<?= "tampilan.php?id=" . $data['id']?>>
                <div class="marketing-konten">
                <div class="image-konten">
                        <img loading="lazy" loading="lazy" src=<?= "/img/data/" . $data['image'] ?> alt=<?= $data['judul'] ?> />
                    </div>
                    <div>
                        <p>
                            <?= $data['judul'] ?>
                        </p>
                        <p>
                        BY <?= $data['pembuat'] ?>
                        </p>
                        <?php 
                            if(!$data['harga'] == 0){?>
                                <div class="harga">
                                    <p>
                                        <?= $data['harga'] ?>
                                    </p>
                                    <img loading="lazy" src="/img/Minecraft_Desktop_1366_Minecoin.png" />
                                </div>
                            <?php }
                            else{ ?>
                                <div class="harga">
                                                    <p>
                                                        FREE
                                                    </p>
                                    </div>
                            <?php }
                        ?>
                    </div>
                </div>
            </a>
        <?php endwhile ?>
    </div>
</div>