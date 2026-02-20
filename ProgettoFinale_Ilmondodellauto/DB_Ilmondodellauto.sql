-- Active: 1769765509518@@127.0.0.1@3306
CREATE DATABASE Ilmondodellauto;

USE Ilmondodellauto;

CREATE TABLE Auto (
    ID_Auto VARCHAR(255) PRIMARY KEY AUTO_INCREMENT,
    Marca VARCHAR(255) NOT NULL,
    Modello VARCHAR(255) NOT NULL,
    Anno_Produzione INT NOT NULL,
    Cilindrata INT NOT NULL,
    PotenzaKw INT NOT NULL,
    Cavalli INT NOT NULL,
    Tipo_Cambio VARCHAR(255) NOT NULL,
    Segmento VARCHAR(255) NOT NULL,
    Tipo_Alimentazione VARCHAR(255) NOT NULL,
    Chilometraggio INT NOT NULL,
    Classe_Omologazione VARCHAR(255) NOT NULL,
    Colore VARCHAR(255) NOT NULL,
    Prezzo DECIMAL(10, 2) NOT NULL,
);

CREATE TABLE User (
   Id_User VARCHAR(255) PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Cognome VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Username VARCHAR(255) NOT NULL,
    Phone_Number VARCHAR(20) NOT NULL,
    Passwords VARCHAR(255) NOT NULL
);

CREATE TABLE Recensioni(


);