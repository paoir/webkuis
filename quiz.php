<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nama'])) {
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['npm'] = $_POST['npm'];
}

if (!isset($_SESSION['nama'])) {
    header("Location: index.php");
    exit;
}

$result = $conn->query("SELECT * FROM questions ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kuis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-4">
    <div class="card shadow p-4">
      <h3 class="text-center mb-4">Kuis Mata Kuliah</h3>
      <form method="post" action="result.php">
        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<div class='mb-4'>";
            echo "<p><strong>$no. {$row['question']}</strong></p>";
            foreach (['A','B','C','D','E'] as $opt) {
                echo "
                <div class='form-check'>
                  <input class='form-check-input' type='radio' name='jawaban[{$row['id']}]' value='$opt' required>
                  <label class='form-check-label'>{$row['option_'.strtolower($opt)]}</label>
                </div>";
            }
            echo "</div><hr>";
            $no++;
        }
        ?>
        <div class="text-center">
          <button type="submit" class="btn btn-success px-5">Kirim Jawaban</button>
        </div>
      </form>
    </div>
  </div>
  
  <?php include 'footer.php'; ?>
  
</body>
</html>
