CREATE DATABASE IF NOT EXISTS watchlist_ujk;
USE watchlist_ujk;

DROP TABLE IF EXISTS movies;
DROP TABLE IF EXISTS platforms;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE platforms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_platform VARCHAR(100) NOT NULL UNIQUE,
    website VARCHAR(150) DEFAULT NULL,
    biaya_bulanan DECIMAL(10,2) DEFAULT 0,
    keterangan TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    genre VARCHAR(100) NOT NULL,
    tipe ENUM('Film', 'Series') NOT NULL,
    status_tonton ENUM('Belum Ditonton', 'Sedang Ditonton', 'Selesai') NOT NULL,
    rating INT NOT NULL,
    platform_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_movies_platforms
        FOREIGN KEY (platform_id) REFERENCES platforms(id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

INSERT INTO users (name, email, password) VALUES
('Admin', 'admin@gmail.com', '$2y$12$ZkPi3JmC6gMPBJiBnW5HEOS1C2dYCKMjAO6L9bCRnuLY0I9OR.4Ui');

INSERT INTO platforms (nama_platform, website, biaya_bulanan, keterangan) VALUES
('Netflix', 'https://www.netflix.com', 65000.00, 'Platform streaming film dan series populer.'),
('Disney+ Hotstar', 'https://www.hotstar.com', 39000.00, 'Cocok untuk film keluarga, Marvel, dan Disney.'),
('Prime Video', 'https://www.primevideo.com', 59000.00, 'Platform streaming dari Amazon.');

INSERT INTO movies (judul, genre, tipe, status_tonton, rating, platform_id) VALUES
('Avengers: Endgame', 'Action', 'Film', 'Selesai', 9, 2),
('One Piece', 'Adventure', 'Series', 'Sedang Ditonton', 10, 1),
('Interstellar', 'Sci-Fi', 'Film', 'Belum Ditonton', 9, 3);
