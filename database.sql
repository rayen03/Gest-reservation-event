CREATE DATABASE IF NOT EXISTS minievent CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE minievent;


DROP TABLE IF EXISTS reservations;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS admin;

-- events
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    date DATETIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    seats INT NOT NULL DEFAULT 0,
    image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_date (date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- reservations
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    INDEX idx_event_id (event_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: admin
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- default admin user

INSERT INTO admin (username, password_hash) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

--test data
INSERT INTO events (title, description, date, location, seats, image) VALUES
('Conference Tech 2025', 'Une conférence internationale sur les dernières innovations technologiques et l''intelligence artificielle.', '2025-12-15 09:00:00', 'Centre de Conférence, Tunis', 150, 'tech-conference.jpg'),
('Festival de Musique', 'Un festival de musique en plein air avec des artistes locaux et internationaux.', '2025-12-20 18:00:00', 'Parc National, Carthage', 500, 'music-festival.jpg'),
('Atelier de Développement Web', 'Apprenez les bases du développement web moderne avec React et Node.js.', '2025-11-30 10:00:00', 'Institut Supérieur, Sousse', 30, 'web-workshop.jpg'),
('Soirée Networking Startup', 'Rencontrez des entrepreneurs et investisseurs pour développer votre réseau professionnel.', '2025-12-10 19:00:00', 'El Manar, Tunis', 80, 'networking.jpg');

INSERT INTO reservations (event_id, name, email, phone) VALUES
(1, 'Ahmed Ben Ali', 'ahmed.benali@email.com', '+216 20 123 456'),
(1, 'Fatma Jlassi', 'fatma.jlassi@email.com', '+216 22 234 567'),
(2, 'Mohamed Trabelsi', 'mohamed.trabelsi@email.com', '+216 24 345 678');
`