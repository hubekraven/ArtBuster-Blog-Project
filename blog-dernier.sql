-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 24 Mai 2016 à 19:53
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `idArticle` smallint(6) NOT NULL AUTO_INCREMENT,
  `titre_anglais` varchar(500) NOT NULL,
  `titre_francais` varchar(500) NOT NULL,
  `texte_anglais` text NOT NULL,
  `texte_francais` text NOT NULL,
  `auteur` varchar(20) NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `auteur` (`auteur`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`idArticle`, `titre_anglais`, `titre_francais`, `texte_anglais`, `texte_francais`, `auteur`) VALUES
(1, 'Van Gogh', 'Van Gogh', ' Vincent Willem van Gogh Dutch: (30 March 1853 â€“ 29 July 1890) was a Dutch post-Impressionist painter whose work had far-reaching influence on 20th-century art. His output includes portraits, self portraits, landscapes, still lifes, olive trees and cypresses, wheat fields and sunflowers. Critics largely ignored his work until after his presumed suicide in 1890. His short life, expressive and spontaneous use of vivid colours, broad oil brushstrokes and emotive subject matter, mean he is recognisable both in the modern public imagination as the quintessential misunderstood genius.\r\n\r\nVan Gogh was born to religious upper middle class parents. He was driven as an adult by a strong sense of purpose, but was also thoughtful and intellectual; he was equally aware of modernist currents in art, music and literature. He was well travelled and spent several years in his 20s working for a firm of art dealers in The Hague, London and Paris, after which he taught in England at Isleworth and Ramsgate. He drew as a child, but spent years drifting in ill health and solitude, and did not paint until his late twenties. Most of his best-known works were completed during the last two years of his life. Deeply religious as a younger man, he worked from 1879 as a missionary in a mining region in Belgium where he sketched people from the local community. His first major work was 1885''s The Potato Eaters, from a time when his palette mainly consisted of sombre earth tones and showed no sign of the vivid colouration that distinguished his later paintings. In March 1886, he moved to Paris and discovered the French &Impressionists&. Later, he moved to the south of France and was inspired by the region''s strong sunlight. His paintings grew brighter in colour, and he developed the unique and highly recognisable style that became fully realised during his stay in Arles in 1888. In just over a decade, he produced more than 2,100 artworks, including around 860 oil paintings. After years of anxiety and frequent bouts of mental illness he died aged 37 from a self-inflicted gunshot wound. The extent to which his mental health affected his painting has been widely debated.', ' \r\n"Vincent Willem van GoghNote 2, nÃ© le 30 mars 1853 Ã  Groot-Zundert (Pays-Bas) et mort le 29 juillet 1890 Ã  Auvers-sur-Oise (France), est un peintre et dessinateur nÃ©erlandais. Son Å“uvre pleine de naturalisme, inspirÃ©e par l''impressionnisme et le pointillisme, annonce le fauvisme et l''expressionnisme.\r\n\r\nVan Gogh grandit au sein d''une famille de l''ancienne bourgeoisie. Il tente d''abord de faire carriÃ¨re comme marchand d''art chez Goupil & Cie. Cependant, refusant de voir l''art comme une marchandise, il est licenciÃ©. Il aspire alors Ã  devenir pasteur, mais il Ã©choue aux examens de thÃ©ologie. Ã€ l''approche de 1880, il se tourne vers la peinture. Pendant ces annÃ©es, il quitte les Pays-Bas pour la Belgique, puis s''Ã©tablit en France. Autodidacte, Van Gogh prend nÃ©anmoins des cours de peinture. PassionnÃ©, il ne cesse d''enrichir sa culture picturale : il analyse le travail des peintres de l''Ã©poque, il visite les musÃ©es et les galeries d''art, il Ã©change des idÃ©es avec ses amis peintres, il Ã©tudie les estampes japonaises, les gravures anglaises, etc. Sa peinture reflÃ¨te ses recherches et l''Ã©tendue de ses connaissances artistiques. Toutefois, sa vie est parsemÃ©e de crises qui rÃ©vÃ¨lent son instabilitÃ© mentale. L''une d''elles provoque son suicide, Ã  l''Ã¢ge de 37 ans.\r\n', 'tremmar');

-- --------------------------------------------------------

--
-- Structure de la table `article_motscles`
--

CREATE TABLE IF NOT EXISTS `article_motscles` (
  `articleId` smallint(6) NOT NULL,
  `motsclesId` smallint(6) NOT NULL,
  KEY `articleId` (`articleId`),
  KEY `motsclesId` (`motsclesId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article_motscles`
--

INSERT INTO `article_motscles` (`articleId`, `motsclesId`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `motscles`
--

CREATE TABLE IF NOT EXISTS `motscles` (
  `idMotscles` smallint(6) NOT NULL AUTO_INCREMENT,
  `mots_cles` varchar(100) NOT NULL,
  PRIMARY KEY (`idMotscles`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `motscles`
--

INSERT INTO `motscles` (`idMotscles`, `mots_cles`) VALUES
(1, 'dessinateur nÃ©erlandais'),
(2, 'Å“uvre'),
(3, 'l''impressionnisme'),
(4, 'peinture');

-- --------------------------------------------------------

--
-- Structure de la table `usager`
--

CREATE TABLE IF NOT EXISTS `usager` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `usager`
--

INSERT INTO `usager` (`username`, `nom`, `prenom`, `password`) VALUES
('blacla', 'Blancher', 'Claire', '03a513007af6b49a318b86936a24b22b'),
('cardav', 'Carriveau', 'David', 'cc5ef07a4954f6a184c20d8eba7be3e2'),
('didmat', 'Didion', 'Mathieu', 'mamp_15'),
('despau', 'Desjardins', 'Paul', 'apple25'),
('tremmar', 'Tremblay', 'Martin', '864ae38ec5d55caea71a91c09fb54baa');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
