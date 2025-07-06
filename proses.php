<?php
// Nama file penyimpanan data
$file = 'data.txt';

// Inisialisasi array jika file belum ada
if (!file_exists($file)) {
    $initData = [
        'yes' => 0,
        'no' => 0,
        'maybe' => 0
    ];
    file_put_contents($file, json_encode($initData));
}

// Baca data suara saat ini
$data = json_decode(file_get_contents($file), true);

// Validasi input
if (isset($_POST['vote']) && in_array($_POST['vote'], ['yes', 'no', 'maybe'])) {
    $vote = $_POST['vote'];
    $data[$vote] += 1;

    // Simpan data terbaru
    file_put_contents($file, json_encode($data));
} else {
    echo "Pilihan tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Polling</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .result { border: 1px solid #ccc; padding: 20px; max-width: 400px; }
    </style>
</head>
<body>
    <div class="result">
        <h3>Hasil Polling:</h3>
        <ul>
            <li>Ya: <?= $data['yes']; ?> suara</li>
            <li>Tidak: <?= $data['no']; ?> suara</li>
            <li>Mungkin: <?= $data['maybe']; ?> suara</li>
        </ul>
        <a href="polling.html">Kembali ke Polling</a>
    </div>
</body>
</html>