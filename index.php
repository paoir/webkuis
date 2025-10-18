<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Masuk Kuis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="col-md-6 mx-auto card shadow p-4">
      <h3 class="text-center mb-3">Login Peserta Kuis</h3>
      <form action="quiz.php" method="post">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" name="nama" required>
        </div>
        <div class="mb-3">
          <label for="npm" class="form-label">Nomor NPM</label>
          <input type="text" class="form-control" name="npm" required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary px-4">Mulai Kuis</button>
        </div>
      </form>
    </div>
  </div>
  
  <?php include 'footer.php'; ?>

</body>
</html>
