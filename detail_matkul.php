<?php
require "config.php";
$id = $_GET["id"];
session_start();
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
    $query = "SELECT * FROM mata_kuliah WHERE id=$id";
    $matkul = mysqli_query($connect, $query);

    foreach ($matkul as $mtk) {
    ?>
        <div class="container mt-5 py-3">
            <div class="mb-3">
                <?php
                if (isset($_SESSION['hapus'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>" . $_SESSION['hapus'] . "</strong> Data has been deleted
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
                    session_destroy();
                } elseif (isset($_SESSION['tambah'])) {
                    session_start();
                ?>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        swal("Successfull", "Data has been added", "success");
                    </script>
                <?php
                    session_destroy();
                }
                ?>
            </div>
            <div class="card py-3 px-4" style="background-color: #edeff7; border: 0px;">
                <p class="text-end m-0" style="font-size: 15px;"><a href="index.php" style="text-decoration: none; color: black;">Home</a> / My Course / <span class="text-success"><?= $mtk["kode"] ?></span></p>
            </div>
        </div>



        <div class="container">
            <div class="card mx-0 px-3 pt-5 pb-3">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="fs-5 fw-medium">Course Content</p>
                    </div>
                    <div class="col-md-6">
                        <?php
                        $query1 = "SELECT kategori.kategori FROM kategori INNER JOIN mata_kuliah ON kategori.id = mata_kuliah.kategori_id WHERE mata_kuliah.id = '$id'";
                        $kategori = mysqli_query($connect, $query1);

                        foreach ($kategori as $ktg) {
                        ?>
                            <p class="text-secondary text-end">Category : Mata Kuliah <?= $ktg["kategori"] ?></p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                $query2 = "SELECT soal.* FROM soal INNER JOIN mata_kuliah ON mata_kuliah.id = soal.matkul_id WHERE mata_kuliah.id = '$id'";
                $soal = mysqli_query($connect, $query2);

                $no = 0;
                foreach ($soal as $sol) {
                    $detline = (new DateTime($sol['tgl_selesai']))->diff(new DateTime($sol['tgl_mulai']))->days;
                    $no++;
                ?>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $no ?>" aria-expanded="true" aria-controls="collapse<?= $no ?>">
                                    <?= $sol["nama_soal"] ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $no ?>" class="accordion-collapse collapse <?= $no == 1 ? '' : '' ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Kategori
                                                <?php
                                                if ($sol["jenis_soal"] == 't') {
                                                ?>
                                                    <span class="badge text-bg-success">Tugas</span>
                                                <?php
                                                } elseif ($sol["jenis_soal"] == 'k') {
                                                ?>
                                                    <span class="badge text-bg-warning">Kuis</span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="badge text-bg-danger">Ujian</span>
                                                <?php
                                                }
                                                ?>
                                            </p>

                                            <p>- Dateline <span class="text-danger"><?= $detline ?> hari lagi</span></p>

                                        </div>
                                        <div class="col md-6">
                                            <a href="hapus.php?id=<?= $sol["id"] ?>" onclick="return confirm('Apakah anda yakin data ini akan dihapus ?')">
                                                <p class="text-end"><i class="fa fa-trash" style="border: 1px solid red; padding: 10px; color: red; border-radius: 8px;"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="container pt-4">
            <a href="add_topic.php?id=<?= $mtk["id"] ?>"><button type="button" class="btn" style="background-color: #63b0dd; color: white;"><i class="fa fa-plus-circle"></i> Add Topic</button></a>
        </div>
    <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>