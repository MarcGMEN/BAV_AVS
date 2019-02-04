-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 24 jan. 2019 à 16:46
-- Version du serveur :  10.1.30-MariaDB-0ubuntu0.17.10.1
-- Version de PHP :  7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bav`
--

-- --------------------------------------------------------

--
-- Structure de la table `bav_faq`
--

CREATE TABLE `bav_faq` (
  `faq_id` int(10) UNSIGNED NOT NULL,
  `faq_name` varchar(60) NOT NULL,
  `faq_email` varchar(60) NOT NULL,
  `faq_question` text NOT NULL,
  `faq_response` text,
  `faq_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `faq_approved` int(1) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bav_faq`
--

INSERT INTO `bav_faq` (`faq_id`, `faq_name`, `faq_email`, `faq_question`, `faq_response`, `faq_date`, `faq_approved`) VALUES
(1, 'Joel BOUREZ', 'notsupplied@notsupplied.com', 'Est-ce qu&#039;il y a des cars qui desservent La Soucoupe de Saint Nazaire en partant de St Nazaire/La Gare SNCF ?', 'Effectivement, il y a de nombreux bus qui d&eacute;servent la gare et La Soucoupe ou est organis&eacute;e la bourse.<br />\nPrenez qu&rsquo;un aller simple car il se peut que vous repartiez avec le v&eacute;lo de vos r&ecirc;ves&hellip;!', '2010-07-26 11:42:59', 1),
(2, 'M.PLUMERAT', 'notsupplied@notsupplied.com', 'Est-ce qu\'il faut remplir un formulaire pour s’inscrire à l\'avance ou peux t\'on simplement se présenter avec notre vélo sans inscription préalable ?', 'Les deux solutions sont possibles. Dans l&#39;onglet &quot;T&eacute;l&eacute;chargements&quot; vous trouverez un exemplaire du formulaire que vous pouvez remplir &agrave; l&#39;avance pour vous faire gagner du temps sur place.<br />\nSinon, tous les formulaires sont mis &agrave; votre disposition sur place.<br />\n<span style=\"background-color:#2ecc71\">**N&#39;oubliez pas votre pi&egrave;ce d&#39;identit&eacute;.**</span>', '2010-07-26 11:47:47', 1),
(3, 'M.NABIIS', 'notsupplied@notsupplied.com', 'Est-ce que les vélos de course seront acceptés ?', 'Tous les v&eacute;los sont accept&eacute;s dont les v&eacute;los de course &agrave; condition qu&#39;ils soient en &eacute;tat de rouler.', '2010-07-26 11:50:21', 1),
(4, 'Mme CHOTARD', 'notsupplied@notsupplied.com', 'Je recherche un vélo pour mon fils de 7 ans 1/2 qui mesure 1m29, entrejambe 58 cm, dois je prendre un 20 ou un 24 pouces sachant qu’il grandisse vite à cet age là.\nC\'est un cadeau donc je ne peux l’enmener avec moi.\nJe voudrais trouver un vélo en très bonne état,peut on trouver ça dans votre manifestation pour un prix résonnable ?', 'Nous ne pouvons &agrave; cette heure conna&icirc;tre le choix que nous aurons cette ann&eacute;e mais les autres ann&eacute;es, il y avait ce que vous cherchez.<br />\nLe mieux, c&rsquo;est de nous rendre visite d&egrave;s le samedi matin fin de matin&eacute;e au moment o&ugrave; il y a plus de choix. Nos vendeurs b&eacute;n&eacute;voles vous conseilleront.', '2010-07-26 11:54:07', 1),
(33, 'DUPAIN RAYMOND', 'r.dupain@voila.fr', 'Je suis absent le samedi; est il possible de déposer le vélo que je veux vendre la veille au soir au gymnase? ou bien alors le dimanche matin?\nEn vous remerciant pour votre réponse.', '<span style=\"background-color:#f39c12\">NOUVEAU depuis 2013&nbsp;: </span>Pour &eacute;viter l&rsquo;affluence du samedi matin nous commen&ccedil;ons les d&eacute;p&ocirc;ts (Uniquement les d&eacute;p&ocirc;ts) d&egrave;s le vendredi de 18h &agrave; 21h00 m&ecirc;me lieu La Soucoupe gard&eacute;e la nuit.', '2010-10-15 12:16:22', 1),
(36, 'drouard', 'cricri.doudou@free.fr', 'Faut\'il récupérer impérativement le vélo le dimanche soir ou possibilité\nle lundi matin ?', 'Malheureusement, nous devons libérer la salle le dimanche soir donc nous n\'avons pas la possibilité de stocker les vélos non-vendus.\nIl est donc impératif de récupérer le vélo le dimanche soir au plus tard.', '2010-10-25 12:39:46', 1),
(37, 'rivallin guy', 'guy.rivallin@orange.fr', 'Si je depose le velo samedi matin\ndois je le recuperer le soir pour le redeposer le dimanche', 'Non, il n\'est pas nécessaire de récupérer votre vélo et redéposer.\nNous assurons la sécurité des vélos déposés pendant les deux journées de la bourse aux vélos y compris la nuit.', '2010-11-04 12:30:51', 1),
(106, 'Phil', 'phil.frary@nthdimension.fr', 'Y a-t-il une garantie sur les vélos ?', 'Il y a une garantie seulement si le vélo que vous achèterez est encore sous garantie (cela arrive assez souvent). C’est le cas de vélos achetés récemment ne correspondant pas au besoin du propriétaire qui décide très vite de profiter de la bourse et ses 5000 à 6000 visiteurs pour le revendre.', '2012-05-05 06:55:15', 1),
(107, 'Phil', 'phil.frary@nthdimension.fr', 'Est-il possible d’échanger si on se trompe ?', 'Nous n\'avons jamais eu le cas mais si l\' acheteur constate très vite (pendant le week-end) un problème de fonctionnement nous reprenons le vélo et nous le sortons de la vente.', '2012-05-05 06:55:33', 1),
(108, 'Phil', 'phil.frary@nthdimension.fr', 'Quels sont les moyens de paiement ?', 'Par chèque  (carte d\'identité demandée) ou en numéraires. Nous ne pouvons utiliser de TPE car les chèques de l\'acheteur sont émis à l\'ordre du vendeur.', '2012-05-05 06:55:51', 1),
(109, 'Phil', 'phil.frary@nthdimension.fr', 'Peut-on payer en plusieurs fois ?', 'Si nous avons cette demande , nous contactons par t&eacute;l&eacute;phone le vendeur qui lui seul d&eacute;cide mais nous avons toujours eu des r&eacute;ponses favorables &agrave; cette requ&ecirc;te pour des v&eacute;los de plus de 1000 &euro;', '2012-05-05 06:56:14', 1),
(110, 'Phil', 'phil.frary@nthdimension.fr', 'Est-il possible d’essayer les vélos sur place ?', 'Les essais se font uniquement dans La Soucoupe pour des raison de s&eacute;curit&eacute; (vol). Une partie de cette tr&egrave;s grande salle est r&eacute;serv&eacute;e aux essais.<br />\nLes vendeurs de l&#39;association AVS sont l&agrave; pour vous conseiller.', '2012-05-05 06:56:28', 1),
(111, 'Phil', 'phil.frary@nthdimension.fr', 'Y a-t-il des vélos pour les enfants ?', 'Chaque année, c\'est le coin qui bouge le plus car les enfants adorent essayer leurs nouveaux vélos. Nous en avons à tous les prix suivant leur état mais tous roulent très bien.', '2012-05-05 06:56:42', 1),
(112, 'Phil', 'phil.frary@nthdimension.fr', 'Est-ce que c’est à l’abri ?', 'La Bourse aux vélos de l&#039;AVS est organisée tous les ans et ce depuis novembre 2004 date de la 1ere édition dans le gymnase (40x20) de St Marc sur Mer. Les vélos sont présentés sur des barrières protégées par de la mousse.\r\nDepuis l&#039;année 2014, c&#039;est à La SOUCOUPE avenue Léo Lagrange St Nazaire. C&#039;est beaucoup plus grand (voir les photos sur ce site).', '2012-05-05 06:57:01', 1),
(115, 'Christian Pierre', 'chris.pierre2@sfr.fr', 'Je viens d&#039;apprendre l&#039;existence de votre bourse à vélos et je suis à la recherche d&#039;une paire de roues de vélo de course. Est-ce qu&#039;il y en aura à vendre d&#039;occasions ou bien votre club en revend-il ?', 'Chaque ann&eacute;e des paires de roues sont d&eacute;pos&eacute;es et elles trouvent acheteurs.<br />\nRDV &agrave; la 16eme &eacute;dition La Soucoupe de SAINT NAZAIRE LES 9 et 10 novembre 2019', '2013-04-13 12:19:53', 1),
(238, 'Phil', 'phil.frary@nthdimension.fr', 'Qui fixe le prix de vente des vélos présentés?', 'Apr&egrave;s avoir rempli la &quot;fiche d&eacute;p&ocirc;t&quot;, si le vendeur le souhaite, les &quot;estimeurs&quot; de l&#39;organisation sont &agrave; sa disposition pour fixer le &quot;bon&quot; prix.<br />\n&eacute;anmoins, c&#39;est le vendeur qui inscrit son prix de vente et il est le seul d&eacute;cideur.', '2013-10-29 20:22:07', 1),
(239, 'Phil', 'phil.frary@nthdimension.fr', 'J&#039;aimerais vendre mon vélo à assistance électrique. Les VAE sont-ils les bienvenus lors de votre bourse aux vélos de St-Nazaire et en vendez-vous ?', 'L&#39;ann&eacute;e pass&eacute;e (2018), nous avions eu 4 v&eacute;los &eacute;lectriques &agrave; vendre, et 3 sont partis et donc ont trouv&eacute; preneur.<br />\nSoyez donc la bienvenue, beaucoup de personnes que je rencontre sont tr&egrave;s attir&eacute;e par ce genre de v&eacute;lo.<br />\nAttention &agrave; ne pas &ecirc;tre trop gourmande sur le prix!', '2013-10-29 20:41:24', 1),
(284, 'leray', 'benjamin_leray@hotmail.fr', 'bonjour, y a t&#039;il des remorques pour vélo à vendre à la bourse aux vélos?', 'Bonjour<br />\nSi vous voulez parler de remorque qui s&rsquo;accrochent &agrave; des v&eacute;los: oui Benjamin, nous en avions plusieurs (une petite dizaine) en 2013. Elles sont toutes parties sauf une qui n&#39;&eacute;tait pas tr&egrave;s r&eacute;cente.<br />\nSi ce sont des remorques pour installer des v&eacute;los: non!<br />\nPar contre, nous avons eu &agrave; la vente des portes-v&eacute;los (4 v&eacute;los)<br />\nRdv &agrave; la Soucoupe les 14 et 15 octobre 2017.<br />\nMerci de votre confiance', '2014-08-24 13:16:09', 1),
(285, 'pierre', 'christian.pierre2@sfr.fr', 'Comment puis je savoir si mon vélo déposé est vendu?', 'Plusieurs solutions<br />\n1- Sur place &eacute;videmment en pr&eacute;sentant votre &quot;re&ccedil;u vendeur&quot;<br />\n2- Nouveau depuis 2014: en allant sur le site Internet de la Bourse aux v&eacute;los<br />\nCliquez sur l&#39;onglet: &quot;VENTE&quot;.<br />\nRentrez votre num&eacute;ro de v&eacute;lo dans la case. La r&eacute;ponse sera instantan&eacute;e.<br />\nSolution a privil&eacute;gier!!!<br />\n3- Par t&eacute;l&eacute;phone, au num&eacute;ro indiqu&eacute; sur votre &quot;re&ccedil;u vendeur&quot;', '2014-08-25 19:04:52', 1),
(289, 'BRISSIER', 'brissier.guillaume@orange.fr', 'bonjour, pouvons nous vendre des roues carbones? merci', 'Bonjour,<br />\nSi vous parcourez le r&egrave;glement de La Bourse aux v&eacute;los de St Nazaire, on exclu les accessoires. N&eacute;anmoins chaque ann&eacute;e, des personnes nous confient pour la vente des accessoires genre porte-v&eacute;los, remorques, cadres et roues.<br />\nIl y a un march&eacute; pour du gros accessoire. (Condition de vente identiques aux v&eacute;los)<br />\nA bient&ocirc;t.', '2014-09-30 17:10:29', 1),
(293, 'gineau', 'matgin.falu@sfr.fr', 'bjr ! melangez vous les vtt a petit prix avec ceux qui vale au moins 1300 e , comme le mien', 'Bonjour<br />\nLes VTT comme les autres v&eacute;los sont rang&eacute;s par genre et aussi par prix. Pour les beaux VTT, nous en avons toujours &agrave; chaque &eacute;dition et des beaucoup plus chers.<br />\nA bient&ocirc;t', '2015-11-03 13:36:50', 1),
(298, 'Chausson V.', 'valerie.chausson@sfr.fr', 'Suis je obligé de revenir avant le dimanche soir 19h00 pour percevoir le montant de la vente si mon vélo est affiché &quot;vendu&quot; sur le site?\r\nJ&#039;habite Nantes. Merci!', 'Rappel de la proc&eacute;dure &laquo;   de 30 km&raquo;<br />\nLe VENDEUR demande au moment du d&eacute;p&ocirc;t du v&eacute;lo l&rsquo;adresse o&ugrave; il pourra r&eacute;cup&eacute;rer le v&eacute;lo.<br />\nApr&egrave;s avoir v&eacute;rifi&eacute; par t&eacute;l&eacute;phone ou sur le site de la BAV que son v&eacute;lo a bien &eacute;t&eacute; vendu :<br />\nLe VENDEUR enverra par la Poste dans la semaine qui suit la BAV:<br />\n- le re&ccedil;u vendeur de couleur.<br />\n- une enveloppe timbr&eacute;e r&eacute;dig&eacute;e &agrave; son nom et son adresse.<br />\n- les 10 % par ch&egrave;que &agrave; l&rsquo;ordre de l&rsquo;AVS.<br />\nD&egrave;s r&eacute;ception, l&rsquo;AVS lui enverra le ch&egrave;que remis par l&rsquo;acheteur &agrave; l&rsquo;ordre du vendeur ou un ch&egrave;que de l&rsquo;AVS si le paiement s&rsquo;est fait en liquide', '2016-09-11 14:19:20', 1),
(299, 'christophe', 'cmoreil@free.fr', 'Avons nous la garantie des paiements, Ne risque t-il pas de recevoir un chèque sans provisions', 'Bonjour Christophe<br />\nC&#39;est en effet la crainte des organisateurs que nous sommes. Nous demandons une pi&egrave;ce d&#39;identit&eacute; (2 pour les v&eacute;los de plus de 1000 &euro;) &agrave; l&#39;acheteur.<br />\nDepuis 14 ans le cas ne s&#39;est jamais produit.<br />\nMalheureusement, nous ne pouvons pas utiliser de terminaux de paiements car les achats se font &agrave; l&#39;ordre du vendeur.', '2016-09-20 14:54:34', 1),
(300, 'MAISONNEUVE', 'bertrand.maisonneuve@orange.fr', 'Bonjour,\nJe souhaiterais acquérir un nouveau vélo de route car sur mon vieux vélo de route j\'ai des douleurs aux épaules et en bas du dos. Pour ne pas me tromper sur l\'achat à la bourse aux vélos, il y a-t-il des personnes pouvant conseiller la bonne posture voire faire une étude posturale ?\nMerci', 'Bonjour Bertrand<br />\nNous avons la chance d&#39;avoir des professionnels de la vente de v&eacute;lo qui sont licenci&eacute;s dans le club organisateur. Ils sont pr&eacute;sents pour conseiller nos acheteurs. Je dirais que c&#39;est un peu un des points forts de la Bourse de l&#39;AVS.<br />\nA bientot', '2016-10-24 13:08:37', 1),
(302, 'Philippe Branchereau', 'philippe.branchereau@bbox.fr', 'Bonjour, pour cause de déménagement je souhaite me séparer d&#039;une centaine de livres concernant le cyclisme. Est-il possible de les vendre à cette occasion?\r\nmerci pour votre réponse, cordialement.', 'Bonjour Philippe<br />\nNous ne vendons pas ni les accessoires ni les livres. Nous avons d&eacute;ja la vente de plus de 1000 v&eacute;los &agrave; g&eacute;rer et il faudtrait plus encore de b&eacute;n&eacute;voles pour que l&#39;on se diversifie. Nous sommes d&eacute;ja 90 &agrave; nous relayer pendant les 3 jours.<br />\nN&eacute;anmoins appeler moi car je connais et pourrais trouver des collectionneurs qui pourraient &ecirc;tre int&eacute;ress&eacute;s. (num&eacute;ro sur le site ou l&#39;affiche)<br />\nChristian', '2017-09-21 13:00:51', 1),
(303, 'Bougerol', 'cocosn@orange.fr', 'Bonjour,\r\nPourriez-vous m&#039;indiquer les heures d&#039;ouverture du samedi et dimanche.\r\nD&#039;avance merci.', '<p>Bonjour<br />\n8h00 - 19h00 les 2 jours D&eacute;p&ocirc;ts et ventes<br />\nA bientot</p>\n', '2017-10-04 06:34:42', 1),
(304, 'BOURGET', 'Bourgemilie@sfr.fr', 'Bonsoir\r\nJe souhaite mettre un beau vélo en vente. Y a t&#039;il des mesures de protection des vélos.', 'Merci de poser cette question.<br />\n<strong><span style=\"background-color:#f39c12\">NOUVEAUTE: En 2019</span></strong>, nous ouvrons un show room pour les beaux v&eacute;los de plus de 500 &euro;.<br />\nCela se situera dans la mezzanine au dessus du hall d&#39;entr&eacute;e.<br />\nDans cet espace les v&eacute;los seront pr&eacute;sent&eacute;s debout bien espac&eacute;s. Ils seront bien mis en &eacute;vidence sur leurs supports pour faciliter les ventes.<br />\nComme indiqu&eacute; sur notre r&egrave;glement, nous mettons tout en oeuvre pour ne pas qu&#39;il y ait de probl&egrave;me.<br />\nVoir &eacute;galement la fiche pour les tr&egrave;s beaux velos.', '2018-11-10 18:42:00', 1),
(311, 'Garcés Marc', 'marc.garces@free.fr', 'sfsfsf', '<p>test &eacute;&quot;&#39;&eacute;&quot;&egrave;(&ccedil;_&quot;&#39;(-&quot;&#39;_&ccedil;&agrave;(&#39;<br />\n<strong>en gras&nbsp;<br />\nliste&nbsp;</strong></p>\n\n<ol>\n	<li><strong>121</strong></li>\n	<li><strong>12411</strong></li>\n</ol>\n', '2019-01-24 08:09:07', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bav_faq`
--
ALTER TABLE `bav_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bav_faq`
--
ALTER TABLE `bav_faq`
  MODIFY `faq_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
