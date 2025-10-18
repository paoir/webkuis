<?php
session_start();
include "db.php";

if (!isset($_SESSION['nama'])) {
    header("Location: index.php");
    exit;
}

$jawaban = $_POST['jawaban'];
$score = 0;
foreach ($jawaban as $id => $jwb) {
    $res = $conn->query("SELECT answer FROM questions WHERE id=$id");
    $row = $res->fetch_assoc();
    if ($row['answer'] == $jwb) $score++;
}
$total = count($jawaban);
$nilai = ($score / $total) * 100;

$stmt = $conn->prepare("INSERT INTO participants (nama, npm, score) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $_SESSION['nama'], $_SESSION['npm'], $nilai);
$stmt->execute();
$stmt->close();

session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Kuis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="col-md-6 mx-auto card shadow p-4 text-center">
      <h3>Terima kasih telah mengikuti kuis!</h3>
      <p class="mt-3">Nilai Anda:</p>
      <h1 class="text-success"><?php echo round($nilai,2); ?></h1>
      <a href="index.php" class="btn btn-primary mt-3">Kembali ke Halaman Awal</a>
    </div>
  </div>
  
  <?php include 'footer.php'; ?>
  
</body>
</html>
