SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `article`(
    `id` INT(4) NOT NULL,
    `nom` varchar(255) NOT NULL,
    `description` varchar(255),
    `prix` int(4) NOT NULL,
    `idCategorie` int(4) NOT NULL,
    `imageId` INT(4)
);

ALTER TABLE `article`
ADD CONSTRAINT `PK_idArticle`
PRIMARY KEY(`id`);

CREATE TABLE `categorie`(
    `id` INT(4) NOT NULL,
    `nom` varchar(255) NOT NULL,
    `imageId` INT(4)
);

ALTER TABLE `categorie`
ADD CONSTRAINT `PK_idCategorie`
PRIMARY KEY(`id`);

ALTER TABLE `article`
ADD CONSTRAINT `FK_articleCategorie`
FOREIGN KEY(`idCategorie`) REFERENCES `categorie`(`id`);

CREATE TABLE `image`(
    `id` INT(4) NOT NULL,
    `chemin` varchar(255) NOT NULL
);

ALTER TABLE `image`
ADD CONSTRAINT `PK_idImage`
PRIMARY KEY(`id`);

ALTER TABLE `article`
ADD CONSTRAINT `FK_articlePhoto`
FOREIGN KEY(`imageId`) REFERENCES `image`(`id`);

ALTER TABLE `categorie`
ADD CONSTRAINT `FK_categoriePhoto`
FOREIGN KEY (`imageId`) REFERENCES `image`(`id`); 


ALTER TABLE article
MODIFY COLUMN prix FLOAT; 

-- Placeholder
CREATE TABLE `membre`(
    `id` INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(255),
    `prenom` VARCHAR(255),
    `email` VARCHAR(255),
    `motDePasse` VARCHAR(255)
);

CREATE TABLE `facture`(
    `id` INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `date` DATETIME,
    `idProduit` INT (4) NOT NULL,
    `idMembre` INT (4) NOT NULL,
    `quantite` INT(4),
    `prix` FLOAT(4)
);

ALTER TABLE `facture`
ADD CONSTRAINT `FK_factureMembre`
FOREIGN KEY (`idProduit`) REFERENCES `article`(`id`);

CREATE TABLE `commentaire`(
    `id` INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `date` DATETIME,
    `idProduit` INT(4) NOT NULL,
    `idMembre` INT(4) NOT NULL,
    `contenue` VARCHAR(255)
);

ALTER TABLE `commentaire`
ADD CONSTRAINT `FK_commentaireProduit`
FOREIGN KEY (`idProduit`) REFERENCES `article`(`id`);

ALTER TABLE `commentaire`
ADD CONSTRAINT `FK_commentaireMembre`
FOREIGN KEY (`idMembre`) REFERENCES `users`(`id`);