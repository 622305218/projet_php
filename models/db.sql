CREATE DATABASE biblio;
USE biblio;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(50),
    actif BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `livre` (
  `id` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `nbPages` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `livre` (`id`, `titre`, `nbPages`, `image`) VALUES
(1, 'L\'algorithmique selon H2PROG', 300, 'algo.png'),
(2, 'Le virus Asiatique 2', 20, 'virus.png'),
(3, 'La France du 19ème', 22, 'france.png'),
(4, 'Le JavaScript Client', 500, 'JS.png');

ALTER TABLE `livre`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `livre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;