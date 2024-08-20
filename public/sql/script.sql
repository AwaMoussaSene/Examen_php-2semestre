-- Création de la base de données
CREATE DATABASE gestion_boutique;

-- Création des tables avec incrémentation des clés primaires
CREATE TABLE categorie (
    idcat INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL
);

CREATE TABLE boutiquier (
    idb INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NOT NULL
);

CREATE TABLE etat (
    idetat INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL
);

CREATE TABLE client (
    idclient INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    photo BLOB,
    telephone VARCHAR(20) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    montantseuil DECIMAL(10, 2) NOT NULL,
    idb INT,
    idcat INT,
    FOREIGN KEY (idb) REFERENCES boutiquier(idb),
    FOREIGN KEY (idcat) REFERENCES categorie(idcat)
);

CREATE TABLE depot (
    iddepot INT AUTO_INCREMENT PRIMARY KEY,
    datedepot DATE NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    idclient INT,
    FOREIGN KEY (idclient) REFERENCES client(idclient)
);

CREATE TABLE dette (
    iddet INT AUTO_INCREMENT PRIMARY KEY,
    dated DATE NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    numero VARCHAR(50) NOT NULL,
    idclient INT,
    idetat INT,
    idb INT,
    FOREIGN KEY (idclient) REFERENCES client(idclient),
    FOREIGN KEY (idetat) REFERENCES etat(idetat),
    FOREIGN KEY (idb) REFERENCES boutiquier(idb)
);

CREATE TABLE paiement (
    idp INT AUTO_INCREMENT PRIMARY KEY,
    datep DATE NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    reference VARCHAR(50) NOT NULL,
    iddet INT,
    FOREIGN KEY (iddet) REFERENCES dette(iddet)
);

CREATE TABLE article (
    ida INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL,
    prixunitaire DECIMAL(10, 2) NOT NULL,
    qtestock INT NOT NULL,
    reference VARCHAR(50) NOT NULL
);

CREATE TABLE dettearticle (
    iddet INT,
    ida INT,
    quantite INT NOT NULL,
    PRIMARY KEY (iddet, ida),
    FOREIGN KEY (iddet) REFERENCES dette(iddet),
    FOREIGN KEY (ida) REFERENCES article(ida)
);



-- Insertion des données dans la table categorie
INSERT INTO categorie (libelle) VALUES 
('nouveau'), 
('non solvant'), 
('solvant');

-- Insertion des données dans la table boutiquier
INSERT INTO boutiquier (nom, prenom, telephone) VALUES 
('Diop', 'Awa', '772345678'), 
('Ndiaye', 'Moussa', '773456789');

-- Insertion des données dans la table etat
INSERT INTO etat (libelle) VALUES 
('soldé'), 
('non soldé');

-- Insertion des données dans la table client
INSERT INTO client (nom, prenom, photo, telephone, adresse, email,montantseuil, idb, idcat) VALUES 
('Ba', 'Fatou', NULL, '774567890', 'Dakar', 'fatou.@gmail.com',60000, 1, 1), 
('Sow', 'Ibrahima', NULL, '775678901', 'Thiès', 'ibrahima.@gmail.com',70000 ,2, 2),
('Ba', 'Badara', NULL, '775678602', 'Medina', 'bbbadara.@gmail.com',NULL ,2, 2);

-- Insertion des données dans la table depot
INSERT INTO depot (datedepot, montant, idclient) VALUES 
('2024-01-15', 50000.00, 1), 
('2024-02-20', 75000.00, 2);

-- Insertion des données dans la table dette
INSERT INTO dette (dated, montant, numero, idclient, idetat, idb) VALUES 
('2024-03-10', 62000.00, 'DET123456789', 1, 1, 1), 
('2024-04-05', 5000.00, 'DET456123456', 2, 1, 2),
('2024-04-05', 40000.00, 'DET4560987623', 3, 2, 2);


-- Insertion des données dans la table paiement
INSERT INTO paiement (datep, montant, reference, iddet) VALUES 
('2024-03-20', 50000.00, 'PAY1232981564', 1), 
('2024-04-15', 100000.00, 'PAY456109234', 2);

-- Insertion des données dans la table article
INSERT INTO article (libelle, prixunitaire, qtestock, reference) VALUES 
('Riz', 20000.00, 200, 'ART4562903460'),
('Huile', 1000.00, 310, 'ART7890945271');

-- Insertion des données dans la table dettearticle
INSERT INTO dettearticle (iddet, ida, quantite) VALUES 
(1, 1, 3), 
(1, 2, 2), 
(2, 2, 5),
(3, 1, 2);

