CREATE DATABASE IF NOT EXISTS `internship_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `internship_management`;
-- Table des utilisateurs (Admins, Superviseurs, Tuteurs, Stagiaires)
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'superviseur', 'tuteur', 'stagiaire') NOT NULL,
    statut VARCHAR(10) NOT NULL DEFAULT 'active',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Index pour accélérer la recherche d'un utilisateur par email
CREATE INDEX idx_utilisateurs_email ON utilisateurs(email);

-- Table des stagiaires
CREATE TABLE stagiaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL UNIQUE, -- Un utilisateur ne peut être stagiaire qu'une seule fois
    formation VARCHAR(255) NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

-- Index pour accélérer les requêtes sur les stagiaires
CREATE INDEX idx_stagiaires_utilisateur_id ON stagiaires(utilisateur_id);

-- Table des tuteurs
CREATE TABLE tuteurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL UNIQUE, -- Un utilisateur ne peut être tuteur qu'une seule fois
    departement VARCHAR(255) NOT NULL,
    poste VARCHAR(255) NOT NULL,
    experience TEXT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

-- Index pour accélérer la recherche des tuteurs
CREATE INDEX idx_tuteurs_utilisateur_id ON tuteurs(utilisateur_id);

-- Table des affectations tuteurs <-> stagiaires (relation many-to-many)
CREATE TABLE affectations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stagiaire_id INT NOT NULL,
    tuteur_id INT NOT NULL,
    date_affectation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (stagiaire_id) REFERENCES stagiaires(id) ON DELETE CASCADE,
    FOREIGN KEY (tuteur_id) REFERENCES tuteurs(id) ON DELETE CASCADE,
    UNIQUE (stagiaire_id, tuteur_id) -- Un stagiaire ne peut avoir le même tuteur plusieurs fois
);

-- Index sur les affectations pour optimiser les jointures
CREATE INDEX idx_affectations_stagiaire_id ON affectations(stagiaire_id);
CREATE INDEX idx_affectations_tuteur_id ON affectations(tuteur_id);

-- Table des tâches assignées aux stagiaires
CREATE TABLE taches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stagiaire_id INT NOT NULL,
    tuteur_id INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    date_limite DATE NOT NULL,
    statut ENUM('en attente', 'en cours', 'terminée') DEFAULT 'en attente',
    ancien_pourcentage INT CHECK (ancien_pourcentage BETWEEN 0 AND 100),
    nouveau_pourcentage INT CHECK (nouveau_pourcentage BETWEEN 0 AND 100),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (stagiaire_id) REFERENCES stagiaires(id) ON DELETE CASCADE,
    FOREIGN KEY (tuteur_id) REFERENCES tuteurs(id) ON DELETE CASCADE
);


-- Index sur les tâches pour optimiser les requêtes
CREATE INDEX idx_taches_stagiaire_id ON taches(stagiaire_id);
CREATE INDEX idx_taches_tuteur_id ON taches(tuteur_id);

-- Table des documents liés aux stages
CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stagiaire_id INT NOT NULL,
    nom_fichier VARCHAR(255) NOT NULL,
    chemin_fichier VARCHAR(255) NOT NULL,
    type_fichier VARCHAR(50) NOT NULL,
    taille INT NOT NULL, -- Stocker la taille en octets
    date_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,............
    FOREIGN KEY (stagiaire_id) REFERENCES stagiaires(id) ON DELETE CASCADE
);

-- Index pour accélérer les recherches de documents
CREATE INDEX idx_documents_stagiaire_id ON documents(stagiaire_id);



CREATE TABLE evaluations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stagiaire_id INT NOT NULL,
    tuteur_id INT NOT NULL,
    note DECIMAL(3, 1) NOT NULL,
    commentaires TEXT,
    date_evaluation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (stagiaire_id) REFERENCES stagiaires(id),
    FOREIGN KEY (tuteur_id) REFERENCES tuteurs(id)
);

