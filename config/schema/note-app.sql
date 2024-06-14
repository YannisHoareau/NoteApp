USE note_app;

DROP TABLE IF EXISTS notes_tags;
DROP TABLE IF EXISTS notes;
DROP TABLE IF EXISTS tags;
DROP TABLE IF EXISTS colors;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME,
    UNIQUE KEY (login)
);

CREATE TABLE colors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(191),
    hexa_code CHAR(7),
    UNIQUE KEY (title)
);

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    color_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(191) NOT NULL,
    body TEXT,
    created DATETIME,
    modified DATETIME,
    UNIQUE KEY (slug),
    FOREIGN KEY user_key (user_id) REFERENCES users(id),
    FOREIGN KEY color_key (color_id) REFERENCES colors(id)
) CHARSET=utf8mb4;

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(191),
    created DATETIME,
    modified DATETIME,
    UNIQUE KEY (title)
) CHARSET=utf8mb4;

CREATE TABLE notes_tags (
    note_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (note_id, tag_id),
    FOREIGN KEY tag_key(tag_id) REFERENCES tags(id),
    FOREIGN KEY note_key(note_id) REFERENCES notes(id)
);

CREATE TABLE password_reset_token (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(191),
    exp_date DATETIME,
    UNIQUE KEY (token),
    FOREIGN KEY rp_user_key (user_id) REFERENCES users(id)
) CHARSET=utf8mb4;

INSERT INTO users (login, firstname, password, created, modified)
VALUES
    ('admin', 'admin', 'password', NOW(), NOW());

INSERT INTO colors (title, hexa_code)
VALUES
    ('White', '#FFFFFF');

INSERT INTO notes (user_id, color_id, title, slug, body, created, modified)
VALUES
    (1, 1, 'First note', 'first-note', 'This is the first note.', NOW(), NOW());
