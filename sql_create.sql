CREATE DATABASE db_kuis;
USE db_kuis;

CREATE TABLE participants (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  npm VARCHAR(20),
  score INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question TEXT,
  option_a VARCHAR(255),
  option_b VARCHAR(255),
  option_c VARCHAR(255),
  option_d VARCHAR(255),
  option_e VARCHAR(255),
  answer CHAR(1)
);

-- Contoh 2 soal (isi 20 sesuai kebutuhan)
INSERT INTO questions (question, option_a, option_b, option_c, option_d, option_e, answer) VALUES
('CPU bertugas sebagai?', 'Pengatur lalu lintas data', 'Tempat penyimpanan data', 'Perangkat input', 'Perangkat output', 'Perangkat jaringan', 'A'),
('RAM digunakan untuk?', 'Menyimpan data permanen', 'Proses eksekusi sementara', 'Menghubungkan jaringan', 'Mencetak dokumen', 'Menjalankan perintah BIOS', 'B');
