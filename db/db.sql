--
-- Database  :  `blogWriter`
--
CREATE DATABASE IF NOT EXISTS `blogWriter` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `blogWriter`;

-- --------------------------------------------------------

--
-- Structure de la table `chapters`
--

DROP TABLE IF EXISTS `chapters`;
CREATE TABLE IF NOT EXISTS `chapters` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` tinyint(3) UNSIGNED NOT NULL,
  `author` varchar(30) NOT NULL DEFAULT 'Jean Forteroche',
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `postDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `chapters`
--

INSERT INTO `chapters` (`id`, `number`, `author`, `title`, `content`, `postDate`) VALUES
  (1, 1, 'Jean Forteroche', 'Récit et aventures de mon voyage en Alaska', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis mi a sem tincidunt tempor. Suspendisse quam velit, aliquet gravida sodales ac, fermentum in magna. Integer augue dui, congue id mi at, vestibulum tempus libero. Sed vestibulum pellentesque enim, nec euismod ante auctor ut. Vestibulum dignissim massa purus, sagittis sollicitudin neque feugiat ut. Sed id dolor non sem sagittis ultrices. Quisque quis risus nec metus scelerisque euismod in vel ante. Aliquam varius consectetur nisi ut laoreet. Phasellus sed augue quis mauris posuere maximus nec nec nisi. Phasellus sit amet lectus at leo finibus porttitor ut quis erat. Ut dictum ligula ac libero pretium, ac faucibus justo imperdiet. Suspendisse eu imperdiet urna. Fusce ornare ultricies sem eget hendrerit. Sed semper maximus mi, ut fringilla lorem molestie vel. Sed cursus fermentum libero tincidunt fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\\r\\n\\r\\nNunc at euismod eros, id varius ipsum. Suspendisse tristique varius magna a accumsan. Sed viverra ante vitae leo mollis maximus. Nullam dolor orci, facilisis sed tempus eu, luctus eu neque. Nulla facilisis eget orci eget vestibulum. Etiam enim est, interdum quis dolor non, commodo tempor quam. Nunc mattis nisl eget dolor hendrerit pulvinar quis sed nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\\r\\n\\r\\nInteger ac vulputate libero. Maecenas at hendrerit sapien. In facilisis mattis ante in tempus. Suspendisse vel leo eu mi pretium egestas eget ac mi. Ut cursus felis quis mauris maximus, ullamcorper placerat arcu ultrices. Etiam suscipit lacus ligula, eu ultrices ipsum pulvinar quis. Proin turpis neque, efficitur vel nisi id, volutpat suscipit tellus. In ac eros non odio euismod efficitur.\\r\\n\\r\\nNunc finibus lacinia odio et rhoncus. Pellentesque at augue placerat, faucibus ipsum at, semper diam. Mauris tristique commodo egestas. Curabitur sed feugiat nunc. Cras volutpat nunc eu nibh iaculis viverra in eget lectus. Ut vitae aliquet ipsum, et convallis diam. Nam volutpat sem finibus lacus consequat elementum. Nulla vitae orci in metus tincidunt auctor a vitae diam. Duis nec egestas diam. Fusce volutpat felis nisi, non pharetra neque malesuada ut. Ut id tellus imperdiet, pretium odio ac, sodales leo. Morbi sed lectus commodo, consequat ex vel, aliquam sem.\\r\\n\\r\\nAenean feugiat sem a ipsum ultricies, vitae aliquam ex dignissim. Nullam luctus dignissim urna a fermentum. Praesent finibus mi mauris. Maecenas imperdiet lacinia condimentum. Morbi tincidunt egestas justo, ac faucibus odio laoreet vitae. Fusce elit lacus, ultricies sed elementum et, euismod in sem. Aliquam auctor enim et lectus dapibus, sit amet consequat leo fermentum. Proin ac egestas justo. Vestibulum consectetur faucibus commodo. Vivamus blandit, velit ac dignissim venenatis, tellus odio porta est, at facilisis massa orci sed mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam accumsan mi augue, vel aliquet enim feugiat at. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce vestibulum lorem tincidunt, placerat nulla a, congue nisi. Donec odio sem, pretium non nisl ac, suscipit euismod leo.\\r\\n', '2017-09-11'),
  (2, 2, 'Jean Forteroche', 'L\'aventure commence !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis mi a sem tincidunt tempor. Suspendisse quam velit, aliquet gravida sodales ac, fermentum in magna. Integer augue dui, congue id mi at, vestibulum tempus libero. Sed vestibulum pellentesque enim, nec euismod ante auctor ut. Vestibulum dignissim massa purus, sagittis sollicitudin neque feugiat ut. Sed id dolor non sem sagittis ultrices. Quisque quis risus nec metus scelerisque euismod in vel ante. Aliquam varius consectetur nisi ut laoreet. Phasellus sed augue quis mauris posuere maximus nec nec nisi. Phasellus sit amet lectus at leo finibus porttitor ut quis erat. Ut dictum ligula ac libero pretium, ac faucibus justo imperdiet. Suspendisse eu imperdiet urna. Fusce ornare ultricies sem eget hendrerit. Sed semper maximus mi, ut fringilla lorem molestie vel. Sed cursus fermentum libero tincidunt fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\\r\\n', '2017-09-11');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `postDate` date NOT NULL,
  `chapter` smallint(5) UNSIGNED NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `author`, `content`, `postDate`, `chapter`, `flag`) VALUES
  (1, 'Wiwi', 'Voici un premier commentaire!', '2017-09-13', 2, 0),
  (2, 'Anna', 'J’ai toujours très très peur de ne pas avoir assez d’eau en randonnée ! \\r\\nJe me suis faite avoir aussi au début, à se dire qu’une randonnée toute gentille, une bouteille d’eau suffit… Mais en fait, lorsque l’on fait un effort physique et avec la chaleur, on a vraiment besoin de beaucoup plus d’eau !', '2017-09-13', 2, 0),
  (21, 'Bobby', 'Les formulaires constituent le principal moyen pour vos visiteurs d\'entrer des informations sur votre site. Les formulaires permettent de créer une interactivité.\\r\\n\\r\\nPar exemple, sur un forum on doit insérer du texte puis cliquer sur un bouton pour envoyer son message. Sur un livre d\'or, sur un mini-chat, on procède de la même façon. On a besoin des formulaires partout pour échanger des informations avec nos visiteurs.\\r\\n\\r\\nVous allez voir qu\'il y a de nombreux rappels de HTML dans ce chapitre… et ce n\'est pas un hasard : ici, le PHP et le HTML sont intimement liés. Le HTML permet de créer le formulaire, tandis que le PHP permet de traiter les informations que le visiteur a entrées dans le formulaire.', '2017-09-14', 2, 0);
