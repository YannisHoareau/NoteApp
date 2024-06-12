USE note_app;

DROP TABLE IF EXISTS notes;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       login VARCHAR(255) NOT NULL,
                       firstname VARCHAR(255) NOT NULL,
                       lastname VARCHAR(255),
                       email VARCHAR(255),
                       password VARCHAR(255) NOT NULL,
                       created DATETIME,
                       modified DATETIME
);

CREATE TABLE notes (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          user_id INT NOT NULL,
                          title VARCHAR(255) NOT NULL,
                          slug VARCHAR(191) NOT NULL,
                          body TEXT,
                          created DATETIME,
                          modified DATETIME,
                          UNIQUE KEY (slug),
                          FOREIGN KEY user_key (user_id) REFERENCES users(id)
) CHARSET=utf8mb4;

INSERT INTO users (login, firstname, password, created, modified)
VALUES
    ('admin', 'admin', 'password', NOW(), NOW());

INSERT INTO notes (user_id, title, slug, body, created, modified)
VALUES
    (1, 'First note', 'first-note', 'This is the first note.', NOW(), NOW());
