-- Script de création de la base de données améliorée
-- Système de gestion de matériels et laboratoires
CREATE DATABASE gestion_rebus;
USE gestion_rebus;
-- Suppression des tables si elles existent déjà (pour réinitialisation)
DROP TABLE IF EXISTS affectation;
DROP TABLE IF EXISTS rebus;
DROP TABLE IF EXISTS materiels;
DROP TABLE IF EXISTS laboratoires;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS utilisateurs;
DROP TABLE IF EXISTS demandes_changement;

-- Table des utilisateurs
CREATE TABLE utilisateurs (
    id_utilisateur INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_complet VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    id_service INT,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'technicien', 'utilisateur', 'responsable_laboratoire'),
    date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    derniere_connexion TIMESTAMP NULL,
    date_modification TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT chk_email CHECK (email LIKE '%@%.%'),
    FOREIGN KEY (id_service) REFERENCES services(id_service) ON DELETE RESTRICT
);

-- Table des catégories de matériels
CREATE TABLE categories (
    id_categorie INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
);

-- Table des laboratoires
CREATE TABLE laboratoires (
    id_laboratoire INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    numero VARCHAR(20) NOT NULL UNIQUE,
    localisation VARCHAR(255) NOT NULL,
    description TEXT,
    date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP

);

-- Table des services (ajout d'une table qui semble implicite dans les affectations)
CREATE TABLE services (
    id_service INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    localisation VARCHAR(255),
    description TEXT,
    date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
);

-- Table des matériels
CREATE TABLE materiels (
    id_materiel INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    model VARCHAR(100),
    id_categorie INT NOT NULL,
    date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie) ON DELETE RESTRICT
);

-- Table des matériels mis au rebut
CREATE TABLE rebus (
    id_rebus INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    reference VARCHAR(50) NOT NULL UNIQUE,
    id_materiel INT NOT NULL,
    panne VARCHAR(255) NOT NULL,
    description_panne TEXT,
    date_mise_au_rebut TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_materiel) REFERENCES materiels(id_materiel) ON DELETE CASCADE
);

-- Table d'affectation des matériels
CREATE TABLE affectation (
    id_affectation INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_materiel INT NOT NULL,
    id_laboratoire INT NULL,
    id_service INT NULL,
    date_affectation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_fin_affectation TIMESTAMP NULL,
    FOREIGN KEY (id_materiel) REFERENCES materiels(id_materiel) ON DELETE CASCADE,
    FOREIGN KEY (id_laboratoire) REFERENCES laboratoires(id_laboratoire) ON DELETE SET NULL,
    FOREIGN KEY (id_service) REFERENCES services(id_service) ON DELETE SET NULL
    -- Removed the CHECK constraint as it caused issues with ON DELETE SET NULL
);
CREATE TABLE demandes_changement(
    id_demande INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_materiel INT NOT NULL,
    id_utilisateur INT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    model VARCHAR(100),
    raison VARCHAR(100),
    id_categorie INT NOT NULL,
    date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie) ON DELETE RESTRICT,
    FOREIGN KEY (id_materiel) REFERENCES materiels(id_materiel) ON DELETE RESTRICT,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

-- Ajout d'index pour améliorer les performances
CREATE INDEX idx_materiels_categorie ON materiels(id_categorie);
CREATE INDEX idx_rebus_materiel ON rebus(id_materiel);
CREATE INDEX idx_affectation_materiel ON affectation(id_materiel);
CREATE INDEX idx_affectation_laboratoire ON affectation(id_laboratoire);
CREATE INDEX idx_affectation_service ON affectation(id_service);



-- === Services ===
INSERT INTO services (nom, localisation, description) VALUES
('Informatique', 'Bureau 101', 'Service informatique'),
('Maintenance', 'Atelier 2', 'Service de maintenance'),
('Biologie', 'Bloc C', 'Service de biologie');

-- === Catégories ===
INSERT INTO categories (nom, description) VALUES
('Ordinateurs', 'PC portables, unités centrales, etc.'),
('Microscopes', 'Microscopes optiques, électroniques...'),
('Imprimantes', 'Laser, jet d’encre, 3D...');

-- === Laboratoires ===
INSERT INTO laboratoires (nom, numero, localisation, description) VALUES
('Laboratoire Chimie', 'LAB001', 'Bâtiment A, Étage 2', 'Laboratoire d’expérimentation chimique'),
('Laboratoire Physique', 'LAB002', 'Bâtiment B, Étage 1', 'Laboratoire de physique avancée');

-- === Utilisateurs (dépend de services) ===
INSERT INTO utilisateurs (nom_complet, email, id_service, mot_de_passe, role) VALUES
VALUES ('johndoe', 'johndoe@gmail.com',NULL, '$2y$10$06n4niQnkExPdoV8nWgg4epxV6fpHFYX2oX8T5wHvLCxTxRrSR24a', 'technicien');
('Alice Martin', 'technicien@gmail.com', 1, '$2y$10$06n4niQnkExPdoV8nWgg4epxV6fpHFYX2oX8T5wHvLCxTxRrSR24a', 'technicien'),
('Joseph N', 'reslabo@gmail.com', 2, '$2y$10$06n4niQnkExPdoV8nWgg4epxV6fpHFYX2oX8T5wHvLCxTxRrSR24a', 'responsable_laboratoire'),
('Claire Thomas', 'user@gmail.com', 3, '$2y$10$06n4niQnkExPdoV8nWgg4epxV6fpHFYX2oX8T5wHvLCxTxRrSR24a', 'utilisateur');

-- === Matériels ===
INSERT INTO materiels (nom, description, model, id_categorie) VALUES
('Dell Latitude', 'PC portable pour le développement', 'E7450', 1),
('Canon i-SENSYS', 'Imprimante multifonction', 'LBP6230dw', 3),
('Microscope Binoculaire', 'Utilisé pour l’analyse biologique', 'MB2000', 2),
('HP EliteDesk', 'Unité centrale pour le laboratoire', '800 G5', 1);

-- === Rebus (matériels obsolètes ou en panne) ===
INSERT INTO rebus (reference, id_materiel, panne, description_panne) VALUES
('RB001', 2, 'Impression floue', 'Cartouches usées, mécanisme encrassé'),
('RB002', 3, 'Lentilles cassées', 'Manipulation incorrecte lors du transport');

-- === Affectations (matériel vers labo ou service) ===
INSERT INTO affectation (id_materiel, id_laboratoire, id_service, date_affectation) VALUES
(1, 1, NULL, '2024-01-15 08:00:00'),
(4, 2, NULL, '2024-02-01 09:30:00'),
(2, NULL, 2, '2024-03-10 10:15:00');

-- === Demandes de changement ===
INSERT INTO demandes_changement (id_materiel, id_utilisateur, nom, description, model, raison, id_categorie) VALUES
(1, 3, 'Demande de mise à jour PC', 'Remplacement SSD et ajout RAM', 'E7450', 'Upgrade', 1),
(4, 3, 'Remplacement unité centrale', 'PC trop lent pour usage actuel', '800 G5', 'Performance', 1);
