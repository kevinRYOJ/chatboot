-- ============================================================
--  All-in-One Sport Chatbot — Database Schema
--  Engine: MySQL 5.7+ / MariaDB 10.3+
-- ============================================================

CREATE DATABASE IF NOT EXISTS sportchatbot CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sportchatbot;

-- ----- Tabel Users (Sistem Login) -----
CREATE TABLE IF NOT EXISTS users (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    email         VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_login    DATETIME     NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----- Tabel Chat Sessions (Satu sesi = satu percakapan) -----
CREATE TABLE IF NOT EXISTS chat_sessions (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id    INT UNSIGNED NOT NULL,
    mode       ENUM('workout','nutrisi','info') NOT NULL DEFAULT 'workout',
    title      VARCHAR(255) NULL COMMENT 'Diambil dari pesan pertama user (auto-generated)',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_updated (user_id, updated_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----- Tabel Chat Messages (Isi percakapan per sesi) -----
CREATE TABLE IF NOT EXISTS chat_messages (
    id               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    session_id       INT UNSIGNED NOT NULL,
    role             ENUM('user','assistant') NOT NULL,
    content          TEXT         NOT NULL,
    model_used       VARCHAR(80)  NULL COMMENT 'Model Gemini yang dipakai (hanya untuk role assistant)',
    prompt_tokens    INT UNSIGNED NULL,
    completion_tokens INT UNSIGNED NULL,
    total_tokens     INT UNSIGNED NULL,
    created_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES chat_sessions(id) ON DELETE CASCADE,
    INDEX idx_session_created (session_id, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
