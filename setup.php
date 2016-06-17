<?php
		$sql = "
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `pseudo`, `mdp`) VALUES
(1, 'test', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

CREATE TABLE `mvt` (
  `id` int(20) NOT NULL,
  `Groupe` varchar(20) NOT NULL,
  `Produit` varchar(20) NOT NULL,
  `Plus1` int(20) DEFAULT '0',
  `Plus2` int(20) DEFAULT '0',
  `Plus3` int(20) DEFAULT '0',
  `Moins1` int(20) DEFAULT '0',
  `Moins2` int(20) DEFAULT '0',
  `Moins3` int(20) DEFAULT '0',
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `mvt`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `mvt`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
";
	$serveur ='localhost';
	$login ='root';
	$mdp ='root';
	$bdd = new PDO('mysql:host='.$serveur.';', $login, $mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$bdd->exec('DROP DATABASE `fooseng`;');
$bdd->exec('CREATE DATABASE IF NOT EXISTS `fooseng`;');
$bdd->exec("USE `fooseng`");
if ($bdd->exec($sql))
	echo 'dasheet';
else
	echo 'built';
?>