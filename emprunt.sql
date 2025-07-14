CREATE TABLE membre (
    id_membre INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE,
    genre ENUM('Homme', 'Femme', 'Autre'),
    email VARCHAR(150) UNIQUE NOT NULL,
    ville VARCHAR(100),
    mdp VARCHAR(255) NOT NULL,
    image_profil VARCHAR(255)
);

CREATE TABLE categorie_objet (
    id_categorie INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);

CREATE TABLE objet (
    id_objet INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100) NOT NULL,
    id_categorie INT UNSIGNED,
    id_membre INT UNSIGNED,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie) ON DELETE SET NULL,
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre) ON DELETE CASCADE
);

CREATE TABLE images_objet (
    id_image INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_objet INT UNSIGNED,
    nom_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE
);

CREATE TABLE emprunt (
    id_emprunt INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_objet INT UNSIGNED,
    id_membre INT UNSIGNED,
    date_emprunt DATE NOT NULL,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE,
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre) ON DELETE CASCADE
);

-- 👥 Insertion des membres
INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice Martin', '1990-05-12', 'Femme', 'alice@mail.com', 'Paris', 'mdp1', 'alice.jpg'),
('Bob Dupont', '1985-11-03', 'Homme', 'bob@mail.com', 'Lyon', 'mdp2', 'bob.jpg'),
('Claire Durand', '1992-07-25', 'Femme', 'claire@mail.com', 'Marseille', 'mdp3', 'claire.jpg'),
('David Morel', '1980-03-17', 'Homme', 'david@mail.com', 'Toulouse', 'mdp4', 'david.jpg');

-- 📦 Insertion des catégories
INSERT INTO categorie_objet (nom_categorie) VALUES
('Esthétique'), ('Bricolage'), ('Mécanique'), ('Cuisine');

-- 📦 Insertion des objets (10 par membre)
-- Membre 1
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1), ('Perceuse', 2, 1), ('Tournevis', 2, 1),
('Moteur 12V', 3, 1), ('Robot pâtissier', 4, 1), ('Mixeur', 4, 1),
('Clé plate', 3, 1), ('Lime à ongles', 1, 1), ('Friteuse', 4, 1), ('Ponceuse', 2, 1);

-- Membre 2
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Rouge à lèvres', 1, 2), ('Scie sauteuse', 2, 2), ('Clé anglaise', 3, 2),
('Blender', 4, 2), ('Pinceau maquillage', 1, 2), ('Perceuse-visseuse', 2, 2),
('Pompe à vélo', 3, 2), ('Four électrique', 4, 2), ('Eyeliner', 1, 2), ('Batteur', 4, 2);

-- Membre 3
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Miroir lumineux', 1, 3), ('Tournevis étoile', 2, 3), ('Boîte à outils', 2, 3),
('Pompe à eau', 3, 3), ('Robot multifonctions', 4, 3), ('Vernis à ongles', 1, 3),
('Cafetière', 4, 3), ('Crics', 3, 3), ('Micro-ondes', 4, 3), ('Lime électrique', 1, 3);

-- Membre 4
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Fer à lisser', 1, 4), ('Perforatrice murale', 2, 4), ('Amortisseur', 3, 4),
('Grille-pain', 4, 4), ('Tournevis plat', 2, 4), ('Mascara', 1, 4),
('Mélangeur', 4, 4), ('Échappement', 3, 4), ('Pistolet thermique', 2, 4), ('Extracteur de jus', 4, 4);

-- 📅 Insertion des emprunts valides
INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2024-06-01', '2024-06-10'),
(5, 3, '2024-06-03', '2024-06-12'),
(8, 4, '2024-06-05', '2024-06-15'),
(12, 1, '2024-06-06', '2024-06-18'),
(17, 3, '2024-06-07', '2024-06-20'),
(22, 2, '2024-06-08', '2024-06-22'),
(25, 1, '2024-06-09', '2024-06-24'),
(30, 4, '2024-06-10', '2024-06-25'),
(35, 2, '2024-06-11', '2024-06-26'),
(40, 1, '2024-06-12', '2024-06-27');

-- 🖼 Insertion des images associées
INSERT INTO images_objet (id_objet, nom_image) VALUES
(1, 'seche.jpg'), (5, 'robot.jpg'), (12, 'scie.jpg'),
(22, 'pompe.jpg'), (35, 'mascara.jpg');