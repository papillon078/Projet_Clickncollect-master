-- ajout des roles
INSERT INTO `ll7882_roles` (`name`)
VALUES
('admin'), ('vendeur'), ('client');

-- ajout des roles
INSERT INTO `ll7882_civilities` (`name`)
VALUES
('Monsieur'), ('Madame');

-- ajout des taxes
INSERT INTO `ll7882_taxes` (`rate`)
VALUES
('1.021'), ('1.055'), ('1.1'), ('1.2');

-- ajout du packaging
INSERT INTO `ll7882_packagings` (`name`)
VALUES
('le lot'), ('g'), ('/Kg'), ('cL'), ('/L'), ('la pièce');

-- ajout du statut
INSERT INTO `ll7882_status` (`name`)
VALUES
('en cours'), ('préparée'), ('emportée'), ('annulée');

-- ajout des créneaux horaires
INSERT INTO `ll7882_timeslot_allocations` (`slot_allocation`)
VALUES
('08:00:00'), ('08:30:00'), ('09:00:00'), ('09:30:00'), 
('10:00:00'), ('10:30:00'), ('11:00:00'), ('11:30:00'), 
('12:00:00'), ('12:30:00'), ('13:00:00'), ('13:30:00'), 
('14:00:00'), ('14:30:00'), ('15:00:00'), ('15:30:00'), 
('16:00:00'), ('16:30:00'), ('17:00:00'), ('17:30:00'), 
('18:00:00'), ('18:30:00'), ('19:00:00'), ('19:30:00');

-- ajout des catégories
INSERT INTO `ll7882_categories` (`name`)
VALUES
('Menu'), ('Fruits et légumes'), ('Viandes et poissons'), 
('Frais'), ('Surgelés'), ('Epicerie sucrée'), ('Epicerie salée'), 
('Boissons'), ('Hygiène et beauté'), ('Bio'), ('Entretien'), 
('Animaux'), ('Maison et décoration'), ('Bricolage');



