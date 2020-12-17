DROP DATABASE IF EXISTS parduotuve_karolis;

CREATE DATABASE parduotuve_karolis;

USE parduotuve_karolis;

CREATE TABLE vartotojai (
    id VARCHAR(255) NOT NULL UNIQUE,
    vardas VARCHAR(255) NOT NULL,
    pavarde VARCHAR(255) NOT NULL,
    slaptazodis VARCHAR(255) NOT NULL
);

INSERT INTO vartotojai VALUES('Joshua', 'Jonas', 'Kazlauskas', 'pirkėjas'),
                            ('Valery', 'Valerija', 'Stulgytė', 'vertintojas');

CREATE TABLE vertinimas (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    vartotojo_id VARCHAR(255) UNIQUE,
    vidurkis FLOAT NOT NULL
);

CREATE TABLE cart_userid (
    vartotojo_id VARCHAR(255) NOT NULL,
    prekes_id INT UNSIGNED NOT NULL
);

CREATE TABLE prekes (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    pavadinimas VARCHAR(255) NOT NULL,
    kaina FLOAT NOT NULL,
    prekes_rusis VARCHAR(255) NOT NULL,
    maisto_prekes_rusis VARCHAR(20) DEFAULT NULL
);

INSERT INTO prekes(pavadinimas, kaina, prekes_rusis)
VALUES
-- LAISVALAIKIO PREKĖS
('Paspirtukas', 395.99, 'Laisvalaikio prekė'),
('Krepšinio kamuolys', 8.99, 'Laisvalaikio prekė'),

-- STATYBINĖS PREKĖS
('Cementas', 4.15, 'Statybinė prekė'),
('Putų polisterolas', 21.99, 'Statybinė prekė');


INSERT INTO prekes(pavadinimas, kaina, prekes_rusis, maisto_prekes_rusis)
VALUES
-- MAISTO PREKĖS
('Koldūnai', 1.95, 'Maisto prekė', 'Šaldyta'),
('Bananai', 0.99, 'Maisto prekė', 'Šviežia'),
('Žuvies piršteliai', 1.59, 'Maisto prekė', 'Šaldyta'),
('Juoda duona', 0.79, 'Maisto prekė', 'Šviežia');

ALTER TABLE vertinimas
ADD FOREIGN KEY (vartotojo_id) REFERENCES vartotojai(id);

ALTER TABLE cart_userid
ADD FOREIGN KEY (vartotojo_id) REFERENCES vartotojai(id);

ALTER TABLE cart_userid
ADD FOREIGN KEY (prekes_id) REFERENCES prekes(id);
