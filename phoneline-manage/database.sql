CREATE DATABASE gestion_lignes;

USE gestion_lignes;

CREATE TABLE lignes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_ligne VARCHAR(255),
    numero_ligne VARCHAR(255),
    marque_poste VARCHAR(255),
    nom_proprietaire VARCHAR(255),
    numero_port VARCHAR(255),
    numero_bandeau VARCHAR(255),
    numero_fusible VARCHAR(255),
    numero_jarretiere VARCHAR(255)
);

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    statut ENUM('actif','inactif') DEFAULT 'actif',
    mot_de_passe VARCHAR(255),
    role ENUM('admin', 'classic') DEFAULT 'classic'
);

CREATE TABLE logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  action VARCHAR(255),
  message VARCHAR(255),
  id_utilisateur INT,
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
);

ALTER TABLE utilisateurs ADD COLUMN date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE utilisateurs ADD COLUMN  date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
-- credentials : email(admin@example.com) , mot de passe : 123
INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role)
VALUES ('admin', 'admin', 'admin@example.com', '$2y$10$1/UlEDDpr4LMovXm59sW0ecEsj.Xxxw5l.0r/iXmP3WmHcK487IcO
', 'admin');

