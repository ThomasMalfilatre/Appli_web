
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Structure de la table `ACTIVITE`
--

CREATE TABLE IF NOT EXISTS `ACTIVITE` (
  `id` int(4) NOT NULL,
  `nom` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ACTIVITE`
--

INSERT INTO `ACTIVITE` (`id`, `nom`) VALUES
(1, 'Java'),
(2, 'Python'),
(3, 'Anglais'),
(4, 'Repos'),
(5, 'Café'),
(6, 'PHP');

-- --------------------------------------------------------

--
-- Structure de la table `PARTICIPE`
--

CREATE TABLE IF NOT EXISTS `PARTICIPE` (
  `users` varchar(20) NOT NULL,
  `activite` int(4) NOT NULL,
  `creneau` datetime NOT NULL,
  PRIMARY KEY (`users`,`activite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `USERS`
--

CREATE TABLE IF NOT EXISTS `USERS` (
  `login` varchar(20) NOT NULL,
  `passwd` varchar(40) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
