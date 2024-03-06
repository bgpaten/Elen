<?php
require "config.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pijar - Learning App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7ae1982935.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar" style="background-color: #63b0dd;">
        <div class="container-fluid px-5">
            <a class="navbar-brand" href="index.php"><span class="fw-bold" style="color: white;">Elen PeTIK</span></a>
            <form class="d-flex">
                <button class="btn btn-warning btn-sm" type="submit">Login</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid" style="background-color: #eef0e5; padding-top: 10%; padding-bottom: 10%;">
        <div class="text-center">
            <p class="fs-1 fw-bold mb-0">E-Learning PeTIK</p>
            <p>Platfrom pembelajaran online Pesantren PeTIK</p>
            <button type="button" class="btn btn-outline-success">Ready to get started ?</button>
        </div>
    </div>

    <div class="container mt-5">
    <?php
    $query = "SELECT kategori.* FROM kategori";
    $kategori = mysqli_query($connect, $query);
    ?>

    <?php
    foreach ($kategori as $ktg) {
        $query1 = "SELECT pengajar.nama, mata_kuliah.* FROM mata_kuliah INNER JOIN pengajar ON mata_kuliah.pengajar_id = pengajar.id WHERE mata_kuliah.kategori_id = " . $ktg["id"] . " ORDER BY mata_kuliah.nama_matkul ASC LIMIT 3 ";
        $matkul = mysqli_query($connect, $query1);
    ?>

        <div class="row">
            <div class="col-md-6">
                <p class="fs-4 fw-bold">Mata Kuliah <?= $ktg["kategori"] ?></p>
            </div>
            <div class="col-md-6">
                <a style="color: black;" href="show.php?id=<?= $ktg["id"] ?>"><p class="float-end fw-bold"><i class="fa fa-list-ul"></i> Lihat semua</p></a>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            <?php
            foreach ($matkul as $mtk) {
            ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="img/photo_2023-12-25_13-18-13.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p>Dosen : <span class="text-info"><?= $mtk["nama"] ?></span></p>
                            <a style="text-decoration: none; color: black;" href="detail_matkul.php?id=<?= $mtk["id"] ?>"><h5 class="card-title"><?= $mtk["nama_matkul"] ?></h5></a>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary"><i class="fa fa-user"></i> <?= $mtk["jumlah_peserta"] ?> Peserta</small>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>