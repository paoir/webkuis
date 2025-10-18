<?php
include "db.php";
$result = $conn->query("SELECT * FROM participants ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rekap Nilai Kuis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow p-4">
      <h3 class="text-center mb-3">Rekap Nilai Peserta Kuis</h3>
      <table class="table table-striped table-bordered text-center">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NPM</th>
            <th>Nilai</th>
            <th>Waktu Submit</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no=1;
          while($row = $result->fetch_assoc()) {
              echo "<tr>
                    <td>$no</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['npm']}</td>
                    <td><strong>{$row['score']}</strong></td>
                    <td>{$row['created_at']}</td>
                    </tr>";
              $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  
  
  <?php include 'footer.php'; ?>

</body>
</html>
