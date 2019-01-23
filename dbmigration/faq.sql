-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  db2463.1and1.fr
-- Généré le :  Mer 23 Janvier 2019 à 12:10
-- Version du serveur :  5.5.60-0+deb7u1-log
-- Version de PHP :  7.0.33-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db326893785`
--

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 NOT NULL,
  `question` text CHARACTER SET utf8 NOT NULL,
  `response` text CHARACTER SET utf8,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved` int(1) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `faq`
--

INSERT INTO `faq` (`faq_id`, `name`, `email`, `question`, `response`, `date`, `approved`) VALUES
(1, 'Joel BOUREZ', 'notsupplied@notsupplied.com', 'Est-ce qu&#039;il y a des cars qui desservent La Soucoupe de Saint Nazaire en partant de St Nazaire/La Gare SNCF ?', 'Effectivement, il y a de nombreux bus qui déservent la gare et La Soucoupe ou est organisée la bourse.\r\nPrenez qu’un aller simple car il se peut que vous repartiez avec le vélo de vos rêves…!', '2010-07-26 11:42:59', 1),
(2, 'M.PLUMERAT', 'notsupplied@notsupplied.com', 'Est-ce qu\'il faut remplir un formulaire pour s’inscrire à l\'avance ou peux t\'on simplement se présenter avec notre vélo sans inscription préalable ?', 'Les deux solutions sont possibles. Dans l\'onglet \"Téléchargements\" vous trouverez un exemplaire du formulaire que vous pouvez remplir à l\'avance pour vous faire gagner du temps sur place.\r\nSinon, tous les formulaires sont mis à votre disposition sur place.\r\n**N\'oubliez pas votre pièce d\'identité.**', '2010-07-26 11:47:47', 1),
(3, 'M.NABIIS', 'notsupplied@notsupplied.com', 'Est-ce que les vélos de course seront acceptés ?', 'Tous les vélos sont acceptés dont les vélos de course à condition qu\'ils soient en état de rouler.', '2010-07-26 11:50:21', 1),
(4, 'Mme CHOTARD', 'notsupplied@notsupplied.com', 'Je recherche un vélo pour mon fils de 7 ans 1/2 qui mesure 1m29, entrejambe 58 cm, dois je prendre un 20 ou un 24 pouces sachant qu’il grandisse vite à cet age là.\nC\'est un cadeau donc je ne peux l’enmener avec moi.\nJe voudrais trouver un vélo en très bonne état,peut on trouver ça dans votre manifestation pour un prix résonnable ?', 'Nous ne pouvons à cette heure connaître le choix que nous aurons cette année mais les autres années, il y avait ce que vous cherchez.\nLe mieux, c’est de nous rendre visite dès le samedi matin fin de matinée au moment où il y a plus de choix. Nos vendeurs bénévoles vous conseilleront.', '2010-07-26 11:54:07', 1),
(33, 'DUPAIN RAYMOND', 'r.dupain@voila.fr', 'Je suis absent le samedi; est il possible de déposer le vélo que je veux vendre la veille au soir au gymnase? ou bien alors le dimanche matin?\nEn vous remerciant pour votre réponse.', 'NOUVEAU depuis 2013 : Pour éviter l’affluence du samedi matin nous commençons les dépôts (Uniquement les dépôts) dès le vendredi de 18h à 21h00 même lieu La Soucoupe gardée la nuit.', '2010-10-15 12:16:22', 1),
(36, 'drouard', 'cricri.doudou@free.fr', 'Faut\'il récupérer impérativement le vélo le dimanche soir ou possibilité\nle lundi matin ?', 'Malheureusement, nous devons libérer la salle le dimanche soir donc nous n\'avons pas la possibilité de stocker les vélos non-vendus.\nIl est donc impératif de récupérer le vélo le dimanche soir au plus tard.', '2010-10-25 12:39:46', 1),
(37, 'rivallin guy', 'guy.rivallin@orange.fr', 'Si je depose le velo samedi matin\ndois je le recuperer le soir pour le redeposer le dimanche', 'Non, il n\'est pas nécessaire de récupérer votre vélo et redéposer.\nNous assurons la sécurité des vélos déposés pendant les deux journées de la bourse aux vélos y compris la nuit.', '2010-11-04 12:30:51', 1),
(106, 'Phil', 'phil.frary@nthdimension.fr', 'Y a-t-il une garantie sur les vélos ?', 'Il y a une garantie seulement si le vélo que vous achèterez est encore sous garantie (cela arrive assez souvent). C’est le cas de vélos achetés récemment ne correspondant pas au besoin du propriétaire qui décide très vite de profiter de la bourse et ses 5000 à 6000 visiteurs pour le revendre.', '2012-05-05 06:55:15', 1),
(107, 'Phil', 'phil.frary@nthdimension.fr', 'Est-il possible d’échanger si on se trompe ?', 'Nous n\'avons jamais eu le cas mais si l\' acheteur constate très vite (pendant le week-end) un problème de fonctionnement nous reprenons le vélo et nous le sortons de la vente.', '2012-05-05 06:55:33', 1),
(108, 'Phil', 'phil.frary@nthdimension.fr', 'Quels sont les moyens de paiement ?', 'Par chèque  (carte d\'identité demandée) ou en numéraires. Nous ne pouvons utiliser de TPE car les chèques de l\'acheteur sont émis à l\'ordre du vendeur.', '2012-05-05 06:55:51', 1),
(109, 'Phil', 'phil.frary@nthdimension.fr', 'Peut-on payer en plusieurs fois ?', 'Si nous avons cette demande , nous contactons par téléphone le vendeur qui lui seul décide mais nous avons toujours eu des réponses favorables à cette requête pour des vélos de plus de 1000 €', '2012-05-05 06:56:14', 1),
(110, 'Phil', 'phil.frary@nthdimension.fr', 'Est-il possible d’essayer les vélos sur place ?', 'Les essais se font uniquement dans La Soucoupe pour des raison de sécurité (vol). Une partie de cette très grande salle est réservée aux essais. Les vendeurs de l\'association AVS sont là pour vous conseiller.', '2012-05-05 06:56:28', 1),
(111, 'Phil', 'phil.frary@nthdimension.fr', 'Y a-t-il des vélos pour les enfants ?', 'Chaque année, c\'est le coin qui bouge le plus car les enfants adorent essayer leurs nouveaux vélos. Nous en avons à tous les prix suivant leur état mais tous roulent très bien.', '2012-05-05 06:56:42', 1),
(112, 'Phil', 'phil.frary@nthdimension.fr', 'Est-ce que c’est à l’abri ?', 'La Bourse aux vélos de l&#039;AVS est organisée tous les ans et ce depuis novembre 2004 date de la 1ere édition dans le gymnase (40x20) de St Marc sur Mer. Les vélos sont présentés sur des barrières protégées par de la mousse.\r\nDepuis l&#039;année 2014, c&#039;est à La SOUCOUPE avenue Léo Lagrange St Nazaire. C&#039;est beaucoup plus grand (voir les photos sur ce site).', '2012-05-05 06:57:01', 1),
(115, 'Christian Pierre', 'chris.pierre2@sfr.fr', 'Je viens d&#039;apprendre l&#039;existence de votre bourse à vélos et je suis à la recherche d&#039;une paire de roues de vélo de course. Est-ce qu&#039;il y en aura à vendre d&#039;occasions ou bien votre club en revend-il ?', 'Chaque année des paires de roues sont déposées et elles trouvent acheteurs.\r\nRDV à la 16eme édition La Soucoupe de SAINT NAZAIRE LES 9 et 10 novembre 2019', '2013-04-13 12:19:53', 1),
(238, 'Phil', 'phil.frary@nthdimension.fr', 'Qui fixe le prix de vente des vélos présentés?', 'Après avoir rempli la \"fiche dépôt\", si le vendeur le souhaite, les \"estimeurs\" de l\'organisation sont à sa disposition pour fixer le \"bon\" prix. Néanmoins, c\'est le vendeur qui inscrit  son prix de vente et  il est le seul décideur.', '2013-10-29 20:22:07', 1),
(239, 'Phil', 'phil.frary@nthdimension.fr', 'J&#039;aimerais vendre mon vélo à assistance électrique. Les VAE sont-ils les bienvenus lors de votre bourse aux vélos de St-Nazaire et en vendez-vous ?', 'L&#039;année passée (2018), nous avions eu 4  vélos électriques à vendre, et 3 sont partis et donc ont trouvé preneur.\r\nSoyez donc la bienvenue, beaucoup de personnes que je rencontre sont très attirée par ce genre de vélo.\r\nAttention à ne pas être trop gourmande sur le prix!', '2013-10-29 20:41:24', 1),
(284, 'leray', 'benjamin_leray@hotmail.fr', 'bonjour, y a t&#039;il des remorques pour vélo à vendre à la bourse aux vélos?', 'Bonjour\r\nSi vous voulez parler de remorque qui s’accrochent à des vélos: oui Benjamin, nous en avions plusieurs (une petite dizaine) en 2013. Elles sont toutes parties sauf une qui n&#039;était pas très récente.\r\nSi ce sont des remorques pour installer des vélos: non!\r\n Par contre, nous avons eu à la vente des portes-vélos (4 vélos)\r\nRdv à la Soucoupe les 14 et 15 octobre 2017.\r\nMerci de votre confiance', '2014-08-24 13:16:09', 1),
(285, 'pierre', 'christian.pierre2@sfr.fr', 'Comment puis je savoir si mon vélo déposé est vendu?', 'Plusieurs solutions\n1- Sur place évidemment en présentant votre \"reçu vendeur\"\n2- Nouveau depuis 2014: en allant sur le site Internet de la Bourse aux vélos \nCliquez sur l\'onglet: \"VENTE\".\n Rentrez votre numéro de vélo dans la case. La réponse sera instantanée.\nSolution a privilégier!!!\n3- Par téléphone, au numéro indiqué sur votre \"reçu vendeur\"', '2014-08-25 19:04:52', 1),
(289, 'BRISSIER', 'brissier.guillaume@orange.fr', 'bonjour, pouvons nous vendre des roues carbones? merci', 'Bonjour,\nSi vous parcourez le règlement de La Bourse aux vélos de St Nazaire, on exclu les accessoires. Néanmoins chaque année, des personnes nous confient pour la vente des accessoires genre porte-vélos, remorques, cadres et roues.\nIl y a un marché  pour du gros accessoire. (Condition de vente identiques aux vélos)\nA bientôt.', '2014-09-30 17:10:29', 1),
(293, 'gineau', 'matgin.falu@sfr.fr', 'bjr ! melangez vous les vtt a petit prix avec ceux qui vale au moins 1300 e , comme le mien', 'Bonjour\nLes VTT comme les autres vélos sont rangés par genre et aussi par prix. Pour les beaux VTT, nous en avons toujours à chaque édition et des beaucoup plus chers.\nA bientôt', '2015-11-03 13:36:50', 1),
(298, 'Chausson V.', 'valerie.chausson@sfr.fr', 'Suis je obligé de revenir avant le dimanche soir 19h00 pour percevoir le montant de la vente si mon vélo est affiché &quot;vendu&quot; sur le site?\r\nJ&#039;habite Nantes. Merci!', 'Rappel de la procédure « + de 30 km»\r\nLe VENDEUR demande au moment du dépôt du vélo l’adresse où il pourra récupérer le vélo.  \r\nAprès avoir vérifié par téléphone ou sur le site de la BAV que son vélo a bien été vendu :\r\n Le VENDEUR enverra par la Poste dans la semaine qui suit la BAV: \r\n- le reçu vendeur de couleur.\r\n- une enveloppe timbrée rédigée à son nom et son adresse.\r\n- les 10 % par chèque à l’ordre de l’AVS.\r\nDès réception, l’AVS lui enverra le chèque remis par l’acheteur  à l’ordre du vendeur ou un chèque de l’AVS si le paiement s’est fait en liquide', '2016-09-11 14:19:20', 1),
(299, 'christophe', 'cmoreil@free.fr', 'Avons nous la garantie des paiements, Ne risque t-il pas de recevoir un chèque sans provisions', 'Bonjour Christophe\r\nC\'est en effet la crainte des organisateurs que nous sommes. Nous demandons une pièce d\'identité (2 pour les vélos de plus de 1000 €) à l\'acheteur.\r\nDepuis 14 ans le cas ne s\'est jamais produit.\r\nMalheureusement, nous ne pouvons pas utiliser de terminaux de paiements car les achats se font à l\'ordre du vendeur.', '2016-09-20 14:54:34', 1),
(300, 'MAISONNEUVE', 'bertrand.maisonneuve@orange.fr', 'Bonjour,\nJe souhaiterais acquérir un nouveau vélo de route car sur mon vieux vélo de route j\'ai des douleurs aux épaules et en bas du dos. Pour ne pas me tromper sur l\'achat à la bourse aux vélos, il y a-t-il des personnes pouvant conseiller la bonne posture voire faire une étude posturale ?\nMerci', 'Bonjour Bertrand\nNous avons la chance d\'avoir des professionnels de la vente de vélo qui sont licenciés dans le club organisateur. Ils sont présents pour conseiller nos acheteurs. Je dirais que c\'est un peu un des points forts de la Bourse de l\'AVS.\nA bientot', '2016-10-24 13:08:37', 1),
(302, 'Philippe Branchereau', 'philippe.branchereau@bbox.fr', 'Bonjour, pour cause de déménagement je souhaite me séparer d&#039;une centaine de livres concernant le cyclisme. Est-il possible de les vendre à cette occasion?\r\nmerci pour votre réponse, cordialement.', 'Bonjour Philippe\r\nNous ne vendons pas ni les accessoires ni les livres. Nous avons déja la vente de plus de 1000 vélos à gérer et il faudtrait plus encore de bénévoles pour que l\'on se diversifie. Nous sommes déja 90 à nous relayer pendant les 3 jours.\r\nNéanmoins appeler moi car je connais et pourrais trouver des collectionneurs qui pourraient être intéressés. (numéro sur le site ou l\'affiche)\r\nChristian', '2017-09-21 13:00:51', 1),
(303, 'Bougerol', 'cocosn@orange.fr', 'Bonjour,\r\nPourriez-vous m&#039;indiquer les heures d&#039;ouverture du samedi et dimanche.\r\nD&#039;avance merci.', 'Bonjour\r\n\r\n8h00 - 19h00 les 2 jours\r\nDépôts et ventes\r\nA bientot', '2017-10-04 06:34:42', 1),
(304, 'BOURGET', 'Bourgemilie@sfr.fr', 'Bonsoir\r\nJe souhaite mettre un beau vélo en vente. Y a t&#039;il des mesures de protection des vélos.', 'Merci de poser cette question.\r\nNOUVEAUTE: En 2019, nous ouvrons un show room pour les beaux vélos de plus de 500 €.\r\nCela se situera dans la mezzanine au dessus du hall d&#039;entrée.\r\nDans cet espace les vélos seront présentés debout bien espacés. Ils seront bien mis en évidence sur leurs supports pour faciliter les ventes.\r\nComme indiqué sur notre règlement, nous mettons tout en oeuvre pour ne pas qu&#039;il y ait de problème.\r\nVoir également la fiche pour les très beaux velos.', '2018-11-10 18:42:00', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
