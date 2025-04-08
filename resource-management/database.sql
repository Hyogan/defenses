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

-- Table des utilisateurs
CREATE TABLE utilisateurs (
    id_utilisateur INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_complet VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('technicien', 'classic') NOT NULL DEFAULT 'classic',
    date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    derniere_connexion TIMESTAMP NULL,
    date_modification TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT chk_email CHECK (email LIKE '%@%.%')
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

-- Ajout d'index pour améliorer les performances
CREATE INDEX idx_materiels_categorie ON materiels(id_categorie);
CREATE INDEX idx_rebus_materiel ON rebus(id_materiel);
CREATE INDEX idx_affectation_materiel ON affectation(id_materiel);
CREATE INDEX idx_affectation_laboratoire ON affectation(id_laboratoire);
CREATE INDEX idx_affectation_service ON affectation(id_service);


INSERT INTO utilisateurs (nom_complet, email, mot_de_passe, role)
VALUES ('johndoe', 'johndoe@gmail.com', '$2y$10$KxmFU/BbNJT0uZQFIyHtHebyljIiXCE3kjtqdZ9Qdo7OstNYMorFG', 'technicien');
