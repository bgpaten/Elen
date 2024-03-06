<?php
require "config.php";
$id = $_GET["id"];

$matkul = mysqli_query($connect, "SELECT * FROM mata_kuliah WHERE id=$id");
$nama = htmlspecialchars($_POST["nama"]);
$mulai = htmlspecialchars($_POST["mulai"]);
$selesai = htmlspecialchars($_POST["selesai"]);
$jsoal = htmlspecialchars($_POST["soal"]);
$query = "INSERT INTO soal(nama_soal,tgl_mulai,tgl_selesai,jenis_soal,matkul_id) VALUES ('$nama','$mulai','$selesai','$jsoal','$id')";
$query2 = "SELECT * FROM soal WHERE id='$id'";
$cek_kode = mysqli_query($connect, $query2);

if (isset($_POST["simpan"])) {

    if ($connect->query($query) === TRUE) {
        session_start();
        $_SESSION['tambah'] = "Successfull";

        header("Location: detail_matkul.php?id=$id");
    } else {
        echo "Error: " . $query . "<br>" . $connect->error;
    }

    $connect->close();
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pijar - Learning App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
    foreach ($matkul as $mtk) {
    ?>
        <div class="container mt-5 py-3">
            <div class="card py-3 px-4" style="background-color: #edeff7; border: 0px;">
                <div class="row">
                    <div class="col-md-6 ">
                        <p class="fw-medium m-0"><?= $mtk["nama_matkul"] ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-end m-0" style="font-size: 15px;"><a href="index.php" style="text-decoration: none; color: black;">Home</a> / My Course / <a href="detail_matkul.php?id=<?= $mtk["id"] ?>" style="color: black; text-decoration: none;"><?= $mtk["kode"] ?></a> / Adding a new</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="card px-4 pt-5 pb-3">
                <p class="h3">Adding a new topic</p>
                <form class="row g-3 mt-3" method="post">
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Mata Kuliah</label>
                        <div class="card py-2 px-2" style="background-color: #edeff7; border: 0px;">
                            <p class="fw-medium text-secondary m-0"><?= $mtk["nama_matkul"] ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Nama Soal</label>
                        <input name="nama" type="text" class="form-control" id="inputPassword4" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Tanggal Mulai</label>
                        <input name="mulai" type="date" class="form-control" id="inputEmail4" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Tanggal Selesai</label>
                        <input name="selesai" type="date" class="form-control" id="inputPassword4" required>
                    </div>

                    <div class="col-12">
                        <label class="form-check-label mb-2" for="gridCheck">
                            Jenis Soal
                        </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="soal" id="inlineRadio1" value="t" required>
                            <label class="form-check-label" for="gridCheck">
                                Tugas
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="soal" id="inlineRadio1" value="k" required>
                            <label class="form-check-label" for="gridCheck">
                                Kuis
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="soal" id="inlineRadio1" value="u" required>
                            <label class="form-check-label" for="gridCheck">
                                Ujian
                            </label>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <button name="simpan" type="submit" class="btn btn-success">Save and return to course</button>
                        <a href="detail_matkul.php?id=<?= $mtk['id'] ?>"><button type="button" class="btn btn-outline-success float-end">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>