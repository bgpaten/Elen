<?php
require "config.php";
$id = $_GET["id"];
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
    <?php
    $query = "SELECT * FROM kategori WHERE id=$id";
    $kategori = mysqli_query($connect, $query);

    foreach ($kategori as $ktg) {
    ?>

        <div class="container mt-5 py-3">
            <div class="card py-3 px-3" style="background-color: #edeff7; border: 0px;">
                <p class="text-end m-0" style="font-size: 15px;"><a href="index.php" style="color: black; text-decoration: none;">Home</a> / My Course / <span class="text-success"><?= $ktg["kategori"] ?></span></p>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="container mt-5">

        <?php
        $query1 = "SELECT pengajar.nama, mata_kuliah.* FROM mata_kuliah INNER JOIN pengajar ON mata_kuliah.pengajar_id = pengajar.id WHERE mata_kuliah.kategori_id =$id";
        $matkul = mysqli_query($connect, $query1);
        $jum = mysqli_num_rows($matkul);
        ?>
        <p class="mb-5">Total <?= $jum ?> mata kuliah</p>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            foreach ($matkul as $mtk) {
            ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <img src="img/photo_2023-12-25_13-18-13.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p>Dosen : <span class="text-info"><?= $mtk["nama"] ?></span></p>
                            <a style="text-decoration: none; color: black;" href="view.php?id=<?= $mtk["id"] ?>"><h5 class="card-title"><?= $mtk["nama_matkul"] ?></h5></a>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

