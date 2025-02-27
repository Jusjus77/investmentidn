<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $amount = $_POST["amount"];
    $fileName = basename($_FILES["proof"]["name"]);
    $targetFile = $uploadDir . $fileName;
    $uploadOk = 1;

    // Cek apakah file adalah gambar
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["proof"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["proof"]["size"] > 5000000) { // Maksimum 5MB
        echo "File terlalu besar.";
        $uploadOk = 0;
    }

    // Hanya izinkan format tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Jika semuanya baik, unggah file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["proof"]["tmp_name"], $targetFile)) {
            echo "Bukti transfer berhasil diunggah.";
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>
