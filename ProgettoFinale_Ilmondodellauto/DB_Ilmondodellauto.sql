CREATE DATABASE concessionario;

USE concessionario;

CREATE TABLE utente (
    ID INT NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Cognome VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Username VARCHAR(255) NOT NULL UNIQUE,
    Telefono VARCHAR(20),
    Password VARCHAR(255) NOT NULL,
    Ruolo ENUM('utente', 'admin') DEFAULT 'utente',
    PRIMARY KEY (ID)
);

CREATE TABLE macchina (
    ID INT NOT NULL AUTO_INCREMENT,
    Marca VARCHAR(255) NOT NULL,
    Modello VARCHAR(255) NOT NULL,
    Anno INT NOT NULL,
    Stato ENUM('Disponibile', 'Prenotata', 'Venduta') DEFAULT 'Disponibile',
    Cilindrata INT NOT NULL,
    PotenzaKw INT NOT NULL,
    Cavalli INT NOT NULL,
    Chilometraggio INT NOT NULL,
    Carrozzeria ENUM('Berlina', 'Due Volumi', 'Station Wagon', 'SUV', 'City Car', 'Monovolume', 'Cabrio', 'Furgonato', 'Bus', 'Pick Up', 'Utilitaria'),
    ColoreInterni VARCHAR(50),
    TipoVeicolo ENUM('Usato', 'Nuovo', 'Km Zero'),
    Neopatentati BOOLEAN DEFAULT FALSE,
    Targa VARCHAR(10) NOT NULL UNIQUE,
    Descrizione TEXT,
    Prezzo INT NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE macchina_immagini (
    ID INT NOT NULL AUTO_INCREMENT,
    ID_Macchina INT NOT NULL,
    URL VARCHAR(255) NOT NULL,
    Ordine INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_Macchina) REFERENCES macchina(ID) ON DELETE CASCADE
);

CREATE TABLE accessori (
    ID INT NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Categoria ENUM('Sicurezza', 'Comfort', 'Estetica', 'Tecnologia', 'Altro'),
    PRIMARY KEY (ID)
);

CREATE TABLE macchina_accessori (
    ID_Macchina INT NOT NULL,
    ID_Accessorio INT NOT NULL,
    PRIMARY KEY (ID_Macchina, ID_Accessorio),
    FOREIGN KEY (ID_Macchina) REFERENCES macchina(ID) ON DELETE CASCADE,
    FOREIGN KEY (ID_Accessorio) REFERENCES accessori(ID) ON DELETE CASCADE
);

CREATE TABLE prenotazione (
    ID INT NOT NULL AUTO_INCREMENT,
    ID_Utente INT NOT NULL,
    ID_Macchina INT NOT NULL,
    TipoPrenotazione ENUM('Test Drive', 'Acquisto', 'Visita'),
    DataOraPrenotazione DATETIME NOT NULL,
    Stato ENUM('In attesa', 'Confermata', 'Annullata', 'Completata') DEFAULT 'In attesa',
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_Utente) REFERENCES utente(ID),
    FOREIGN KEY (ID_Macchina) REFERENCES macchina(ID) ON DELETE CASCADE
);



INSERT INTO macchina (Marca, Modello, Anno, Stato, Cilindrata, PotenzaKw, Cavalli, Chilometraggio, Carrozzeria, ColoreInterni, TipoVeicolo, Neopatentati, Targa, Descrizione, Prezzo) VALUES
('BMW', 'Serie 3', 2019, 'Disponibile', 1998, 140, 190, 85000, 'Berlina', 'Nero', 'Usato', 0, 'FL519KX', 'BMW Serie 3 in ottime condizioni.', 22500),
('Audi', 'A4', 2020, 'Disponibile', 1984, 110, 150, 62000, 'Berlina', 'Beige', 'Usato', 0, 'GH320AB', 'Audi A4 con optional completi.', 27000),
('Volkswagen', 'Golf', 2018, 'Disponibile', 1598, 85, 115, 110000, 'Due Volumi', 'Grigio', 'Usato', 1, 'EK218CD', 'Golf 1.6 TDI adatta neopatentati.', 14900);

INSERT INTO macchina_immagini (ID_Macchina, URL, Ordine) VALUES
(1, 'uploads/bmw.jpg', 0),
(2, 'uploads/audi.jpg', 0),
(3, 'uploads/golf.jpg', 0);