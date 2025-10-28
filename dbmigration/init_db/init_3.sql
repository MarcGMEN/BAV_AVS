-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Hôte : db5009115771.hosting-data.io
-- Généré le : jeu. 23 oct. 2025 à 09:07
-- Version du serveur : 5.7.42-log
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db326893785`
--

-- --------------------------------------------------------

--
-- Structure de la table `bav_actu`
--

DROP TABLE IF EXISTS `bav_actu`;
CREATE TABLE `bav_actu` (
  `act_id` int(11) NOT NULL,
  `act_titre` text NOT NULL,
  `act_text` text,
  `act_numero_bav` int(11) NOT NULL,
  `act_type` enum('ANIM','FAQ','PRESSE') NOT NULL DEFAULT 'ANIM',
  `act_active` tinyint(1) NOT NULL DEFAULT '0',
  `act_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_mail` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bav_actu`
--

INSERT INTO `bav_actu` (`act_id`, `act_titre`, `act_text`, `act_numero_bav`, `act_type`, `act_active`, `act_date`, `act_mail`) VALUES
(0, 'Ouest France', '<img alt=\"\" height=\"468\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/80a10257.jpg\" width=\"400\" />', 2019, 'PRESSE', 1, '2020-07-01 05:23:22', NULL),
(1, 'Est-ce qu&#39;il faut remplir un formulaire pour s&rsquo;inscrire &agrave; l&#39;avance ou peux t&#39;on simplement se pr&eacute;senter avec notre v&eacute;lo sans inscription pr&eacute;alable ?', 'Les deux solutions sont possibles. Dans l&#39;onglet &quot;T&eacute;l&eacute;chargements&quot; vous trouverez un exemplaire du formulaire que vous pouvez remplir &agrave; l&#39;avance pour vous faire gagner du temps sur place.<br />\nSinon, tous les formulaires sont mis &agrave; votre disposition sur place.<br />\n<span style=\"background-color:#2ecc71\">**N&#39;oubliez pas votre pi&egrave;ce d&#39;identit&eacute;.**</span>', 2019, 'FAQ', 1, '2010-07-26 05:47:47', 'notsupplied@notsupplied.com'),
(18, 'Presse Oc&eacute;an - Octobre 2017', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/6583b5a.png\" />', 2017, 'PRESSE', 1, '2019-02-05 09:14:28', NULL),
(19, 'Estuaire Hebdo - Octobre 2017', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/473e0ec.png\" />', 2017, 'PRESSE', 1, '2019-02-05 09:15:18', NULL),
(20, 'Ouest France - 07/11/2016', '<div><a href=\"http://avs44.com/bourseauxvelos/ckeditorUploads/7f23bcc.jpg\" target=\"_blank\"><img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/7f23bcc.jpg\" /></a></div>\n', 2016, 'PRESSE', 1, '2019-02-05 09:15:46', NULL),
(21, 'Presse Oc&eacute;an - 07/11/2016', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/5c52007.jpg\" />', 2016, 'PRESSE', 1, '2019-02-05 09:20:25', NULL),
(22, 'Ouest France - 06/11/2016', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/8d8d613.jpg\" />', 2016, 'PRESSE', 1, '2016-11-26 09:21:49', NULL),
(23, 'Ouest France - 04/11/2016', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/9a82cca.jpg\" />', 2016, 'PRESSE', 1, '2019-02-05 09:23:11', NULL),
(24, 'Echo de la Prequ&#39;&icirc;le - 04/11/2016', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/114eb167.jpg\" />', 2016, 'PRESSE', 1, '2019-02-05 09:25:20', NULL),
(25, 'Presse Oc&eacute;an - 31/10/2016', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/10227624.jpg\" />', 2016, 'PRESSE', 1, '2019-02-05 09:26:55', NULL),
(26, 'Presse Oc&eacute;an - 09/11/2015', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/1135e0c8.png\" />', 2015, 'PRESSE', 1, '2019-02-05 09:30:13', NULL),
(27, 'Presse Oc&eacute;an - 09/11/2015', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/124f9fb1.jpg\" />', 2015, 'PRESSE', 1, '2019-02-05 09:42:14', NULL),
(28, 'Ouest France - 08/11/2015', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/14f1f302.jpg\" /><br />\n<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/137d849b.jpg\" />', 2015, 'PRESSE', 1, '2019-02-05 09:44:00', NULL),
(29, 'Presse Oc&eacute;an - 03/11/2015', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/15044672.jpg\" />', 2015, 'PRESSE', 1, '2019-02-05 09:45:38', NULL),
(30, 'Ouest France - 04/11/2015', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/164d11b9.jpg\" />', 2015, 'PRESSE', 1, '2019-02-05 09:46:46', NULL),
(31, 'Ouest France - 04/11/2015', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/17c11448.jpg\" />', 2015, 'PRESSE', 1, '2019-02-05 09:48:58', NULL),
(32, 'Ouest France - 18/11/2018', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/182e7897.jpg\" />', 2018, 'PRESSE', 1, '2019-02-05 09:53:06', NULL),
(33, 'PRESSE OC&Eacute;AN - D&Eacute;CEMBRE 2014', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/198b7d55.jpg\" />', 2014, 'PRESSE', 1, '2019-02-06 09:43:29', NULL),
(37, 'Tombola', '<img alt=\"\" height=\"115\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/terre_de_cycle_logo.png\" width=\"396\" /><br />\nPendant l&#39;&eacute;dition 2018, chaque acheteur, vendeur ou visiteur pourra s&#39;il le souhaite participer &agrave; la tombola gratuite de <strong>la Bourse aux V&eacute;los </strong>pour gagner un tr&egrave;s beau VTT NEUF de chez &quot;<strong>Terre de Cycle</strong>&quot; &agrave; La Baule.<br />\nTirage au sort le dimanche soir vers 17h30.<br />\n<br />\n==&gt;&nbsp;<a href=\"http://avs44.com/bourseauxvelos/downloads/reglement_tombola.pdf\" target=\"_blank\">reglement de la tombola</a>', 2018, 'ANIM', 1, '2019-02-07 11:02:48', NULL),
(38, 'Bruno Robineau, cr&eacute;ateur de v&eacute;los miniatures faits main', '&nbsp;\n<table cellpadding=\"1\" cellspacing=\"1\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td><img alt=\"\" height=\"128\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/velodubonheur.png\" width=\"200\" /></td>\n			<td><img alt=\"\" height=\"127\" src=\"http://localhost/bourseauxvelos/ckeditorUploads/velos_decoratifs_2018.jpg\" width=\"189\" /></td>\n		</tr>\n	</tbody>\n</table>\n<br />\nBruno ROBINEAU participera &agrave; notre bourse aux v&eacute;los, ne manquez pas de visiter son stand.<br />\nEn plus d&rsquo;une large gamme de plus de 20 v&eacute;los miniatures faits main avec un seul fil , il y pr&eacute;sentera ses r&eacute;cits de voyage : Huit ans autour du monde, Compostelle en famille, Roumanie vagabonde.<br />\n&nbsp;<a href=\"http://avs44.com/bourseauxvelos/Images/animations/velos_miniatures_2018.pdf\">Plus d&#39;informations</a>', 2018, 'ANIM', 1, '2019-02-07 10:13:23', NULL),
(41, 'Est-ce qu&#39;il y a des cars qui desservent La Soucoupe de Saint Nazaire en partant de St Nazaire/La Gare SNCF ?', 'Effectivement, il y a de nombreux bus qui d&eacute;servent la gare et La Soucoupe ou est organis&eacute;e la bourse.<br />\nPrenez qu&rsquo;un aller simple car il se peut que vous repartiez avec le v&eacute;lo de vos r&ecirc;ves&hellip;!', 2019, 'FAQ', 1, '2010-07-26 05:42:59', 'notsupplied@notsupplied.com'),
(42, 'Est-ce que les v&eacute;los de course seront accept&eacute;s ?', 'Tous les v&eacute;los sont accept&eacute;s dont les v&eacute;los de course &agrave; condition qu&#39;ils soient en &eacute;tat de rouler.', 2019, 'FAQ', 1, '2010-07-26 05:50:21', 'notsupplied@notsupplied.com'),
(43, 'Je recherche un v&eacute;lo pour mon fils de 7 ans 1/2 qui mesure 1m29, entrejambe 58 cm, dois je prendre un 20 ou un 24 pouces sachant qu&rsquo;il grandisse vite &agrave; cet age l&agrave;.<br />\nC&#39;est un cadeau donc je ne peux l&rsquo;enmener avec moi.<br />\nJe voudrais trouver un v&eacute;lo en tr&egrave;s bonne &eacute;tat,peut on trouver &ccedil;a dans votre manifestation pour un prix r&eacute;sonnable ?', 'Nous ne pouvons &agrave; cette heure conna&icirc;tre le choix que nous aurons cette ann&eacute;e mais les autres ann&eacute;es, il y avait ce que vous cherchez.<br />\nLe mieux, c&rsquo;est de nous rendre visite d&egrave;s le samedi matin fin de matin&eacute;e au moment o&ugrave; il y a plus de choix. Nos vendeurs b&eacute;n&eacute;voles vous conseilleront.', 2019, 'FAQ', 1, '2010-07-26 05:54:07', 'notsupplied@notsupplied.com'),
(44, 'Je suis absent le samedi; est il possible de d&eacute;poser le v&eacute;lo que je veux vendre la veille au soir au gymnase? ou bien alors le dimanche matin?<br />\nEn vous remerciant pour votre r&eacute;ponse.', '<span style=\"background-color:#f39c12\">NOUVEAU depuis 2013&nbsp;: </span>Pour &eacute;viter l&rsquo;affluence du samedi matin nous commen&ccedil;ons les d&eacute;p&ocirc;ts (Uniquement les d&eacute;p&ocirc;ts) d&egrave;s le vendredi de 18h &agrave; 21h00 m&ecirc;me lieu La Soucoupe gard&eacute;e la nuit.', 2019, 'FAQ', 1, '2010-10-15 06:16:22', 'r.dupain@voila.fr'),
(45, 'Faut&#39;il r&eacute;cup&eacute;rer imp&eacute;rativement le v&eacute;lo le dimanche soir ou possibilit&eacute;&nbsp;le lundi matin ?', 'Malheureusement, nous devons lib&eacute;rer la salle le dimanche soir donc nous n&#39;avons pas la possibilit&eacute; de stocker les v&eacute;los non-vendus. Il est donc imp&eacute;ratif de r&eacute;cup&eacute;rer le v&eacute;lo le dimanche soir au plus tard.', 2019, 'FAQ', 1, '2010-10-25 06:39:46', 'cricri.doudou@free.fr'),
(46, 'Si je depose le velo samedi matin dois je le recuperer le soir pour le redeposer le dimanche', 'Non, il n&#39;est pas n&eacute;cessaire de r&eacute;cup&eacute;rer votre v&eacute;lo et red&eacute;poser. Nous assurons la s&eacute;curit&eacute; des v&eacute;los d&eacute;pos&eacute;s pendant les deux journ&eacute;es de la bourse aux v&eacute;los y compris la nuit.', 2019, 'FAQ', 1, '2010-11-04 09:30:51', 'guy.rivallin@orange.fr'),
(47, 'Y a-t-il une garantie sur les v&eacute;los ?', 'Il y a une garantie seulement si le v&eacute;lo que vous ach&eacute;terez est encore sous garantie (cela arrive assez souvent). C&#39;est le cas de v&eacute;los achet&eacute;s r&eacute;cemment ne correspondant pas au besoin du propri&egrave;taire qui d&eacute;cide tr&egrave;s vite de profiter de la bourse et ses 5000 &agrave; 6000 visiteurs pour le revendre.', 2019, 'FAQ', 1, '2012-05-05 00:55:15', 'phil.frary@nthdimension.fr'),
(48, 'Est-il possible d&#39;&eacute;changer si on se trompe ?', 'Nous n&#39;avons jamais eu le cas mais si l&#39; acheteur constate tr&eacute;s vite (pendant le week-end) un probl&egrave;me de fonctionnement nous reprenons le v&eacute;lo et nous le sortons de la vente.', 2019, 'FAQ', 1, '2012-05-05 00:55:33', 'phil.frary@nthdimension.fr'),
(49, 'Quels sont les moyens de paiement ?', 'Par ch&egrave;que (carte d&#39;identit&eacute; demand&eacute;e) ou en num&eacute;raires. Nous ne pouvons utiliser de TPE car les ch&egrave;ques de l&#39;acheteur sont &eacute;mis &agrave; l&#39;ordre du vendeur.', 2019, 'FAQ', 1, '2012-05-05 00:55:51', 'phil.frary@nthdimension.fr'),
(50, 'Peut-on payer en plusieurs fois ?', 'Si nous avons cette demande , nous contactons par t&eacute;l&eacute;phone le vendeur qui lui seul d&eacute;cide mais nous avons toujours eu des r&eacute;ponses favorables &agrave; cette requ&ecirc;te pour des v&eacute;los de plus de 1000 &euro;', 2019, 'FAQ', 1, '2012-05-05 00:56:14', 'phil.frary@nthdimension.fr'),
(51, 'Est-il possible d&#39;essayer les v&eacute;los sur place ?', 'Les essais se font uniquement dans La Soucoupe pour des raison de s&eacute;curit&eacute; (vol). Une partie de cette tr&egrave;s grande salle est r&eacute;serv&eacute;e aux essais.<br />\nLes vendeurs de l&#39;association AVS sont l&agrave; pour vous conseiller.', 2019, 'FAQ', 1, '2012-05-05 00:56:28', 'phil.frary@nthdimension.fr'),
(52, 'Y a-t-il des v&eacute;los pour les enfants ?', 'Chaque ann&eacute;e, c&#39;est le coin qui bouge le plus car les enfants adorent essayer leurs nouveaux v&eacute;los. Nous en avons &agrave; tous les prix suivant leur &eacute;tat mais tous roulent tr&egrave;s bien.', 2019, 'FAQ', 1, '2012-05-05 00:56:42', 'phil.frary@nthdimension.fr'),
(53, 'Est-ce que c&rsquo;est &agrave; l&rsquo;abri ?', 'La Bourse aux v&eacute;los de l&#39;AVS est organis&eacute;e tous les ans et ce depuis novembre 2004 date de la 1ere &eacute;dition dans le gymnase (40x20) de St Marc sur Mer. Les v&eacute;los sont pr&eacute;sent&eacute;s sur des barri&egrave;res prot&eacute;g&eacute;es par de la mousse. Depuis l&#39;ann&eacute;e 2014, c&#39;est &agrave; La SOUCOUPE avenue L&eacute;o Lagrange St Nazaire. C&#39;est beaucoup plus grand (voir les photos sur ce site).', 2019, 'FAQ', 1, '2012-05-05 00:57:01', 'phil.frary@nthdimension.fr'),
(54, 'Je viens d&#39;apprendre l&#39;existence de votre bourse &agrave; v&eacute;los et je suis &agrave; la recherche d&#39;une paire de roues de v&eacute;lo de course.<br />\nEst-ce qu&#39;il y en aura &agrave; vendre d&#39;occasions ou bien votre club en revend-il ?', 'Chaque ann&eacute;e des paires de roues sont d&eacute;pos&eacute;es et elles trouvent acheteurs.<br />\nRDV &agrave; la 16eme &eacute;dition La Soucoupe de SAINT NAZAIRE LES 9 et 10 novembre 2019', 2019, 'FAQ', 1, '2013-04-13 06:19:53', 'chris.pierre2@sfr.fr'),
(55, 'Qui fixe le prix de vente des v&eacute;los pr&eacute;sent&eacute;s?', 'Apr&egrave;s avoir rempli la &quot;fiche d&eacute;p&ocirc;t&quot;, si le vendeur le souhaite, les &quot;estimeurs&quot; de l&#39;organisation sont &agrave; sa disposition pour fixer le &quot;bon&quot; prix.<br />\n&eacute;anmoins, c&#39;est le vendeur qui inscrit son prix de vente et il est le seul d&eacute;cideur.', 2019, 'FAQ', 1, '2013-10-29 17:22:07', 'phil.frary@nthdimension.fr'),
(56, 'J&#39;aimerais vendre mon v&eacute;lo &agrave; assistance &eacute;lectrique. Les VAE sont-ils les bienvenus lors de votre bourse aux v&eacute;los de St-Nazaire et en vendez-vous ?', 'L&#39;ann&eacute;e pass&eacute;e (2018), nous avions eu 4 v&eacute;los &eacute;lectriques &agrave; vendre, et 3 sont partis et donc ont trouv&eacute; preneur.<br />\nSoyez donc la bienvenue, beaucoup de personnes que je rencontre sont tr&egrave;s attir&eacute;e par ce genre de v&eacute;lo.<br />\nAttention &agrave; ne pas &ecirc;tre trop gourmande sur le prix!', 2019, 'FAQ', 1, '2013-10-29 17:41:24', 'phil.frary@nthdimension.fr'),
(57, 'bonjour, y a t&#39;il des remorques pour v&eacute;lo &agrave; vendre &agrave; la bourse aux v&eacute;los?', 'Bonjour<br />\nSi vous voulez parler de remorque qui s&rsquo;accrochent &agrave; des v&eacute;los: oui Benjamin, nous en avions plusieurs (une petite dizaine) en 2013. Elles sont toutes parties sauf une qui n&#39;&eacute;tait pas tr&egrave;s r&eacute;cente.<br />\nSi ce sont des remorques pour installer des v&eacute;los: non!<br />\nPar contre, nous avons eu &agrave; la vente des portes-v&eacute;los (4 v&eacute;los)<br />\nRdv &agrave; la Soucoupe les 14 et 15 octobre 2017.<br />\nMerci de votre confiance', 2019, 'FAQ', 1, '2014-08-24 07:16:09', 'benjamin_leray@hotmail.fr'),
(58, 'Comment puis je savoir si mon v&eacute;lo d&eacute;pos&eacute; est vendu?', 'Plusieurs solutions<br />\n1- Sur place &eacute;videmment en pr&eacute;sentant votre &quot;re&ccedil;u vendeur&quot;<br />\n2- Nouveau depuis 2014: en allant sur le site Internet de la Bourse aux v&eacute;los<br />\nCliquez sur l&#39;onglet: &quot;VENTE&quot;.<br />\nRentrez votre num&eacute;ro de v&eacute;lo dans la case. La r&eacute;ponse sera instantan&eacute;e.<br />\nSolution a privil&eacute;gier!!!<br />\n3- Par t&eacute;l&eacute;phone, au num&eacute;ro indiqu&eacute; sur votre &quot;re&ccedil;u vendeur&quot;', 2019, 'FAQ', 1, '2014-08-25 13:04:52', 'christian.pierre2@sfr.fr'),
(59, 'bonjour, pouvons nous vendre des roues carbones? merci', 'Bonjour,<br />\nSi vous parcourez le r&egrave;glement de La Bourse aux v&eacute;los de St Nazaire, on exclu les accessoires. N&eacute;anmoins chaque ann&eacute;e, des personnes nous confient pour la vente des accessoires genre porte-v&eacute;los, remorques, cadres et roues.<br />\nIl y a un march&eacute; pour du gros accessoire. (Condition de vente identiques aux v&eacute;los)<br />\nA bient&ocirc;t.', 2019, 'FAQ', 1, '2014-09-30 11:10:29', 'brissier.guillaume@orange.fr'),
(60, 'bjr ! melangez vous les vtt a petit prix avec ceux qui vale au moins 1300 e , comme le mien', 'Bonjour<br />\nLes VTT comme les autres v&eacute;los sont rang&eacute;s par genre et aussi par prix. Pour les beaux VTT, nous en avons toujours &agrave; chaque &eacute;dition et des beaucoup plus chers.<br />\nA bient&ocirc;t', 2019, 'FAQ', 1, '2015-11-03 10:36:50', 'matgin.falu@sfr.fr'),
(61, 'Suis je oblig&eacute; de revenir avant le dimanche soir 19h00 pour percevoir le montant de la vente si mon v&eacute;lo est affich&eacute; &quot;vendu&quot; sur le site?<br />\nJ&#39;habite Nantes. Merci!', 'Rappel de la proc&eacute;dure &laquo; de 30 km&raquo;<br />\nLe VENDEUR demande au moment du d&eacute;p&ocirc;t du v&eacute;lo l&rsquo;adresse o&ugrave; il pourra r&eacute;cup&eacute;rer le v&eacute;lo.<br />\nApr&egrave;s avoir v&eacute;rifi&eacute; par t&eacute;l&eacute;phone ou sur le site de la BAV que son v&eacute;lo a bien &eacute;t&eacute; vendu :<br />\nLe VENDEUR enverra par la Poste dans la semaine qui suit la BAV:<br />\n- le re&ccedil;u vendeur de couleur.<br />\n- une enveloppe timbr&eacute;e r&eacute;dig&eacute;e &agrave; son nom et son adresse.<br />\n- les 10 % par ch&egrave;que &agrave; l&rsquo;ordre de l&rsquo;AVS.<br />\nD&egrave;s r&eacute;ception, l&rsquo;AVS lui enverra le ch&egrave;que remis par l&rsquo;acheteur &agrave; l&rsquo;ordre du vendeur ou un ch&egrave;que de l&rsquo;AVS si le paiement s&rsquo;est fait en liquide', 2019, 'FAQ', 1, '2016-09-11 08:19:20', 'valerie.chausson@sfr.fr'),
(62, 'Avons nous la garantie des paiements, Ne risque t-il pas de recevoir un ch&egrave;que sans provisions', 'Bonjour Christophe<br />\nC&#39;est en effet la crainte des organisateurs que nous sommes. Nous demandons une pi&egrave;ce d&#39;identit&eacute; (2 pour les v&eacute;los de plus de 1000 &euro;) &agrave; l&#39;acheteur.<br />\nDepuis 14 ans le cas ne s&#39;est jamais produit.<br />\nMalheureusement, nous ne pouvons pas utiliser de terminaux de paiements car les achats se font &agrave; l&#39;ordre du vendeur.', 2019, 'FAQ', 1, '2016-09-20 08:54:34', 'cmoreil@free.fr'),
(63, 'Bonjour,<br />\nJe souhaiterais acqu&eacute;rir un nouveau v&eacute;lo de route car sur mon vieux v&eacute;lo de route j&#39;ai des douleurs aux &eacute;paules et en bas du dos. Pour ne pas me tromper sur l&#39;achat &agrave; la bourse aux v&eacute;los, il y a-t-il des personnes pouvant conseiller la bonne posture voire faire une &eacute;tude posturale ?<br />\nMerci', 'Bonjour Bertrand<br />\nNous avons la chance d&#39;avoir des professionnels de la vente de v&eacute;lo qui sont licenci&eacute;s dans le club organisateur. Ils sont pr&eacute;sents pour conseiller nos acheteurs. Je dirais que c&#39;est un peu un des points forts de la Bourse de l&#39;AVS.<br />\nA bientot', 2019, 'FAQ', 1, '2016-10-24 07:08:37', 'bertrand.maisonneuve@orange.fr'),
(64, 'Bonjour, pour cause de d&eacute;m&eacute;nagement je souhaite me s&eacute;parer d&#39;une centaine de livres concernant le cyclisme. Est-il possible de les vendre &agrave; cette occasion?<br />\nmerci pour votre r&eacute;ponse, cordialement.', 'Bonjour Philippe<br />\nNous ne vendons pas ni les accessoires ni les livres. Nous avons d&eacute;ja la vente de plus de 1000 v&eacute;los &agrave; g&eacute;rer et il faudtrait plus encore de b&eacute;n&eacute;voles pour que l&#39;on se diversifie. Nous sommes d&eacute;ja 90 &agrave; nous relayer pendant les 3 jours.<br />\nN&eacute;anmoins appeler moi car je connais et pourrais trouver des collectionneurs qui pourraient &ecirc;tre int&eacute;ress&eacute;s. (num&eacute;ro sur le site ou l&#39;affiche)<br />\nChristian', 2019, 'FAQ', 1, '2017-09-21 07:00:51', 'philippe.branchereau@bbox.fr'),
(65, 'Bonjour,<br />\nPourriez-vous m&#39;indiquer les heures d&#39;ouverture du samedi et dimanche.<br />\nD&#39;avance merci.', '<p>Bonjour<br />\n8h00 - 19h00 les 2 jours D&eacute;p&ocirc;ts et ventes<br />\nA bientot</p>\n', 2019, 'FAQ', 1, '2017-10-04 00:34:42', 'cocosn@orange.fr'),
(66, 'Bonsoir<br />\nJe souhaite mettre un beau v&eacute;lo en vente.<br />\nY a t&#39;il des mesures de protection des v&eacute;los.', 'Merci de poser cette question.<br />\n<strong><span style=\"background-color:#f39c12\">NOUVEAUTE: En 2019</span></strong>, nous ouvrons un show room pour les beaux v&eacute;los de plus de 500 &euro;.<br />\nCela se situera dans la mezzanine au dessus du hall d&#39;entr&eacute;e.<br />\nDans cet espace les v&eacute;los seront pr&eacute;sent&eacute;s debout bien espac&eacute;s. Ils seront bien mis en &eacute;vidence sur leurs supports pour faciliter les ventes.<br />\nComme indiqu&eacute; sur notre r&egrave;glement, nous mettons tout en oeuvre pour ne pas qu&#39;il y ait de probl&egrave;me.<br />\nVoir &eacute;galement la fiche pour les tr&egrave;s beaux velos.', 2019, 'FAQ', 1, '2018-11-10 15:42:00', 'Bourgemilie@sfr.fr'),
(67, 'Rencontrez le club v&eacute;lo Nazarien OCN', 'Pr&eacute;sence des membres du club v&eacute;lo OCN pendant la bourse aux v&eacute;los - venez les rencontrer sur place.<br />\n<img alt=\"\" height=\"463\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/logo_ocn_2018.png\" width=\"591\" /> <a href=\"Images/animations/flyer_ocn_2018.pdf\" target=\"_blank\">Visualiser la presentation</a>', 2018, 'ANIM', 1, '2019-03-04 11:46:32', NULL),
(68, 'VOL DE VELOS', '<p>Pr&egrave;s de 500 000 v&eacute;los ont &eacute;t&eacute; d&eacute;clar&eacute;s vol&eacute;s en France en 2016, soit 1 369 v&eacute;los par jour.</p>\n\n<p>Venez rencontrer des b&eacute;n&eacute;voles de l&#39;association&nbsp;Place au Velo&nbsp;pour mieux vous prot&eacute;ger contre le vol de v&eacute;los<img alt=\"\" height=\"395\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/logo_place_au_velo.png\" width=\"577\" /><br />\n<br />\n<a href=\"./Images/animations/flyer_vol_de_velo.pdf\" target=\"_blank\">&nbsp;Visualiser la presentation</a></p>\n', 2018, 'ANIM', 1, '2019-03-04 11:08:30', NULL),
(69, 'Gagnant Tombola', 'Heureuse gagnante en 2017 : Sylvie MORICE de La Baule qui part avec un VTT neuf marque TREK de chez &quot;Terre de Cycle&quot;, La Baule<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/gagnant_tombola_2017.jpg\" />', 2017, 'ANIM', 1, '2017-05-04 09:52:53', NULL),
(70, 'Herv&eacute; LEDUC<br />\nDimanche 15 octobre 15h00', 'Conf&eacute;rence diaporama par Herv&eacute; Leduc.&nbsp;<br />\nApr&egrave;s Sandrine Laporal, pr&eacute;sente &agrave; la BAV 2016, qui &eacute;tait venue suite &agrave; sa travers&eacute;e du Canada &agrave; v&eacute;lo, place &agrave; une autre conf&eacute;rence d&eacute;bat.<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/leduc_1.jpg\" />', 2017, 'ANIM', 1, '2017-03-04 11:53:45', NULL),
(71, '&quot;Un homme, un v&eacute;lo, une aventure!&quot;', 'En trois mots, c&#39;est ainsi que le nazairien Herv&eacute; Leduc a coutume de r&eacute;sumer le p&eacute;riple autour du monde qu&#39;il a accompli en v&eacute;lo.<br />\nIl vous parlera lors de cette conf&eacute;rence, de son p&eacute;riple retra&ccedil;ant les 54 650 km parcourus &agrave; travers 34 pays . Il a notamment les d&eacute;serts du Thar en Inde ou le Taklamakan en Chine.<br />\nA la fin, il pourra vous d&eacute;dicacer son livre de 250 pages.<br />\n&quot;A tous ceux que cela titille,je leur dis de prendre la route&quot; se plait &agrave; dire Herv&eacute;.<br />\n<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/leduc_2.jpg\" />', 2017, 'ANIM', 1, '2017-03-04 11:54:39', NULL),
(72, 'Gagnant Tombola', 'Heureuse gagnante en 2016 : Sandrine BONNET de ST NAZAIRE qui part avec un VTT neuf marque TREK de chez &quot;Terre de Cycle&quot;, La Baule<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/gagnant_tombola_2016.jpg\" />', 2016, 'ANIM', 1, '2016-03-04 11:59:11', NULL),
(73, 'Tombola', 'Pendant l&#39;&eacute;dition 2016, chaque acheteur, vendeur ou visiteur pourra s&#39;il le souhaite participer &agrave; la tombola gratuite de la Bourse aux V&eacute;los pour gagner un tr&egrave;s beau VTT 26 pouces NEUF de chez &quot;Terre de Cycle&quot; &agrave; La Baule.<br />\nTirage au sort le dimanche soir vers 17h30.<br />\n<br />\n<a href=\"Images/animations/tombola_flyer_2016.pdf\" target=\"_blank\"><img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/tombola_prize_2016.png\" /></a>', 2016, 'ANIM', 1, '2016-03-04 12:03:36', NULL),
(74, 'Rencontres', '<div><img alt=\"\" height=\"121\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/meeting_place.jpg\" style=\"float:right\" width=\"121\" /></div>\n<br />\nPr&eacute;sence des clubs v&eacute;los nazairiens durant toute la bourse<br />\nVenez rencontrer des repr&eacute;sentants des clubs qui sauront vous renseigner sur leur activit&eacute;s.<br />\nClubs pr&eacute;sents: OCN; CRI; AVS; SNBC.<br />\n<br />\nUne invit&eacute;e sp&eacute;ciale vous pr&eacute;sentera son aventure &agrave; grande &eacute;chelle<br />\n&nbsp;\n<div style=\"text-align:justify\"><img alt=\"\" height=\"87\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/cri.jpg\" width=\"87\" /><img alt=\"\" height=\"88\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/avs.jpg\" width=\"88\" /><img alt=\"\" height=\"75\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/snbc.jpg\" width=\"75\" /></div>\n', 2016, 'ANIM', 1, '2016-03-04 11:05:59', NULL),
(75, 'Sandrine LAPORAL', '<img alt=\"\" height=\"129\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/canada_2016.png\" style=\"float:right\" width=\"150\" /><br />\nLicenci&eacute;e &agrave; la FFCT, Sandrine LAPORAL a v&eacute;cu une exp&eacute;rience qui fera r&ecirc;ver plus d&rsquo;un(e) cyclotouriste. Venez nombreux<br />\nSandrine pr&eacute;sentera une conf&eacute;rence le dimanche &agrave; La Bourse aux V&eacute;los (horaires &agrave; d&eacute;finir).<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/sandrinelaporal_2016.png\" />', 2016, 'ANIM', 1, '2016-02-04 12:11:49', NULL),
(76, 'La concertation v&eacute;lo &agrave; St Nazaire', '<img alt=\"\" height=\"122\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/stnazaire_logo.jpg\" style=\"float:right\" width=\"236\" />Vous trouverez en plus cette ann&eacute;e un stand ville de St Nazaire pour vous informer dans le cadre de la concertation sur le plan &quot;v&eacute;lo&quot; dans la ville. Vous pourrez lors de votre passage dialoguer avec les responsables sur les d&eacute;placements doux.<br />\n<br />\nVoir sur le &nbsp;site de la <a href=\"http://www.mairie-saintnazaire.fr/404/404-saintnazaire.php\" target=\"_blank\">ville</a> la concertation.', 2016, 'ANIM', 1, '2016-01-05 11:51:30', NULL),
(77, 'Gagnant Tombola', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/gagnant_tombola_2015.jpg\" style=\"float:right\" />\nHeureux gagnant en 2015 : M. Thomas NAEL de ST NAZAIRE qui part avec un VTT neuf marque TREK de chez Bike Earth, St Nazaire', 2015, 'ANIM', 1, '2015-03-06 11:55:19', NULL),
(78, 'Tombola', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/tombola_prize_2015.jpg\" style=\"float:right\" />Pendant l&#39;&eacute;dition 2015, chaque acheteur, vendeur ou visiteur pourra s&#39;il le souhaite participer &agrave; la tombola gratuite de la Bourse aux V&eacute;los pour gagner un tr&egrave;s beau VTT 26 pouces NEUF MARQUE TREK de chez &quot;Bike Earth&quot; St Nazaire. Tirage au sort le dimanche soir vers 17h30.', 2015, 'ANIM', 1, '2015-03-05 11:56:25', NULL),
(79, 'Ch&egrave;que au m&eacute;c&eacute;nat chirurgie cardiaque', '<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/mecenat_lg.jpg\" />', 2014, 'ANIM', 1, '2014-03-05 11:58:49', NULL),
(80, 'Gagnant Tombola', 'Le VTT (valeur 529 &euro;) qui a &eacute;t&eacute; gagn&eacute; lors de la Bourse aux V&eacute;los 2014 a &eacute;t&eacute; remis &agrave; la gagnante devant le magasin Bike Earth en pr&eacute;sence des membres du bureau de l&#39;ATLANTIQUE VELO SPORT.<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/gagnant_tombola_2014-lg.jpg\" />', 2014, 'ANIM', 1, '2014-03-05 12:01:34', NULL),
(81, 'Paul Correc', '<img alt=\"\" height=\"566\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/paul_correcof_2_sm.jpg\" width=\"400\" /><br />\nPaul CORREC sera pr&eacute;sent samedi et dimanche apr&egrave;s-midi dans l&#39;enceinte de la soucoupe &agrave; l&#39;occasion de la Bourse aux V&eacute;los pour pr&eacute;senter son ouvrage consacr&eacute; &agrave; un si&egrave;cle de cyclisme &agrave; St Nazaire.<br />\nA cette occasion, vous pourrez achetez ce livre et le faire d&eacute;dicacer par l&#39;auteur. Cette ouvrage est publi&eacute; par l&#39;Association Pr&eacute;historique et Historique de la R&eacute;gion Nazairienne.', 2014, 'ANIM', 1, '2014-02-05 12:02:51', NULL),
(82, 'Gagnant Tombola', 'Heureux gagnant en 2013 : M. THOMAS de GUERANDE qui part avec un nouveau VTT 26&quot; de chez Bike Earth, St Nazaire<br />\n<img alt=\"\" height=\"266\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/gagnant_tombola_2013_2.jpg\" width=\"400\" />', 2013, 'ANIM', 1, '2013-02-04 12:04:23', NULL),
(83, 'Bruno LEZIN', 'Bruno LEZIN que l&#39;on ne pr&eacute;sente plus sur St Nazaire. Il a suivi de nombreux Tour de France. Il a &eacute;crit un livre sur le tour et il pr&eacute;sente de nombreux objets revues et visuels de la grande boucle ainsi que des maillots prestigieux ayant appartenus &agrave; des stars du v&eacute;lo.<br />\n<img alt=\"\" height=\"300\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/lezin.jpg\" width=\"400\" />', 2013, 'ANIM', 1, '2013-01-05 12:05:41', NULL),
(84, 'Daniel COUDE', 'Originaire de Tour, grand habitu&eacute; de la bourse aux v&eacute;los de St NAZAIRE, il est un grand collectionneur de v&eacute;los. Il nous en pr&eacute;sentera quelques uns et vous fera partager sa passion.<br />\n<img alt=\"\" height=\"300\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/coude.jpg\" width=\"400\" />', 2013, 'ANIM', 1, '2013-01-05 12:06:09', NULL),
(85, 'Jean THEIL', 'Passionn&eacute; de v&eacute;lo et de son histoire, habitant Pr&eacute;failles, il nous pr&eacute;sentera sur une quinzaine de grilles des tableaux qu&#39;il a confectionn&eacute;s lui m&ecirc;me et qui retracent l&#39;histoire de la petite reine.<br />\n<img alt=\"\" height=\"266\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/theil.jpg\" width=\"400\" />', 2013, 'ANIM', 1, '2013-01-05 12:06:34', NULL),
(86, 'Heureuse gagnante en 2012', 'Sylvie MARIN de SAINT NAZAIRE qui part avec un nouveau VTC 29&quot; de chez Intersport Trignac<br />\n<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/gagnant_tombola_2012-lg.jpg\" />', 2012, 'ANIM', 1, '2012-03-05 12:08:43', NULL),
(87, 'Gagnant Tombola', 'En 2011, J&eacute;rome ROBERT de St Nazaire a gagn&eacute; un VTC neuf<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/gagnant_tombola_2011.jpg\" />', 2011, 'ANIM', 1, '2011-03-05 12:09:13', NULL),
(91, 'Rencontrez le club v&eacute;lo Nazarien OCN', 'Pr&eacute;sence des membres du club v&eacute;lo OCN pendant la bourse aux v&eacute;los - venez les rencontrer sur place.<br />\r\n<img alt=\"\" height=\"463\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/logo_ocn_2018.png\" width=\"591\" /> <a href=\"Images/animations/flyer_ocn_2018.pdf\" target=\"_blank\">Visualiser la presentation</a>', 2019, 'ANIM', 1, '2019-03-04 11:46:32', NULL),
(92, 'Bruno LEZIN', 'Bruno LEZIN que l&#39;on ne pr&eacute;sente plus sur St Nazaire. Il a suivi de nombreux Tour de France. Il a &eacute;crit un livre sur le tour et il pr&eacute;sente de nombreux objets revues et visuels de la grande boucle ainsi que des maillots prestigieux ayant appartenus &agrave; des stars du v&eacute;lo.<br />\r\n<img alt=\"\" height=\"300\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/lezin.jpg\" width=\"400\" />', 2019, 'ANIM', 0, '2013-01-05 12:05:41', NULL),
(93, 'VOL DE VELOS', '<p>Pr&egrave;s de 500 000 v&eacute;los ont &eacute;t&eacute; d&eacute;clar&eacute;s vol&eacute;s en France en 2016, soit 1 369 v&eacute;los par jour.</p>\r\n\r\n<p>Venez rencontrer des b&eacute;n&eacute;voles de l&#39;association&nbsp;Place au Velo&nbsp;pour mieux vous prot&eacute;ger contre le vol de v&eacute;los<img alt=\"\" height=\"395\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/logo_place_au_velo.png\" width=\"577\" /><br />\r\n<br />\r\n<a href=\"./Images/animations/flyer_vol_de_velo.pdf\" target=\"_blank\">&nbsp;Visualiser la presentation</a></p>\r\n', 2019, 'ANIM', 1, '2019-09-16 09:08:30', NULL),
(95, 'Bonjour, j&#39;ai plusieurs v&eacute;los &agrave; vendre. Existe t il un nombre maximal de d&eacute;pots par vendeur ?', 'Bonjour&nbsp;<br />\nNon il n&#39;existe pas de limite au&nbsp; nombre de v&eacute;los, mais si vous d&eacute;posez plus de&nbsp; v&eacute;los, contactez nous bourse1000velos@avs44.com pour mettre en place la proc&eacute;dure &quot;gros vendeur&quot;..<br />\ncdt<br />\n&nbsp;', 2019, 'FAQ', 1, '2023-10-20 11:37:20', NULL),
(96, 'Tombola 2019', '<p>Tombola ouverte &agrave; tous: VTT superbe de chez &quot;<a href=\"https://www.terredecycle.com/\" target=\"_blank\">Terre de Cycle</a>&quot; &agrave; La Baule. Dimitri qui vous pr&eacute;sente le vtt 29 pouces 2019 et qui fera parti des nombreux b&eacute;n&eacute;voles qui seront pr&eacute;sents &agrave; la Soucoupe pour vous aider &agrave; choisir votre v&eacute;lo</p>\n\n<img alt=\"\" height=\"400\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/783eb41b.jpg\" />', 2019, 'ANIM', 1, '2019-10-17 05:05:17', NULL),
(97, 'Tombola', '<p>Tombola ouverte &agrave; tous: VTT superbe de chez &quot;<a href=\"https://www.terredecycle.com/\" target=\"_blank\">Terre de Cycle</a>&quot; &agrave; La Baule. Dimitri qui vous pr&eacute;sente le vtt 29 pouces 2020 et qui fera parti des nombreux b&eacute;n&eacute;voles qui seront pr&eacute;sents &agrave; la Soucoupe pour vous aider &agrave; choisir votre v&eacute;lo</p>', 2020, 'ANIM', 1, '2020-07-03 12:10:37', NULL),
(98, 'Tombola', '<p>Tombola ouverte &agrave; tous: Cette ann&eacute;e 2 v&eacute;los a gagner</p>\n\n<ul>\n	<li>VTT de chez <a href=\"https://www.facebook.com/terredecycle/\" target=\"_blank\">&quot;Terre de Cycle&quot;</a> &agrave; La Baule.</li>\n	<li>V&eacute;lo enfant de chez Leclerc Saint Nazaire.</li>\n</ul>\n\n<p><a href=\"http://avs44.com/bourseauxvelos/downloads/2021Reglement_tombola_BAV.pdf\" target=\"_blank\">R&egrave;glement Tombola</a><br />\n<br />\n<br />\n<img alt=\"\" height=\"128\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/849983a3.jpg\" width=\"228\" /><img alt=\"\" height=\"125\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/832fccc4.jpg\" width=\"167\" /><br />\n<br />\n&nbsp;</p>', 2021, 'ANIM', 1, '2021-11-08 12:42:51', NULL),
(101, 'Venez d&eacute;courvrir l&#39;AVS organisateur de l&#39;ev&egrave;nement', '', 2021, 'ANIM', 0, '2021-06-29 18:37:51', NULL),
(102, 'CycloMag Octobre 2021', '&nbsp;\n<div><a href=\"https://cyclotourisme-mag.com/2021/10/05/bourse-aux-1-000-velos-de-saint-nazaire/?fbclid=IwAR2bSQ9s8b51e05yFh7PndO1VKYJwehoDhqtx39IVGaurkvkncH2Vt_zLlg\" target=\"_blank\"><img alt=\"cycloMag 10/2021\" height=\"307\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/815bdb58.jpg\" width=\"400\" /></a></div>\n&nbsp;', 2021, 'PRESSE', 1, '2021-10-22 12:42:10', NULL),
(103, 'Ouest France du 05/11/2021', '<img alt=\"\" height=\"271\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/8202fef0.jpg\" width=\"300\" />', 2021, 'PRESSE', 1, '2021-11-05 19:41:26', NULL),
(104, 'Presse Oc&eacute;an le 06/11/2021&nbsp;', '<img alt=\"\" height=\"315\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/859279c5.jpg\" width=\"400\" />', 2021, 'PRESSE', 1, '2021-11-08 10:36:43', NULL),
(105, '<em><strong>L&#39; ACTU DES SPORTS</strong></em>', '<img alt=\"\" height=\"435\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/86a3c376.jpg\" width=\"400\" />', 2021, 'PRESSE', 1, '2021-11-12 17:56:58', NULL),
(106, 'Ouest France le 10/11/2019', '<img alt=\"\" height=\"314\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/886a5bbd.jpg\" width=\"400\" />', 2019, 'PRESSE', 1, '2021-11-16 20:25:56', NULL),
(107, 'Presse Oc&eacute;an du 16/11/2021', '<img alt=\"\" height=\"505\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/89d913e4.jpg\" width=\"300\" />', 2021, 'PRESSE', 1, '2021-11-16 20:22:10', NULL),
(108, 'Presse Oc&eacute;an 20/11/2021', '<img alt=\"\" height=\"418\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/904e1110.jpg\" width=\"300\" />', 2021, 'PRESSE', 1, '2021-11-21 15:14:48', NULL),
(109, 'Presse Oc&eacute;an du 22/11/2021', '<a href=\"https://www.ouest-france.fr/pays-de-la-loire/saint-nazaire-44600/saint-nazaire-un-quasi-record-pour-la-bourse-aux-1-000-velos-de-la-soucoupe-ad573362-4ae6-11ec-8a6b-582d17cbe42b\" target=\"_blank\"><img alt=\"\" height=\"236\" src=\"http://avs44.com/bourseauxvelos/ckeditorUploads/91583c66.jpg\" width=\"400\" /></a>', 2021, 'PRESSE', 1, '2021-11-24 07:30:02', NULL),
(110, 'Tombola<br />\n&nbsp;', '<p>Tombola ouverte &agrave; tous: Cette ann&eacute;e 2 v&eacute;los a gagner</p>\n\n<ul>\n	<li>VTT de chez <a href=\"https://www.facebook.com/terredecycle/\" target=\"_blank\">&quot;Terre de Cycle&quot;</a> &agrave; La Baule.</li>\n	<li>V&eacute;lo enfant de chez Leclerc Saint Nazaire.</li>\n</ul>\n\n<p><a href=\"https://bourseaux1000velos.avs44.com/?page=reglements.php&modePage=T\" target=\"_blank\">R&egrave;glement Tombola</a><br />\n<br />\n<br />\n&nbsp;</p>', 2022, 'ANIM', 1, '2022-10-04 19:36:46', NULL),
(111, 'Place aux v&eacute;los Estuaire', 'L&#39;association des cyclistes urbains de Saint-Nazaire, la Bri&egrave;re, la Presqu&#39;&icirc;le Gu&eacute;randaise et Sud Estuaire.<br />\nSera pr&eacute;sente samedi pour le&nbsp;gravage v&eacute;los antivol.<br />\n<br />\n<a href=\"https://www.facebook.com/PlaceauveloSaintNazaire/\" target=\"_blank\">https://www.facebook.com/PlaceauveloSaintNazaire/</a>', 2022, 'ANIM', 1, '2022-10-04 08:55:00', NULL),
(112, 'Ouest france 25/10/2022', '<a href=\"https://www.ouest-france.fr/pays-de-la-loire/saint-nazaire-44600/saint-nazaire-1-000-velos-a-vendre-a-la-soucoupe-en-novembre-8ff27ee8-53ba-11ed-b0ae-cbfffe64e014?utm_medium=Social&amp;utm_source=Facebook&amp;fbclid=IwAR0XWKR4ma3NFC58VmJY7YOUTIXqREcj4EQAbjSpAE8xS0lIbCDXmHvM8rU#Echobox=1666694305\" target=\"_blank\"><img alt=\"\" height=\"244\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/92bd775b.png\" width=\"400\" /><br />\nouest france 25/10/2022</a><br />\n&nbsp;', 2022, 'PRESSE', 1, '2022-10-26 10:07:25', NULL),
(113, 'Saint Nazaire news 11/10/2022', '<div><a href=\"https://www.saintnazairenews.fr/news/saint-nazaire-18e-edition-de-la-bourse-aux-1000-velos-a-la-soucoupe\" target=\"_blank\"><img alt=\"\" height=\"310\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/9371e5b1.png\" width=\"300\" /></a></div>', 2022, 'PRESSE', 1, '2022-10-26 12:29:17', NULL),
(114, 'Tous &agrave; v&eacute;lo - Les bons conseils pour faciliter vos d&eacute;placements &agrave; v&eacute;lo.', '<div><a href=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/95f3da16.jpg\" onclick=\"window.open(this.href, \'\', \'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=500\'); return false;\"><img alt=\"\" height=\"143\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/95f3da16.jpg\" width=\"401\" /></a></div>\n&nbsp;\n\n<div><a href=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/94e58fe0.jpg\" onclick=\"window.open(this.href, \'\', \'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=500\'); return false;\"><img alt=\"\" height=\"143\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/94e58fe0.jpg\" width=\"401\" /></a></div>', 2022, 'ANIM', 1, '2022-10-31 15:01:12', NULL),
(115, 'Presse Oc&eacute;an 10/11/2022', '<div><a href=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/96af5039.png\" onclick=\"window.open(this.href, \'\', \'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,height=500\'); return false;\"><img alt=\"\" height=\"400\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/96af5039.png\" width=\"198\" /></a></div>', 2022, 'PRESSE', 1, '2022-11-10 10:18:00', NULL),
(116, 'Bonjour, peut on envoyer une connaissance pour r&eacute;cup&eacute;rer les v&eacute;los invendus le dimanche soir ou c est obligatoirement le vendeur en personne qui devra se pr&eacute;senter?<br />\nMerci &agrave; vous.', '<p>Bonjour<br />\nNon cela peut &ecirc;tre une autre personne, mais avec obligatoirement le coupon de d&eacute;p&ocirc;t.<br />\nCdt.<br />\n&nbsp;</p>', 0, 'FAQ', 1, '2024-07-26 09:58:55', NULL),
(118, 'Ouest France 21/11/2022', '<div><a href=\"https://www.ouest-france.fr/pays-de-la-loire/saint-nazaire-44600/saint-nazaire-un-quasi-record-pour-la-bourse-aux-1-000-velos-de-la-soucoupe-ad573362-4ae6-11ec-8a6b-582d17cbe42b\" target=\"_blank\"><img alt=\"\" height=\"251\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/972e74eb.jpg\" width=\"400\" /></a></div>', 2022, 'PRESSE', 1, '2022-11-24 12:59:01', NULL),
(119, 'Gagnants de laTombola 2022', 'L&#39;heureuse vainqueur du VTT de la Tombola<br />\n<img alt=\"\" height=\"300\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/9846acf2.jpg\" width=\"400\" /><br />\nLes gagnants du v&eacute;lo Leclerc<br />\n<img alt=\"\" height=\"300\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/100032354.jpg\" width=\"400\" />', 2022, 'ANIM', 1, '2022-12-05 07:51:31', NULL),
(120, 'Ouest france 19/11/2022', '<iframe src=\"//www.ultimedia.com/deliver/generic/iframe/mdtk/01124706/src/q5mz5lf/zone/86/showtitle/1/\" frameborder=\"0\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"0\" hspace=\"0\" vspace=\"0\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\" allowfullscreen=\"true\"width=\"400\" height=\"260\" allow=\"autoplay; fullscreen\"></iframe>', 2022, 'PRESSE', 1, '2022-11-24 15:19:55', NULL),
(121, 'L&#39;Echo de la Presqu&#39;ile 11/2022', '<div><a href=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/9908d9d2.jpg\" target=\"_blank\"><img alt=\"\" height=\"799\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/9908d9d2.jpg\" width=\"400\" /></a></div>', 2022, 'PRESSE', 1, '2022-11-28 10:18:01', NULL),
(122, 'Ouest France du 18/11/2022', '<img alt=\"\" height=\"723\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/101e8473c.jpg\" width=\"400\" />', 2022, 'PRESSE', 1, '2022-12-11 18:09:00', NULL),
(123, 'Presse Oc&eacute;an 12/11/2022', '<img alt=\"\" height=\"533\" src=\"https://bourseaux1000velos.avs44.com/ckeditorUploads/102e57c8b.jpg\" width=\"500\" />', 2022, 'PRESSE', 1, '2022-12-11 18:15:49', NULL),
(126, 'Bonjour,<br />\nFaut il vous envoyer la fiche de d&eacute;pot remplie et sign&eacute;e dans la case vendeur avant la date du 17 novembre 2023 ?', '<p>Bonjour</p>\n\n<p>Non la fiche est a remettre le jour du d&eacute;p&ocirc;t du v&eacute;lo.<br />\nCdt<br />\n&nbsp;</p>', 2023, 'FAQ', 1, '2023-10-20 11:38:31', NULL),
(127, 'Saint Nazaire News', '<a href=\"https://www.saintnazairenews.fr/news/saint-nazaire-bourse-aux-1000-velos-bientot-20-ans-et-toujours-autant-de-bonnes-affaires\" target=\"_blank\"><img alt=\"\" src=\"downloads/stnaznez_20221018.pnp\" width=\"300\" /></a>', 2023, 'PRESSE', 1, '2023-10-20 13:55:22', NULL),
(132, 'Presse Oc&eacute;an le 27 octobre 2023', '<img alt=\"\" src=\"./downloads/presseOcean20231027.jpg\" width=\"400\" />', 2023, 'PRESSE', 1, '2023-10-27 09:29:33', NULL),
(133, '<p>Bonjour, faut&#39;il d&eacute;poser le v&eacute;lo avec des p&eacute;dales?<br />\nJ&#39;aimerai conserver les miennes.</p>', 'Oui il vaut mieux que les v&eacute;los disposent de p&eacute;dales pour permettre au futur acheteur de l&#39;essayer.', 2023, 'FAQ', 1, '2023-11-25 07:26:08', 'al1aoustin@gmail.com'),
(134, 'Bonjour<br />\nJe trouve votre proc&eacute;dure de pr&eacute;-d&eacute;pot tr&egrave;s pratique. Bravo &agrave; toute votre &eacute;quipe de b&eacute;n&eacute;voles.<br />\nLe fait d&#39;afficher d&eacute;ja les v&eacute;los pr&eacute;d&eacute;pos&eacute;s sur Face book est un petit plus de cette ann&eacute;e je crois.<br />\nContinuez&nbsp; &agrave; d&eacute;veloper votre Bourse, ca devient la Bourse la plus importante de France, je pense.<br />\nA ce week-end<br />\nMadeleine', NULL, 2023, 'FAQ', 1, '2023-11-20 12:57:52', 'chris.pierre2@gmail.com'),
(135, 'Bonjour&nbsp;<br />\nEst il possible de modifier le prix de son v&eacute;lo pendant ce week-end ? (baisser le prix de vente pour avoir plus de chance de le vendre). Merci&nbsp;', '<p>Oui, mais pour cela il vous faut venir &agrave; la Bourse aux v&eacute;los afin de localiser votre v&eacute;lo dans le parc et ensuite demander aux organisateurs de faire la modification du prix.</p>\n\n<p>Sachant que le prix de la fiche reste le prix de r&eacute;f&eacute;rence.</p>', 2023, 'FAQ', 1, '2023-11-25 07:25:40', 'monsieurbeaudouin@gmail.com'),
(137, 'Ouest France 16/11/2023', '<div><a href=\"https://www.ouest-france.fr/pays-de-la-loire/saint-nazaire-44600/la-bourse-aux-1-000-velos-de-saint-nazaire-propose-t-elle-vraiment-mille-bicyclettes-a-la-vente-c5900776-830e-11ee-aabe-38ea97092852\"><img alt=\"\" height=\"302\" src=\"./downloads/OuestFrance20231116.png\" width=\"400\" /></a></div>', 2023, 'PRESSE', 1, '2023-11-20 10:55:40', NULL),
(138, 'Presse Oc&eacute;an le 20/11/2023', '<div><a href=\"https://nantes.maville.com/actu/actudet_-saint-nazaire.-suite-et-fin-de-la-bourse-aux-velos-ce-dimanche-_8-5511947_actu.H\" target=\"_blank\"><img alt=\"\" height=\"473\" src=\" ./downloads/presseOcean20231120.png\" width=\"400\" /></a></div>', 2023, 'PRESSE', 1, '2023-11-20 10:59:27', NULL),
(139, 'Ouest france 20/11/2023', '<div><a href=\"https://www.ouest-france.fr/pays-de-la-loire/saint-nazaire-44600/a-la-soucoupe-de-saint-nazaire-4-000-visiteurs-ont-profite-de-la-bourse-aux-velos-f2b96c1a-8705-11ee-9632-b62f00689e79\" target=\"_blank\"><img alt=\"\" height=\"341\" src=\"./downloads/ouestFrance20231120.png\" width=\"400\" /></a></div>\n&nbsp;', 2023, 'PRESSE', 1, '2023-11-20 14:41:15', NULL),
(140, 'Gagnants tombola 2023', '<img alt=\"\" height=\"169\" src=\"./downloads/20231119_171033.jpg\" width=\"300\" /><img alt=\"\" height=\"169\" src=\" ./downloads/20231121_095741.jpg\" width=\"300\" />', 2023, 'ANIM', 1, '2023-12-06 15:56:09', NULL),
(141, 'Bonjour, comment proc&eacute;der pour le pr&eacute;- d&eacute;p&ocirc;t ?', '<p>A partir du 1er novembre vous pourrez vous connecter sur ce site afin de commencer la proc&eacute;dure.</p>\n\n<p>Tout est expliqu&eacute;, proc&eacute;dure d&#39;identification , informations &agrave;&nbsp;renseigner.&nbsp;</p>\n\n<ul>\n	<li>&nbsp;&nbsp;&nbsp;Il n&#39;est pas n&eacute;cessaire de conna&icirc;tre le prix de vente,&nbsp;vous pourrez le renseigner le jour du d&eacute;p&ocirc;t.</li>\n	<li>&nbsp;&nbsp;&nbsp;Vous acc&eacute;derez au d&eacute;p&ocirc;t le vendredi &agrave; la Soucoupe via des files prioritaires.</li>\n	<li>&nbsp;&nbsp;&nbsp;Vous pouvez &eacute;galement modifier votre compte.</li>\n	<li>&nbsp;&nbsp;&nbsp;Vous recevez un mail directement lorsque votre v&eacute;lo est vendu.</li>\n	<li>&nbsp;&nbsp;&nbsp;Cette fiche d&eacute;p&ocirc;t devra &ecirc;tre&nbsp;imprim&eacute;e par vous&nbsp;pour vous rendre &agrave; la Bourse, une par d&eacute;p&ocirc;t.</li>\n</ul>\n<br />\nCdt', 2024, 'FAQ', 1, '2024-10-25 15:48:03', 'anne.oushka@gmail.com'),
(142, 'Presse Oc&eacute;ran du 18/10/2024', '<img alt=\"\" src=\"./downloads/PresseOcean18102024.jpeg\n\" width=\"400\" />', 2024, 'PRESSE', 1, '2024-10-18 07:15:53', NULL),
(143, 'Bonjour.&nbsp; J aimerait savoir s&#39;il est possible d&eacute;pos&eacute; juste des roues v&eacute;lo route carbone avec pneus tubeless , jantes 88mn ? Merci&nbsp;', 'Oui, vous pouvez d&eacute;poser des roues avec les pneus associ&eacute;s. Il faut bien rendre le lot compact, en reliant les roues et pneus, s&#39;ils ne sont pas mont&eacute;s, avec des colliers de serrage.<br />\nCdt<br />\nLe bureau de la BAV', 2024, 'FAQ', 1, '2024-10-25 15:52:09', 'blemasson1966@gmail.com'),
(145, 'Tombola', '<p>Tombola ouverte &agrave; tous: Cette ann&eacute;e 2 v&eacute;los a gagner</p>\n\n<ul>\n	<li>VTT de chez <a href=\"https://www.facebook.com/terredecycle/\" target=\"_blank\">&quot;Terre de Cycle&quot;<img alt=\"\" height=\"225\" src=\"./downloads/tombola_2_2024.jpg\" width=\"400\" /></a></li>\n	<li>V&eacute;lo enfant de chez Leclerc Saint Nazaire.<img alt=\"\" height=\"225\" src=\"./downloads/tombola_1_2024.jpg\" width=\"400\" /></li>\n</ul>\n\n<p><a href=\"https://bourseaux1000velos.avs44.com/?page=reglements.php&amp;modePage=T\" target=\"_blank\">R&egrave;glement Tombola</a><br />\n<br />\n&nbsp;</p>', 2024, 'ANIM', 1, '2024-11-07 13:00:11', NULL),
(146, 'L&#39;OCN vous proposera un grand d&eacute;fi pour enfant et adulte sur Home trainer.', '<img alt=\"OCN\" height=\"177\" src=\"./downloads/pasteImage1730964110814.png\" width=\"400\" />', 2024, 'ANIM', 1, '2024-11-07 12:55:29', NULL),
(147, 'Bruno LEZIN', 'Bruno LEZIN que l&#39;on ne pr&eacute;sente plus sur St Nazaire. Il a suivi de nombreux Tour de France. Il a &eacute;crit un livre sur le tour et il pr&eacute;sente de nombreux objets revues et visuels de la grande boucle ainsi que des maillots prestigieux ayant appartenus &agrave; des stars du v&eacute;lo.<br />\n<img alt=\"\" height=\"300\" src=\"./downloads/lezin.jpg.crdownload\" width=\"400\" />', 2024, 'ANIM', 1, '2024-11-07 12:57:33', NULL),
(149, 'Je ne suis pas l&agrave; dimanche, est-il possible de r&eacute;cup&eacute;rer son v&eacute;lo lundi s&#39;il n&#39;est pas vendu ?', 'Non, car nous ne diposons pas de stockage, et nous devons lib&eacute;rer la Soucoupe le dimanche soir.<br />\nCdt', 2024, 'FAQ', 1, '2024-11-27 05:58:07', 'yann.vigneron@laposte.net'),
(150, 'Bonjour,&nbsp;<br />\npouvez-vous m&#39;aider &agrave; estimer mon v&eacute;lo ?&nbsp;<br />\nmerci', 'Le jour du d&eacute;pot des personnes seront l&agrave; pour vous aider a estimer votre v&eacute;lo.<br />\n&nbsp;', 2024, 'FAQ', 1, '2024-11-27 16:29:42', 'fgconand@wanadoo.fr'),
(151, 'Presse Oc&eacute;an', '<img alt=\"\" height=\"400\" src=\"./downloads/PO_20241127.jpg\" width=\"455\" />', 2024, 'PRESSE', 1, '2024-11-29 08:57:29', NULL),
(152, 'presse', '<img alt=\"\" height=\"400\" src=\" ./downloads/presse_20241128.png\" width=\"360\" />', 2024, 'PRESSE', 1, '2024-11-29 08:57:27', NULL);
INSERT INTO `bav_actu` (`act_id`, `act_titre`, `act_text`, `act_numero_bav`, `act_type`, `act_active`, `act_date`, `act_mail`) VALUES
(153, 'Bonjour&nbsp;<br />\nQuels sont les moyens de paiement accept&eacute;s ?<br />\nMerci', 'Pour le r&egrave;glement du d&eacute;pot de 4&euro; et de la comission du vendeur de 10%, cela peut s&#39;effectuer par carte, ch&egrave;que ou liquide.<br />\nPour l&#39;achat d&#39;un v&eacute;lo c&#39;est uniquement en ch&egrave;que ou liquide, car cette somme revient directement au vendeur.<br />\n<br />\n&nbsp;', 2024, 'FAQ', 1, '2025-09-25 17:55:49', 'vaillantnathalie13@gmail.com'),
(155, 'Ouest france 01/12/2024', '<img alt=\"\" height=\"400\" src=\"./downloads/OF_01122004.jpg\" width=\"251\" />', 2024, 'PRESSE', 1, '2024-12-03 12:40:23', NULL),
(156, 'France 3 Pays de la Loire , d&eacute;cembre 2024', '&nbsp;\n<div><a href=\"https://www.france.tv/france-3/pays-de-la-loire/ici-19-20-pays-de-la-loire/6686249-emission-du-dimanche-1-decembre-2024.html\" target=\"_blank\"><img alt=\"\" height=\"232\" src=\"./downloads/france3.jpg\" width=\"400\" /></a></div>\n<br />\nA partir d&#39; 1&#39;30', 2024, 'PRESSE', 1, '2024-12-03 12:45:23', NULL),
(157, 'Gagnants Tombola 2024', '<img alt=\"\" height=\"207\" src=\"./downloads/tombola_2024_2.jpg\" width=\"368\" /><br />\n<img alt=\"\" height=\"205\" src=\"./downloads/tombola_2024_1.jpg\" width=\"363\" />', 2024, 'ANIM', 1, '2024-12-04 14:24:35', NULL),
(158, 'Ouest france le 01/12/2024', '<img alt=\"\" height=\"400\" src=\" ./downloads/OF_20241201.png\" width=\"429\" />', 2024, 'PRESSE', 1, '2024-12-05 07:41:02', NULL),
(160, 'Pr&eacute;sence des membres du club v&eacute;lo OCN pendant la bourse aux v&eacute;los - venez les rencontrer sur place', '<img alt=\"OCN\" height=\"177\" src=\"./downloads/pasteImage1730964110814.png\" width=\"400\" />', 2025, 'ANIM', 1, '2025-09-26 06:21:11', NULL),
(161, 'Tombola&nbsp;', 'V&eacute;lo de la tombola <a href=\"https://www.facebook.com/terredecycle/\" target=\"_blank\">&quot;Terre de Cycle&quot;<img alt=\"vélo tombola TDC\" src=\"./downloads/tombola_TDC_2025.jpg\" width=\"400\" /></a><br />\nUn v&eacute;lo enfant offert par le Leclerc de Saint Nazaire<br />\n<img alt=\"Vélo enfant tombola\" src=\"./downloads/velo_enf_tombola_2025.png\" width=\"400\" />', 2025, 'ANIM', 1, '2025-10-20 09:04:20', NULL),
(162, 'Bonjour, pour 2025 j&#39;ai not&eacute; les dates du 14, 15 ,16 Novembre :&nbsp;<br />\nLe Pr&eacute;-d&eacute;p&ocirc;t est-il commenc&eacute; depuis le 1er Octobre comme indiqu&eacute; dans la Foire aux Questions ?<br />\nSi OUI, quels sont les jours et horaires pour ce pr&eacute;-d&eacute;p&ocirc;t ?', 'Bonjour<br />\nPour l&#39;ann&eacute;e 2025 le pr&eacute;-d&eacute;pot va ouvrir &agrave; partir du 20 octobre 2025 jusqu&#39;au jeudi 13 Novembre 2025 &agrave; 17h.<br />\nCdt<br />\nLe Bureau', 2025, 'FAQ', 1, '2025-10-13 12:13:24', 'viviane.gautier@free.fr'),
(163, 'Bonjour,<br />\nPeut on apporter un v&eacute;lo appartement ?<br />\nMerci bonne journ&eacute;e<br />\nDominique', '<p>Bonjour<br />\nCa arrive quelques fois qu&#39;on nous d&eacute;pose des v&eacute;los d&#39;appartement, mais c&#39;est rare.</p>\n\n<p>cdt</p>', 2025, 'FAQ', 1, '2025-10-15 07:12:41', 'sidonie8585@hotmail.fr'),
(164, 'Bonjour,<br />\nj&#39;ai plusieurs v&eacute;los de course vintage de qualit&eacute; a vendre, en &eacute;tat bien s&ucirc;r et dans leur jus. Y a t&#39;il un rayon vintage ?<br />\nEt est il possible de mettre des tenues en vente avec ?<br />\nMerci de votre r&eacute;ponse. Jl85&nbsp;', '<p>Bonjour</p>\n\n<p>Il n&#39;y a pa de rayon vintage, mais ca peut se faire.</p>\n\n<p>Pas de tenues mises en ventes, uniquement des v&eacute;los ou gros equipements (roues, remorques)&nbsp;.</p>\n\n<p>Cdt</p>', 2025, 'FAQ', 1, '2025-10-21 08:48:13', 'jl85@orange.fr'),
(165, 'Saint-Nazaire Agglo', '<img alt=\"\" height=\"566\" src=\"./downloads/1511 soucoupe.png\" width=\"400\" />', 2025, 'ANIM', 1, '2025-10-20 15:14:04', NULL),
(166, 'Bruno Lezin', 'Bruno LEZIN que l&#39;on ne pr&eacute;sente plus sur St Nazaire. Il a suivi de nombreux Tour de France. Il a &eacute;crit un livre sur le tour et il pr&eacute;sente de nombreux objets revues et visuels de la grande boucle ainsi que des maillots prestigieux ayant appartenus &agrave; des stars du v&eacute;lo.<br />\n<img alt=\"\" height=\"300\" src=\"./downloads/lezin.jpg.crdownload\" width=\"400\" />', 2025, 'ANIM', 1, '2025-10-20 15:15:00', NULL),
(168, 'La Baule &agrave; V&eacute;lo', '<img alt=\"\" height=\"382\" src=\"./downloads/visuel marquage vélo BAV.png\" width=\"400\" />', 2025, 'ANIM', 1, '2025-10-22 15:24:01', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bav_avis`
--

DROP TABLE IF EXISTS `bav_avis`;
CREATE TABLE `bav_avis` (
  `avs_id` int(11) NOT NULL,
  `avs_note` int(11) DEFAULT NULL,
  `avs_commentaire` varchar(200) DEFAULT NULL,
  `avs_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avs_numero_bav` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bav_avis`
--

INSERT INTO `bav_avis` (`avs_id`, `avs_note`, `avs_commentaire`, `avs_date`, `avs_numero_bav`) VALUES
(27, 5, 'Super organisation avec des bénévoles en nombre super accueillants . Bravo à tous !', '2024-11-30 09:06:52', '2024'),
(28, 5, '', '2024-11-30 09:07:02', '2024'),
(29, 5, '', '2024-11-30 09:07:25', '2024'),
(30, 5, '', '2024-11-30 09:46:43', '2024'),
(31, 5, 'Orga au top! 1 vélo vendu, 1 velo plus grand acheté dans la journée, que demander de plus!!', '2024-11-30 11:18:21', '2024'),
(32, 5, 'bravo,tres bien organisé , bon accueuil ,bon conseils ,a faire connaitre autour de nous merci a l\'asso organisatrice.', '2024-11-30 18:20:19', '2024'),
(33, 5, 'Très bonne organisation qui fait partie des incontournables attendus du bassin nazairiens Bravo aux bénévoles très nombreux qui nous accueillent avec patience et gentillesse Je recommande', '2024-12-01 07:43:42', '2024'),
(34, 5, '', '2024-12-01 07:44:29', '2024'),
(35, 5, 'Super organisation', '2024-12-01 07:44:55', '2024'),
(36, 5, '', '2024-12-01 07:47:41', '2024'),
(37, 5, 'Organisation Incroyable bravo à tous et à l%u2019année prochaine', '2024-12-01 07:49:58', '2024'),
(38, 5, '', '2024-12-01 08:01:45', '2024'),
(39, 5, 'Super ! Très bonne organisation !', '2024-12-01 10:15:30', '2024'),
(40, 5, '', '2024-12-01 11:17:41', '2024'),
(41, 5, 'Super conseils des techniciens, très disponibles, dame à l achat hyper sympa.', '2024-12-01 11:51:02', '2024'),
(42, 5, '', '2024-12-01 13:00:24', '2024'),
(43, 5, 'Super organisation \nPersonnes adorables de l\'entrée à la sortie.\nCHAPEAU À VOUS TOUTES ET TOUS.', '2024-12-01 13:02:01', '2024'),
(44, 5, 'Superbe organisation, bravo à vous.', '2024-12-01 14:52:22', '2024'),
(45, 5, 'Tres bonne ambiance,merci', '2024-12-01 16:20:54', '2024'),
(46, 4, '', '2024-12-02 02:11:59', '2024'),
(47, 5, 'Magnifique organisation. Accueil au top et efficacité.', '2024-12-02 12:53:58', '2024'),
(48, 5, '', '2024-12-02 14:41:43', '2024'),
(49, 5, '', '2024-12-03 19:00:22', '2024'),
(50, 5, '', '2024-12-04 06:14:12', '2024'),
(51, 5, '', '2024-12-04 06:49:49', '2024'),
(52, 5, 'Organisation au top !', '2024-12-04 16:22:36', '2024'),
(53, 5, 'Très bon moment, bonne organisation.... à l\'année prochaine !', '2024-12-06 15:33:01', '2024'),
(54, 5, 'Belle organisation, vélos disposés très clairement.\nAvec une équipe pour faire les derniers petits réglages.\nEn résumé une organisation au top.', '2024-12-10 11:05:45', '2024'),
(55, 1, 'Decu le velo qui m\'a ete vendu n\'est pas a ma taille \nJe vais etre oblige de le revendre sans etre sur d\'y arriver sue un marche de l\'occasion saturé \nIl faudrait plus de professionnels competents pou', '2024-12-12 12:07:35', '2024'),
(56, 1, 'J\'ai achete  700 euros un velo trop petit pour moi\nsuite aux mauvais conseils d\'un technicien present\nDonc tres déçu de cette bourse aux velos\nJe ne suis meme pas sur de pouvoir revendre mon achat', '2024-12-12 17:50:12', '2024'),
(57, 5, 'Organisation top. Ainsi que les conseils des bénévoles. À l%u2019écoute des goûts, besoins et budget. J%u2019ai trouvé un vélo qui correspond à mes attentes.  Changements de pneus à prévoir. Réglages ', '2024-12-17 11:02:59', '2024'),
(58, 5, 'A quand la prochaine ? On a hâte', '2025-05-08 12:16:54', '2024');

-- --------------------------------------------------------

--
-- Structure de la table `bav_client`
--

DROP TABLE IF EXISTS `bav_client`;
CREATE TABLE `bav_client` (
  `cli_id` bigint(20) UNSIGNED NOT NULL,
  `cli_id_modif` varchar(35) NOT NULL,
  `cli_nom` varchar(100) NOT NULL,
  `cli_emel` varchar(100) DEFAULT NULL,
  `cli_adresse` varchar(100) DEFAULT NULL,
  `cli_adresse1` varchar(100) DEFAULT NULL,
  `cli_code_postal` varchar(10) DEFAULT NULL,
  `cli_ville` varchar(100) DEFAULT NULL,
  `cli_telephone` varchar(15) DEFAULT NULL,
  `cli_telephone_bis` varchar(15) DEFAULT NULL,
  `cli_taux_com` decimal(10,2) NOT NULL,
  `cli_prix_depot` decimal(10,2) NOT NULL,
  `cli_id_cre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bav_client`
--

INSERT INTO `bav_client` (`cli_id`, `cli_id_modif`, `cli_nom`, `cli_emel`, `cli_adresse`, `cli_adresse1`, `cli_code_postal`, `cli_ville`, `cli_telephone`, `cli_telephone_bis`, `cli_taux_com`, `cli_prix_depot`, `cli_id_cre`) VALUES
(1, '4040e35284bdf5405cb3070134d900a7', 'Vendeur 2019', 'bourseauxvelosV2019@avs.com', NULL, NULL, NULL, NULL, NULL, NULL, '10.00', '3.00', 0),
(2, '2eef1be7ce272b7089400619618b1637', 'Acheteur 2019', 'bourseauxvelosA2019@avs.com', '', '', '', '', '', '', '10.00', '3.00', 0),
(3, '52df4bc606eaddf149390506ab8cd73f', 'Vendeur 2021', 'bourseauxvelosV2021@avs.com', '', '', '', '', '', '', '10.00', '3.00', 0),
(4, '0b894c49a867df1b790d8d8c37bdf16e', 'Acheteur 2021', 'bourseauxvelosA2021@avs.com', '', '', '', '', '', '', '10.00', '3.00', 0),
(5, '1d9dc5d01174efa146031b68a38761aa', 'Acheteur 2022', 'bourseauxvelosV2022@avs.com', '', '', '', '', '', '', '10.00', '3.00', 0),
(6, 'a1ca58ffe9a3f0118dc85ec596229079', 'Vendeur 2022', 'bourseauxvelosA2022@avs.com', '', '', '44600', '', '', '', '10.00', '3.00', 0),
(7, '1d9dc5d01174efa148031b68a38761ab', 'Vendeur 2023', 'bourseauxvelosV2023@avs.com', '', '', '', '', '', '', '10.00', '3.00', 0),
(8, 'a1ca58ffe9a3f0117dc85ec59622907b', 'Acheteur 2023', 'bourseauxvelosA2023@avs.com', '', '', '', '', '', '', '10.00', '3.00', 0),
(9, '74cd006ce37f8c4e72dc64034943a730', 'VENDEUR 2024', 'bourseauxvelosV2024@avs.com', '', '', '', '', '', '', '10.00', '4.00', 0),
(10, '54930284891fe633bac51405ef285d1b', 'ACHETEUR 2024', 'bourseauxvelosA2024@avs.com', '', '', '', '', '', '', '10.00', '4.00', 0),
(29, 'c8a16e0afb5f193e0db31b344f6f2643', 'MARC GARCÈS', 'marc.garces@free.fr', '2, rue des judelles', '', '44117', 'Saint André des Eaux', '06 81 62 96 71', '', '5.00', '0.00', 17),
(6461, '7b4d997e67f121150a9b679a86257280', 'S', NULL, NULL, NULL, '', NULL, '', NULL, '10.00', '4.00', 0),
(6462, '95be4e2879fb4f3900858ed1af2cbd31', 'MONIQUE LAVRUT', 'mlavrut@laposte.net', '33 Rue de la Commune de Paris', '', '44600', 'Saint-Nazaire', '0638265706', '', '10.00', '4.00', 0),
(6463, '032d520f54b2d33d47798037a75e617f', 'JEAN-MARIE TALON', 'jean-marie.talon@wanadoo.fr', '7 rue du clos marconnet', '', '49400', 'VARRAINS', '0684017662', '', '10.00', '4.00', 13),
(6464, '2b84ee13b3180581c3b4ed4744e8dcf1', 'GUIHAL OLIVIER', 'steffy.pierre@gmail.com', '9 RUE ARTHUR RIMBAUD', '', '44600', 'Saint-Nazaire', '0668357955', '', '5.00', '0.00', 12),
(6465, '143d442305aaada3211b461d40d9c2d7', 'CHRISTIAN MOINARD', 'christian.moinard@gmail.com', '7 rue du paradis', '', '44350', 'GUERANDE', '0644095749', '', '10.00', '4.00', 12),
(6466, '7b222c9dd7362b761fa4bb5d4d9d2ea3', 'CHAPALAIN VINCENT', 'vincent.chapalain@gmail.com', '45 rue amiral Courbet', '', '56100', 'Lorient', '0623602683', '', '10.00', '4.00', 14),
(6467, 'dfdfe23bc66886b72e4c566079b0d30a', 'THEUDE ANNIE', 'atheude@orange.fr', '70 B route de Guindreff', '', '44600', 'Saint Nazaire', '0677291493', '0609895149', '10.00', '4.00', 15),
(6468, 'ef768c56f227644701b863b65ae895d1', 'VINCENT GUILLAUME', 'vincent.g2b@gmail.com', '7 RUE DES SAPINSVincent GUILLAUME', '', '44600', 'ST NAZAIRE', '06.2471.7315', '', '10.00', '4.00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `bav_creneau`
--

DROP TABLE IF EXISTS `bav_creneau`;
CREATE TABLE `bav_creneau` (
  `cre_id` int(11) NOT NULL,
  `cre_debut` datetime NOT NULL,
  `cre_fin` datetime NOT NULL,
  `cre_numero_bav` varchar(10) CHARACTER SET latin1 COLLATE latin1_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bav_creneau`
--

INSERT INTO `bav_creneau` (`cre_id`, `cre_debut`, `cre_fin`, `cre_numero_bav`) VALUES
(1, '2024-11-29 17:00:00', '2024-11-29 17:30:00', '2024'),
(2, '2024-11-29 17:30:00', '2024-11-29 18:00:00', '2024'),
(3, '2024-11-29 18:30:00', '2024-11-29 19:00:00', '2024'),
(4, '2024-11-29 19:30:00', '2024-11-29 20:00:00', '2024'),
(5, '2024-11-29 18:00:00', '2024-11-29 18:30:00', '2024'),
(6, '2024-11-29 19:00:00', '2024-11-29 19:30:00', '2024'),
(8, '2024-11-30 08:00:00', '2024-11-30 10:00:00', '2024'),
(9, '2024-11-30 10:00:00', '2024-11-30 12:00:00', '2024'),
(10, '2024-11-30 12:00:00', '2024-11-30 18:00:00', '2024'),
(12, '2025-11-14 17:00:00', '2025-11-14 17:30:00', '2025'),
(13, '2025-11-14 17:30:00', '2025-11-14 18:00:00', '2025'),
(14, '2025-11-14 18:00:00', '2025-11-14 18:30:00', '2025'),
(15, '2025-11-14 18:30:00', '2025-11-14 19:00:00', '2025'),
(16, '2025-11-14 19:00:00', '2025-11-14 19:30:00', '2025'),
(17, '2025-11-14 19:30:00', '2025-11-14 20:00:00', '2025'),
(26, '2025-11-15 08:00:00', '2025-11-15 10:00:00', '2025'),
(27, '2025-11-15 10:00:00', '2025-11-15 12:00:00', '2025'),
(28, '2025-11-15 12:00:00', '2025-11-15 18:00:00', '2025');

-- --------------------------------------------------------

--
-- Structure de la table `bav_modif_prix`
--

DROP TABLE IF EXISTS `bav_modif_prix`;
CREATE TABLE `bav_modif_prix` (
  `mop_id_obj` int(11) NOT NULL,
  `mop_date_demande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mop_date_validation` timestamp NULL DEFAULT NULL,
  `mop_prix_demande` decimal(10,2) NOT NULL,
  `mop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bav_modif_prix`
--

INSERT INTO `bav_modif_prix` (`mop_id_obj`, `mop_date_demande`, `mop_date_validation`, `mop_prix_demande`, `mop_id`) VALUES
(1942, '2020-03-09 19:14:00', '2020-03-09 19:14:39', '100.00', 1),
(1580, '2019-11-28 19:37:32', '2019-11-28 21:13:43', '45.00', 9),
(1126, '2019-11-28 20:41:43', '2019-11-28 21:00:01', '65.00', 20),
(1126, '2019-11-28 21:03:48', NULL, '60.00', 21);

-- --------------------------------------------------------

--
-- Structure de la table `bav_parametre`
--

DROP TABLE IF EXISTS `bav_parametre`;
CREATE TABLE `bav_parametre` (
  `par_numero_bav` varchar(10) NOT NULL,
  `par_taux_1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_taux_2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_taux_3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_prix_depot_1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_prix_depot_2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_prix_depot_3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_client_date_debut` date NOT NULL,
  `par_client_date_fin` date NOT NULL,
  `par_admin_id_mac` varchar(600) DEFAULT NULL,
  `par_titre` varchar(100) DEFAULT NULL,
  `par_nb_modif` int(11) NOT NULL DEFAULT '0',
  `par_date_debut_depot` date NOT NULL,
  `par_date_debut_vente` date NOT NULL,
  `par_date_fin_bav` date NOT NULL,
  `par_actif` tinyint(1) NOT NULL DEFAULT '0',
  `par_vue_parc` tinyint(1) NOT NULL DEFAULT '0',
  `par_nb_eti_page` int(11) NOT NULL,
  `par_numero_base_info` int(11) NOT NULL,
  `par_nb_coupon_page` int(11) DEFAULT NULL,
  `par_temps_depot` int(11) NOT NULL DEFAULT '4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bav_parametre`
--

INSERT INTO `bav_parametre` (`par_numero_bav`, `par_taux_1`, `par_taux_2`, `par_taux_3`, `par_prix_depot_1`, `par_prix_depot_2`, `par_prix_depot_3`, `par_client_date_debut`, `par_client_date_fin`, `par_admin_id_mac`, `par_titre`, `par_nb_modif`, `par_date_debut_depot`, `par_date_debut_vente`, `par_date_fin_bav`, `par_actif`, `par_vue_parc`, `par_nb_eti_page`, `par_numero_base_info`, `par_nb_coupon_page`, `par_temps_depot`) VALUES
('2019', '10.00', '5.00', '0.00', '3.00', '1.00', '0.00', '2019-08-01', '2020-12-10', '::1', 'La 16eme bourse aux 1000 velos', 3, '2019-11-08', '2019-11-09', '2019-11-10', 0, 0, 6, 700, 5, 4),
('2020', '10.00', '5.00', '0.00', '3.00', '1.00', '0.00', '2020-01-01', '2020-01-09', '::1', 'Annulé COVID', 3, '2020-11-06', '2020-11-07', '2020-11-08', 0, 0, 6, 801, 5, 4),
('2021', '10.00', '5.00', '0.00', '3.00', '1.00', '0.00', '2021-10-25', '2021-11-21', 'localhost, 127:0:0:1, ::1', '17eme Bourse aux 1000 Velos', 0, '2021-11-19', '2021-11-20', '2021-11-21', 0, 0, 5, 1001, 5, 4),
('2022', '10.00', '5.00', '0.00', '3.00', '1.00', '0.00', '2022-10-17', '2022-11-18', 'localhost, 127:0:0:1, ::1', '18eme Bourse aux 1000 velos', 0, '2022-11-18', '2022-11-19', '2022-11-20', 0, 0, 5, 1001, 6, 4),
('2023', '10.00', '5.00', '10.00', '3.00', '0.00', '3.00', '2023-10-01', '2023-11-16', 'localhost, 127:0:0:1, ::1', '19eme Bourse aux 1000 Velos', 50, '2023-11-17', '2023-11-18', '2023-11-19', 0, 1, 5, 1001, 6, 4),
('2024', '10.00', '5.00', '10.00', '4.00', '0.00', '4.00', '2024-11-01', '2024-11-28', 'localhost, 127:0:0:1, ::1', '20eme Bourse aux 1000 vélos', 50, '2024-11-29', '2024-11-30', '2024-12-01', 0, 1, 5, 1001, 6, 3),
('2025', '10.00', '5.00', '10.00', '4.00', '0.00', '4.00', '2025-10-20', '2025-11-13', 'localhost, 127:0:0:1, ::1', '21eme Bourse aux 1000 vélos', 50, '2025-11-14', '2025-11-15', '2025-11-16', 1, 0, 5, 1001, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `bav_users`
--

DROP TABLE IF EXISTS `bav_users`;
CREATE TABLE `bav_users` (
  `uid` int(3) UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `username` varchar(15) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `bav_users`
--

INSERT INTO `bav_users` (`uid`, `name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', 'fcc2704ec6043daf93f0f4b113844369');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bav_actu`
--
ALTER TABLE `bav_actu`
  ADD PRIMARY KEY (`act_id`);

--
-- Index pour la table `bav_avis`
--
ALTER TABLE `bav_avis`
  ADD PRIMARY KEY (`avs_id`),
  ADD KEY `bac_counter_access_cas_libelle_IDX` (`avs_note`) USING BTREE,
  ADD KEY `bav_counter_access_cas_numero_bav_IDX` (`avs_numero_bav`) USING BTREE;

--
-- Index pour la table `bav_client`
--
ALTER TABLE `bav_client`
  ADD PRIMARY KEY (`cli_id`),
  ADD KEY `cli_nom` (`cli_nom`);

--
-- Index pour la table `bav_creneau`
--
ALTER TABLE `bav_creneau`
  ADD PRIMARY KEY (`cre_id`);

--
-- Index pour la table `bav_modif_prix`
--
ALTER TABLE `bav_modif_prix`
  ADD PRIMARY KEY (`mop_id`);

--
-- Index pour la table `bav_parametre`
--
ALTER TABLE `bav_parametre`
  ADD PRIMARY KEY (`par_numero_bav`);

--
-- Index pour la table `bav_users`
--
ALTER TABLE `bav_users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bav_actu`
--
ALTER TABLE `bav_actu`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT pour la table `bav_avis`
--
ALTER TABLE `bav_avis`
  MODIFY `avs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `bav_client`
--
ALTER TABLE `bav_client`
  MODIFY `cli_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6469;

--
-- AUTO_INCREMENT pour la table `bav_creneau`
--
ALTER TABLE `bav_creneau`
  MODIFY `cre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `bav_modif_prix`
--
ALTER TABLE `bav_modif_prix`
  MODIFY `mop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `bav_users`
--
ALTER TABLE `bav_users`
  MODIFY `uid` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
