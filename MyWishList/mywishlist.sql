SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liste_id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `descr` text,
  `img` text,
  `url` text,
  `tarif` decimal(5,2) DEFAULT NULL,
  cagnotte int(1) NOT NULL DEFAULT 0,
  id_utilisateur VARCHAR(30) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  message text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `item` (`id`, `liste_id`, `nom`, `descr`, `img`, `url`, `tarif`, `token`) VALUES
(1,	2,	'Champagne',	'Bouteille de champagne + flutes + jeux à gratter',	'champagne.jpg',	'',	20.00, 't1'),
(2,	2,	'Musique',	'Partitions de piano à 4 mains',	'musique.jpg',	'',	25.00, 't2'),
(3,	2,	'Exposition',	'Visite guidée de l’exposition ‘REGARDER’ à la galerie Poirel',	'poirelregarder.jpg',	'',	14.00, 't3'),
(4,	3,	'Goûter',	'Goûter au FIFNL',	'gouter.jpg',	'',	20.00, 't4'),
(5,	3,	'Projection',	'Projection courts-métrages au FIFNL',	'film.jpg',	'',	10.00, 't5'),
(6,	2,	'Bouquet',	'Bouquet de roses et Mots de Marion Renaud',	'rose.jpg',	'',	16.00, 't6'),
(7,	2,	'Diner Stanislas',	'Diner à La Table du Bon Roi Stanislas (Apéritif /Entrée / Plat / Vin / Dessert / Café / Digestif)',	'bonroi.jpg',	'',	60.00, 't7'),
(8,	3,	'Origami',	'Baguettes magiques en Origami en buvant un thé',	'origami.jpg',	'',	12.00, 't8'),
(9,	3,	'Livres',	'Livre bricolage avec petits-enfants + Roman',	'bricolage.jpg',	'',	24.00, 't9'),
(10,	2,	'Diner  Grand Rue ',	'Diner au Grand’Ru(e) (Apéritif / Entrée / Plat / Vin / Dessert / Café)',	'grandrue.jpg',	'',	59.00, 't10'),
(11,	0,	'Visite guidée',	'Visite guidée personnalisée de Saint-Epvre jusqu’à Stanislas',	'place.jpg',	'',	11.00,'t11'),
(12,	2,	'Bijoux',	'Bijoux de manteau + Sous-verre pochette de disque + Lait après-soleil',	'bijoux.jpg',	'',	29.00,'t12'),
(19,	0,	'Jeu contacts',	'Jeu pour échange de contacts',	'contact.png',	'',	5.00,'t13'),
(22,	0,	'Concert',	'Un concert à Nancy',	'concert.jpg',	'',	17.00, 't14'),
(23,	1,	'Appart Hotel',	'Appart’hôtel Coeur de Ville, en plein centre-ville',	'apparthotel.jpg',	'',	56.00, 't15'),
(24,	2,	'Hôtel d\'Haussonville',	'Hôtel d\'Haussonville, au coeur de la Vieille ville à deux pas de la place Stanislas',	'hotel_haussonville_logo.jpg',	'',	169.00, 't16'),
(25,	1,	'Boite de nuit',	'Discothèque, Boîte tendance avec des soirées à thème & DJ invités',	'boitedenuit.jpg',	'',	32.00,'t17'),
(26,	1,	'Planètes Laser',	'Laser game : Gilet électronique et pistolet laser comme matériel, vous voilà équipé.',	'laser.jpg',	'',	15.00,'t18'),
(27,	1,	'Fort Aventure',	'Découvrez Fort Aventure à Bainville-sur-Madon, un site Accropierre unique en Lorraine ! Des Parcours Acrobatiques pour petits et grands, Jeu Mission Aventure, Crypte de Crapahute, Tyrolienne, Saut à l\'élastique inversé, Toboggan géant... et bien plus encore.',	'fort.jpg',	'',	25.00,'t19');

DROP TABLE IF EXISTS `liste`;
CREATE TABLE `liste` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `expiration` date DEFAULT NULL,
    `public` varchar(6) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `liste` (`no`, `user_id`, `titre`, `description`, `expiration`, `token` , `public`) VALUES
(1,	1,	'Pour fêter le bac !',	'Pour un week-end à Nancy qui nous fera oublier les épreuves. ',	'2018-06-27',	'nosecure1', 'true'),
(2,	2,	'Liste de mariage d\'Alice et Bob',	'Nous souhaitons passer un week-end royal à Nancy pour notre lune de miel :)',	'2018-06-30',	'nosecure2', 'true'),
(3,	3,	'C\'est l\'anniversaire de Charlie',	'Pour lui préparer une fête dont il se souviendra :)',	'2017-12-12',	'nosecure3', 'true');


SET NAMES utf8;
DROP table if EXISTS utilisateur;
Drop table if EXISTS utilisateur;
Create Table utilisateur(
                       id_Utilisateur int(11) NOT NULL AUTO_INCREMENT,
                       nom varchar(30)NOT NULL ,
                       prenom varchar(30) NOT NULL,
                       login varchar(30) NOT NULL,
                       password varchar(70) NOT NULL,
                       admin int(1) NOT NULL DEFAULT '0',
                        `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                       PRIMARY KEY (id_Utilisateur),
                       UNIQUE KEY login(login)
)DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;

INSERT INTO utilisateur (id_Utilisateur, nom, prenom , login,password,admin, token) VALUES
(1, 'root', 'admin', 'admin', 'mdp1', 1, '1864165148461'),
(2, 'Spick', 'Florian', 'spk', 'mdp2', 0,'18641aiogy8461'),
(3, 'Percin', 'Cahit', 'Cahit', 'mdp3', 0,'18641aiog47484'),
(4, 'Krell', 'Lucas', 'krell', 'mdp4', 0,'18a4554ogy8461');


DROP TABLE IF EXISTS message;
CREATE TABLE message (
                                id_message int(5) NOT NULL AUTO_INCREMENT,
                                id_parent int(5) NOT NULL,
                                parent_type varchar(6) NOT NULL,
                                message text NOT NULL,
                                id_utilisateur int(11) NOT NULL,
                                PRIMARY KEY (`id_message`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT = 0;