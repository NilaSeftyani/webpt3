<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Nilai Akademik</title>
    <style>
        /* Styles can be added for better presentation */
    </style>
</head>
<body>

<?php
// Fungsi untuk menentukan grade
function hitungGrade($nilaiAkhir) {
    if ($nilaiAkhir >= 80) {
        return 'A';
    } elseif ($nilaiAkhir >= 70) {
        return 'B';
    } elseif ($nilaiAkhir >= 60) {
        return 'C';
    } elseif ($nilaiAkhir >= 50) {
        return 'D';
    } else {
        return 'E';
    }
}

// Fungsi untuk menentukan keterangan lulus atau tidak
function keteranganLulus($nilaiAkhir) {
    return ($nilaiAkhir > 65) ? 'Lulus' : 'Tidak Lulus';
}

// Inisialisasi variabel
$nama = $nim = $matakuliah = $jumlahKehadiran = $nilaiTugas = $nilaiUTS = $nilaiUAS = "";
$nilaiAkhir = $grade = $keterangan = $bobotKehadiran = $bobotTugas = $bobotUTS = $bobotUAS = 0;

// Menggunakan metode POST untuk mengambil data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = test_input($_POST["nama"]);
    $nim = test_input($_POST["nim"]);
    $matakuliah = test_input($_POST["matakuliah"]);
    $jumlahKehadiran = test_input($_POST["jumlahKehadiran"]);
    $nilaiTugas = test_input($_POST["nilaiTugas"]);
    $nilaiUTS = test_input($_POST["nilaiUTS"]);
    $nilaiUAS = test_input($_POST["nilaiUAS"]);

    // Bobot kehadiran 10%, tugas 20%, UTS 30%, UAS 40%
    $bobotKehadiran = min($jumlahKehadiran / 18 * 10, 10);
    $bobotTugas = $nilaiTugas * 0.2;
    $bobotUTS = $nilaiUTS * 0.3;
    $bobotUAS = $nilaiUAS * 0.4;

    // Menghitung nilai akhir
    $nilaiAkhir = $bobotKehadiran + $bobotTugas + $bobotUTS + $bobotUAS;

    // Menentukan grade
    $grade = hitungGrade($nilaiAkhir);

    // Menentukan keterangan lulus atau tidak
    $keterangan = keteranganLulus($nilaiAkhir);
}

// Fungsi untuk membersihkan dan memvalidasi input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>NILAI AKADEMIK - <?= $matakuliah ?></h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required>

    <label for="nim">NIM:</label>
    <input type="text" name="nim" required>

    <label for="matakuliah">Matakuliah:</label>
    <input type="text" name="matakuliah" required>

    <label for="jumlahKehadiran">Jumlah Kehadiran:</label>
    <input type="number" name="jumlahKehadiran" required>

    <label for="nilaiTugas">Nilai Tugas:</label>
    <input type="number" name="nilaiTugas" required>

    <label for="nilaiUTS">Nilai UTS:</label>
    <input type="number" name="nilaiUTS" required>

    <label for="nilaiUAS">Nilai UAS:</label>
    <input type="number" name="nilaiUAS" required>

    <input type="submit" name="submit" value="Hasil">
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
    <h3>Hasil Perhitungan:</h3>
    <p>Nama: <?= $nama ?></p>
    <p>NIM: <?= $nim ?></p>
    <p>Jumlah Kehadiran: <?= $jumlahKehadiran ?></p>
    <p>Nilai Kehadiran: <?= $bobotKehadiran?></p>
    <p>Nilai Tugas: <?= $nilaiTugas ?></p>
    <p>Nilai UTS: <?= $nilaiUTS ?></p>
    <p>Nilai UAS: <?= $nilaiUAS ?></p>
    <p>Nilai Akhir: <?= $nilaiAkhir ?></p>
    <p>Grade: <?= $grade ?></p>
    <p>Keterangan: <?= $keterangan ?></p>
<?php endif; ?>

</body>
</html>
