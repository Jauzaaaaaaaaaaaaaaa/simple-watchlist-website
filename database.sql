-- File SQL ini digunakan untuk membuat database, tabel, dan data awal project watchlist.

-- Perintah ini digunakan untuk membuat database jika database belum ada.
CREATE DATABASE IF NOT EXISTS watchlist_ujk;

-- Perintah ini digunakan untuk memilih database yang akan dipakai.
USE watchlist_ujk;

-- DROP TABLE IF EXISTS digunakan agar tabel lama dihapus dulu saat import ulang.
DROP TABLE IF EXISTS movies;
DROP TABLE IF EXISTS users;

-- Tabel users digunakan untuk menyimpan data akun login.
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel movies digunakan untuk menyimpan data watchlist film dan series.
CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    genre VARCHAR(100) NOT NULL,
    tipe ENUM('Film', 'Series') NOT NULL,
    status_tonton ENUM('Belum Ditonton', 'Sedang Ditonton', 'Selesai') NOT NULL,
    rating INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data user default digunakan untuk login pertama kali ke sistem.
-- Password berikut sudah berbentuk hash bcrypt untuk keamanan login.
INSERT INTO users (name, email, password) VALUES
('Admin', 'admin@gmail.com', '$2y$12$ZkPi3JmC6gMPBJiBnW5HEOS1C2dYCKMjAO6L9bCRnuLY0I9OR.4Ui');

-- Data awal movies digunakan sebagai contoh isi watchlist.
INSERT INTO movies (judul, genre, tipe, status_tonton, rating) VALUES
('Avengers: Endgame', 'Action', 'Film', 'Selesai', 9),
('One Piece', 'Adventure', 'Series', 'Sedang Ditonton', 10),
('Interstellar', 'Sci-Fi', 'Film', 'Belum Ditonton', 9);
