-- Création de la base de donnée
CREATE DATABASE IF NOT EXISTS Cost_Chef CHARSET utf8mb4;
USE Cost_Chef;

-- Structure de la base de donnée
CREATE TABLE IF NOT EXISTS restaurant(
    id_restaurant INT PRIMARY KEY AUTO_INCREMENT,
    nom_restaurant VARCHAR(255) NOT NULL,
    logo_restaurant VARCHAR(255) NOT NULL,
    email_restaurant VARCHAR(100) NOT NULL UNIQUE,
    telephone_restaurant VARCHAR(30) NOT NULL UNIQUE,
    code_restaurant INT(4) NOT NULL,
    mdp_restaurant VARCHAR(100) NOT NULL,
    id_adresse INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS adresse(
	id_adresse INT PRIMARY KEY AUTO_INCREMENT,
    rue_adresse VARCHAR(100) NOT NULL,
    numero_adresse INT NOT NULL,
    code_postal_adresse INT NOT NULL,
    id_ville INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS ville(
	id_ville INT PRIMARY KEY AUTO_INCREMENT,
    nom_ville VARCHAR(60) NOT NULL,
    id_pays INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS pays(
	id_pays INT PRIMARY KEY AUTO_INCREMENT,
    nom_pays VARCHAR(60) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS produit(
	id_produit INT PRIMARY KEY AUTO_INCREMENT,
    nom_produit VARCHAR(50) NOT NULL,
    prix_produit DECIMAL(10,2) NOT NULL,
    stock_produit DECIMAL(10,2) NOT NULL DEFAULT 0,
    id_restaurant INT NOT NULL,
    id_unite_produit INT NOT NULL,
    id_type_produit INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS recette(
	id_recette INT PRIMARY KEY AUTO_INCREMENT,
    nom_produit VARCHAR(50) NOT NULL,
    image_recette VARCHAR(255) NOT NULL,
    description_recette TEXT NOT NULL,
    id_restaurant INT NOT NULL,
    id_unite_recette INT NOT NULL,
    id_type_recette INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS type_produit(
	id_type_produit INT PRIMARY KEY AUTO_INCREMENT,
    nom_type_produit VARCHAR(50) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS type_recette(
	id_type_recette INT PRIMARY KEY AUTO_INCREMENT,
    nom_type_recette VARCHAR(50) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS unite_produit(
	id_unite_produit INT PRIMARY KEY AUTO_INCREMENT,
    nom_unite_produit VARCHAR(50) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS unite_recette(
	id_unite_recette INT PRIMARY KEY AUTO_INCREMENT,
    nom_unite_recette VARCHAR(50) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS etape(
	id_etape INT PRIMARY KEY AUTO_INCREMENT,
    texte_etape TEXT NOT NULL,
    id_recette INT NOT NULL
)ENGINE=innodb;

-- Tables d'association
CREATE TABLE IF NOT EXISTS produit_recette(
	id_produit INT NOT NULL,
    id_recette INT NOT NULL,
    PRIMARY KEY(id_produit , id_recette),
    CONSTRAINT fk_produit_recette_produit FOREIGN KEY(id_produit) REFERENCES produit(id_produit) ON DELETE CASCADE,
    CONSTRAINT fk_produit_recette_recette FOREIGN KEY(id_recette) REFERENCES recette(id_recette) ON DELETE CASCADE
)ENGINE=innodb;

-- Contraintes de clés étrangères
ALTER TABLE restaurant ADD CONSTRAINT fk_restaurant_adresse FOREIGN KEY(id_adresse) REFERENCES adresse(id_adresse);

ALTER TABLE adresse ADD CONSTRAINT fk_adresse_ville FOREIGN KEY(id_ville) REFERENCES ville(id_ville);

ALTER TABLE ville ADD CONSTRAINT fk_ville_pays FOREIGN KEY(id_pays) REFERENCES pays(id_pays);

ALTER TABLE etape ADD CONSTRAINT fk_etape_recette FOREIGN KEY(id_recette) REFERENCES recette(id_recette) ON DELETE CASCADE;

ALTER TABLE recette
	ADD CONSTRAINT fk_recette_restaurant FOREIGN KEY(id_restaurant) REFERENCES restaurant(id_restaurant) ON DELETE CASCADE,
    ADD CONSTRAINT fk_recette_type FOREIGN KEY(id_type_recette) REFERENCES type_recette(id_type_recette),
    ADD CONSTRAINT fk_recette_unite FOREIGN KEY(id_unite_recette) REFERENCES unite_recette(id_unite_recette);
    
ALTER TABLE produit
	ADD CONSTRAINT fk_produit_restaurant FOREIGN KEY(id_restaurant) REFERENCES restaurant(id_restaurant) ON DELETE CASCADE,
    ADD CONSTRAINT fk_produit_type FOREIGN KEY(id_type_produit) REFERENCES type_produit(id_type_produit),
    ADD CONSTRAINT fk_produit_unite FOREIGN KEY(id_unite_produit) REFERENCES unite_produit(id_unite_produit);