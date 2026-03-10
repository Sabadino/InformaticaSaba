-- Active: 1773128595649@@127.0.0.1@3306@ilmondodellauto
CREATE DATABASE Ilmondodellauto;

USE Ilmondodellauto;

CREATE TABLE Macchine (
    ID_Macchine VARCHAR(255) PRIMARY KEY AUTO_INCREMENT,
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

CREATE TABLE Utenti (
   Id_User VARCHAR(255) PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Cognome VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Username VARCHAR(255) NOT NULL UNIQUE,
    Phone_Number VARCHAR(20) NOT NULL,
    Passwords VARCHAR(255) NOT NULL
);

CREATE TABLE Recensioni(
    Id_Recensioni VARCHAR(255) PRIMARY KEY AUTO_INCREMENT,
    Data_Recensione DATE NOT NULL,
    Valutazione INT NOT NULL,
    Username VARCHAR(255) NOT NULL,
    Foreign Key (Username) REFERENCES Utenti(Username)
);

CREATE TABLE Prenotazioni(
    Id_Prenotazione VARCHAR(255) PRIMARY KEY AUTO_INCREMENT,
    Tipo_Prenotazione VARCHAR(255) NOT NULL,
    Id_User VARCHAR(255) NOT NULL,
    Id_Macchine VARCHAR(255) NOT NULL,
    Foreign Key (Id_User) REFERENCES Utenti(Id_User),
    Foreign Key (Id_Macchine) REFERENCES Macchine(ID_Macchine)
);

CREATE TABLE SalvaDati(
    Id_User VARCHAR(255) PRIMARY KEY AUTO_INCREMENT,
    AutoSalvate VARCHAR(255) NOT NULL,
    Foreign Key (Id_User) REFERENCES Utenti(Id_User)
);