<?php
include "db.php";

// Tambah Soal
if (isset($_POST['tambah'])) {
    $question = $_POST['question'];
    $a = $_POST['option_a'];
    $b = $_POST['option_b'];
    $c = $_POST['option_c'];
    $d = $_POST['option_d'];
    $e = $_POST['option_e'];
    $answer = $_POST['answer'];

    $stmt = $conn->prepare("INSERT INTO questions (question, option_a, option_b, option_c, option_d, option_e, answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $question, $a, $b, $c, $d, $e, $answer);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_questions.php");
    exit;
}

// Hapus Soal
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM questions WHERE id=$id");
    header("Location: manage_questions.php");
    exit;
}

// Ambil soal untuk edit
$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id_edit = $_GET['edit'];
    $soal = $conn->query("SELECT * FROM questions WHERE id=$id_edit")->fetch_assoc();
}

// Simpan hasil edit
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $question = $_POST['question'];
    $a = $_POST['option_a'];
    $b = $_POST['option_b'];
    $c = $_POST['option_c'];
    $d = $_POST['option_d'];
    $e = $_POST['option_e'];
    $answer = $_POST['answer'];

    $stmt = $conn->prepare("UPDATE questions SET question=?, option_a=?, option_b=?, option_c=?, option_d=?, option_e=?, answer=? WHERE id=?");
    $stmt->bind_param("sssssssi", $question, $a, $b, $c, $d, $e, $answer, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_questions.php");
    exit;
}

// Ambil semua soal
$result = $conn->query("SELECT * FROM questions ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Soal Kuis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow p-4">
      <h3 class="text-center mb-3">Kelola Soal Kuis</h3>

      <!-- Form Tambah/Edit Soal -->
      <form method="post">
        <?php if ($edit_mode): ?>
          <input type="hidden" name="id" value="<?= $soal['id'] ?>">
        <?php endif; ?>

        <div class="mb-3">
          <label class="form-label">Pertanyaan</label>
          <textarea name="question" class="form-control" required><?= $edit_mode ? $soal['question'] : '' ?></textarea>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Pilihan A</label>
            <input type="text" name="option_a" class="form-control" required value="<?= $edit_mode ? $soal['option_a'] : '' ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Pilihan B</label>
            <input type="text" name="option_b" class="form-control" required value="<?= $edit_mode ? $soal['option_b'] : '' ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Pilihan C</label>
            <input type="text" name="option_c" class="form-control" required value="<?= $edit_mode ? $soal['option_c'] : '' ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Pilihan D</label>
            <input type="text" name="option_d" class="form-control" required value="<?= $edit_mode ? $soal['option_d'] : '' ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Pilihan E</label>
            <input type="text" name="option_e" class="form-control" required value="<?= $edit_mode ? $soal['option_e'] : '' ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Jawaban Benar</label>
            <select name="answer" class="form-select" required>
              <?php
              $opts = ['A','B','C','D','E'];
              foreach($opts as $opt){
                  $selected = ($edit_mode && $soal['answer'] == $opt) ? 'selected' : '';
                  echo "<option value='$opt' $selected>$opt</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="text-center">
          <?php if ($edit_mode): ?>
            <button type="submit" name="update" class="btn btn-warning px-4">Update Soal</button>
            <a href="manage_questions.php" class="btn btn-secondary px-4">Batal</a>
          <?php else: ?>
            <button type="submit" name="tambah" class="btn btn-success px-4">Tambah Soal</button>
          <?php endif; ?>
        </div>
      </form>

      <hr class="my-4">

      <!-- Daftar Soal -->
      <h5 class="mb-3">Daftar Soal yang Tersimpan</h5>
      <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
          <tr>
            <th>No</th>
            <th>Pertanyaan</th>
            <th>Jawaban Benar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while($row = $result->fetch_assoc()){
              echo "<tr>
                      <td class='text-center'>$no</td>
                      <td>{$row['question']}</td>
                      <td class='text-center'><b>{$row['answer']}</b></td>
                      <td class='text-center'>
                        <a href='manage_questions.php?edit={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                        <a href='manage_questions.php?hapus={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin hapus soal ini?\")'>Hapus</a>
                      </td>
                    </tr>";
              $no++;
          }
          ?>
        </tbody>
      </table>

      <div class="text-center mt-4">
        <a href="quiz.php" class="btn btn-primary">Lihat Halaman Kuis</a>
        <a href="admin.php" class="btn btn-secondary">Rekap Nilai</a>
      </div>

    </div>
  </div>
  
  
  <?php include 'footer.php'; ?>

</body>
</html>
