-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  db2463.1and1.fr
-- Généré le :  Lun 05 Août 2019 à 07:06
-- Version du serveur :  5.5.60-0+deb7u1-log
-- Version de PHP :  7.0.33-0+deb9u3

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
-- Structure de la table `bav_actu`
--

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
-- Contenu de la table `bav_actu`
--

INSERT INTO `bav_actu` (`act_id`, `act_titre`, `act_text`, `act_numero_bav`, `act_type`, `act_active`, `act_date`, `act_mail`) VALUES
(1, 'Est-ce qu&#39;il faut remplir un formulaire pour s&rsquo;inscrire &agrave; l&#39;avance ou peux t&#39;on simplement se pr&eacute;senter avec notre v&eacute;lo sans inscription pr&eacute;alable ?', 'Les deux solutions sont possibles. Dans l&#39;onglet &quot;T&eacute;l&eacute;chargements&quot; vous trouverez un exemplaire du formulaire que vous pouvez remplir &agrave; l&#39;avance pour vous faire gagner du temps sur place.<br />\nSinon, tous les formulaires sont mis &agrave; votre disposition sur place.<br />\n<span style=\"background-color:#2ecc71\">**N&#39;oubliez pas votre pi&egrave;ce d&#39;identit&eacute;.**</span>', 2019, 'FAQ', 1, '2010-07-26 07:47:47', 'notsupplied@notsupplied.com'),
(18, 'Presse Oc&eacute;an - Octobre 2017', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/6583b5a.png\" />', 2017, 'PRESSE', 1, '2019-02-05 10:14:28', NULL),
(19, 'Estuaire Hebdo - Octobre 2017', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/473e0ec.png\" />', 2017, 'PRESSE', 1, '2019-02-05 10:15:18', NULL),
(20, 'Ouest France - 07/11/2016', '<div><a href=\"http://avs44.com/BAV/ckeditorUploads/7f23bcc.jpg\" target=\"_blank\"><img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/7f23bcc.jpg\" /></a></div>\n', 2016, 'PRESSE', 1, '2019-02-05 10:15:46', NULL),
(21, 'Presse Oc&eacute;an - 07/11/2016', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/5c52007.jpg\" />', 2016, 'PRESSE', 1, '2019-02-05 10:20:25', NULL),
(22, 'Ouest France - 06/11/2016', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/8d8d613.jpg\" />', 2016, 'PRESSE', 1, '2016-11-26 10:21:49', NULL),
(23, 'Ouest France - 04/11/2016', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/9a82cca.jpg\" />', 2016, 'PRESSE', 1, '2019-02-05 10:23:11', NULL),
(24, 'Echo de la Prequ&#39;&icirc;le - 04/11/2016', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/114eb167.jpg\" />', 2016, 'PRESSE', 1, '2019-02-05 10:25:20', NULL),
(25, 'Presse Oc&eacute;an - 31/10/2016', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/10227624.jpg\" />', 2016, 'PRESSE', 1, '2019-02-05 10:26:55', NULL),
(26, 'Presse Oc&eacute;an - 09/11/2015', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/1135e0c8.png\" />', 2015, 'PRESSE', 1, '2019-02-05 10:30:13', NULL),
(27, 'Presse Oc&eacute;an - 09/11/2015', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/124f9fb1.jpg\" />', 2015, 'PRESSE', 1, '2019-02-05 10:42:14', NULL),
(28, 'Ouest France - 08/11/2015', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/14f1f302.jpg\" /><br />\n<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/137d849b.jpg\" />', 2015, 'PRESSE', 1, '2019-02-05 10:44:00', NULL),
(29, 'Presse Oc&eacute;an - 03/11/2015', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/15044672.jpg\" />', 2015, 'PRESSE', 1, '2019-02-05 10:45:38', NULL),
(30, 'Ouest France - 04/11/2015', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/164d11b9.jpg\" />', 2015, 'PRESSE', 1, '2019-02-05 10:46:46', NULL),
(31, 'Ouest France - 04/11/2015', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/17c11448.jpg\" />', 2015, 'PRESSE', 1, '2019-02-05 10:48:58', NULL),
(32, 'Ouest France - 18/11/2018', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/182e7897.jpg\" />', 2018, 'PRESSE', 1, '2019-02-05 10:53:06', NULL),
(33, 'PRESSE OC&Eacute;AN - D&Eacute;CEMBRE 2014', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/198b7d55.jpg\" />', 2014, 'PRESSE', 1, '2019-02-06 10:43:29', NULL),
(37, 'Tombola', '<img alt=\"\" height=\"115\" src=\"http://localhost/BAV/ckeditorUploads/terre_de_cycle_logo.png\" width=\"396\" /><br />\nPendant l&#39;&eacute;dition 2018, chaque acheteur, vendeur ou visiteur pourra s&#39;il le souhaite participer &agrave; la tombola gratuite de <strong>la Bourse aux V&eacute;los </strong>pour gagner un tr&egrave;s beau VTT NEUF de chez &quot;<strong>Terre de Cycle</strong>&quot; &agrave; La Baule.<br />\nTirage au sort le dimanche soir vers 17h30.<br />\n<br />\n==&gt;&nbsp;<a href=\"http://avs44.com/BAV/downloads/reglement_tombola.pdf\" target=\"_blank\">reglement de la tombola</a>', 2018, 'ANIM', 1, '2019-02-07 12:02:48', NULL),
(38, 'Bruno Robineau, cr&eacute;ateur de v&eacute;los miniatures faits main', '&nbsp;\n<table cellpadding=\"1\" cellspacing=\"1\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td><img alt=\"\" height=\"128\" src=\"http://avs44.com/BAV/ckeditorUploads/velodubonheur.png\" width=\"200\" /></td>\n			<td><img alt=\"\" height=\"127\" src=\"http://localhost/BAV/ckeditorUploads/velos_decoratifs_2018.jpg\" width=\"189\" /></td>\n		</tr>\n	</tbody>\n</table>\n<br />\nBruno ROBINEAU participera &agrave; notre bourse aux v&eacute;los, ne manquez pas de visiter son stand.<br />\nEn plus d&rsquo;une large gamme de plus de 20 v&eacute;los miniatures faits main avec un seul fil , il y pr&eacute;sentera ses r&eacute;cits de voyage : Huit ans autour du monde, Compostelle en famille, Roumanie vagabonde.<br />\n&nbsp;<a href=\"http://avs44.com/BAV/Images/animations/velos_miniatures_2018.pdf\">Plus d&#39;informations</a>', 2018, 'ANIM', 1, '2019-02-07 11:13:23', NULL),
(41, 'Est-ce qu&#39;il y a des cars qui desservent La Soucoupe de Saint Nazaire en partant de St Nazaire/La Gare SNCF ?', 'Effectivement, il y a de nombreux bus qui d&eacute;servent la gare et La Soucoupe ou est organis&eacute;e la bourse.<br />\nPrenez qu&rsquo;un aller simple car il se peut que vous repartiez avec le v&eacute;lo de vos r&ecirc;ves&hellip;!', 2019, 'FAQ', 1, '2010-07-26 07:42:59', 'notsupplied@notsupplied.com'),
(42, 'Est-ce que les v&eacute;los de course seront accept&eacute;s ?', 'Tous les v&eacute;los sont accept&eacute;s dont les v&eacute;los de course &agrave; condition qu&#39;ils soient en &eacute;tat de rouler.', 2019, 'FAQ', 1, '2010-07-26 07:50:21', 'notsupplied@notsupplied.com'),
(43, 'Je recherche un v&eacute;lo pour mon fils de 7 ans 1/2 qui mesure 1m29, entrejambe 58 cm, dois je prendre un 20 ou un 24 pouces sachant qu&rsquo;il grandisse vite &agrave; cet age l&agrave;.<br />\nC&#39;est un cadeau donc je ne peux l&rsquo;enmener avec moi.<br />\nJe voudrais trouver un v&eacute;lo en tr&egrave;s bonne &eacute;tat,peut on trouver &ccedil;a dans votre manifestation pour un prix r&eacute;sonnable ?', 'Nous ne pouvons &agrave; cette heure conna&icirc;tre le choix que nous aurons cette ann&eacute;e mais les autres ann&eacute;es, il y avait ce que vous cherchez.<br />\nLe mieux, c&rsquo;est de nous rendre visite d&egrave;s le samedi matin fin de matin&eacute;e au moment o&ugrave; il y a plus de choix. Nos vendeurs b&eacute;n&eacute;voles vous conseilleront.', 2019, 'FAQ', 1, '2010-07-26 07:54:07', 'notsupplied@notsupplied.com'),
(44, 'Je suis absent le samedi; est il possible de d&eacute;poser le v&eacute;lo que je veux vendre la veille au soir au gymnase? ou bien alors le dimanche matin?<br />\nEn vous remerciant pour votre r&eacute;ponse.', '<span style=\"background-color:#f39c12\">NOUVEAU depuis 2013&nbsp;: </span>Pour &eacute;viter l&rsquo;affluence du samedi matin nous commen&ccedil;ons les d&eacute;p&ocirc;ts (Uniquement les d&eacute;p&ocirc;ts) d&egrave;s le vendredi de 18h &agrave; 21h00 m&ecirc;me lieu La Soucoupe gard&eacute;e la nuit.', 2019, 'FAQ', 1, '2010-10-15 08:16:22', 'r.dupain@voila.fr'),
(45, 'Faut&#39;il r&eacute;cup&eacute;rer imp&eacute;rativement le v&eacute;lo le dimanche soir ou possibilit&eacute;&nbsp;le lundi matin ?', 'Malheureusement, nous devons lib&eacute;rer la salle le dimanche soir donc nous n&#39;avons pas la possibilit&eacute; de stocker les v&eacute;los non-vendus. Il est donc imp&eacute;ratif de r&eacute;cup&eacute;rer le v&eacute;lo le dimanche soir au plus tard.', 2019, 'FAQ', 1, '2010-10-25 08:39:46', 'cricri.doudou@free.fr'),
(46, 'Si je depose le velo samedi matin dois je le recuperer le soir pour le redeposer le dimanche', 'Non, il n&#39;est pas n&eacute;cessaire de r&eacute;cup&eacute;rer votre v&eacute;lo et red&eacute;poser. Nous assurons la s&eacute;curit&eacute; des v&eacute;los d&eacute;pos&eacute;s pendant les deux journ&eacute;es de la bourse aux v&eacute;los y compris la nuit.', 2019, 'FAQ', 1, '2010-11-04 10:30:51', 'guy.rivallin@orange.fr'),
(47, 'Y a-t-il une garantie sur les v&eacute;los ?', 'Il y a une garantie seulement si le v&eacute;lo que vous ach&eacute;terez est encore sous garantie (cela arrive assez souvent). C&#39;est le cas de v&eacute;los achet&eacute;s r&eacute;cemment ne correspondant pas au besoin du propri&egrave;taire qui d&eacute;cide tr&egrave;s vite de profiter de la bourse et ses 5000 &agrave; 6000 visiteurs pour le revendre.', 2019, 'FAQ', 1, '2012-05-05 02:55:15', 'phil.frary@nthdimension.fr'),
(48, 'Est-il possible d&#39;&eacute;changer si on se trompe ?', 'Nous n&#39;avons jamais eu le cas mais si l&#39; acheteur constate tr&eacute;s vite (pendant le week-end) un probl&egrave;me de fonctionnement nous reprenons le v&eacute;lo et nous le sortons de la vente.', 2019, 'FAQ', 1, '2012-05-05 02:55:33', 'phil.frary@nthdimension.fr'),
(49, 'Quels sont les moyens de paiement ?', 'Par ch&egrave;que (carte d&#39;identit&eacute; demand&eacute;e) ou en num&eacute;raires. Nous ne pouvons utiliser de TPE car les ch&egrave;ques de l&#39;acheteur sont &eacute;mis &agrave; l&#39;ordre du vendeur.', 2019, 'FAQ', 1, '2012-05-05 02:55:51', 'phil.frary@nthdimension.fr'),
(50, 'Peut-on payer en plusieurs fois ?', 'Si nous avons cette demande , nous contactons par t&eacute;l&eacute;phone le vendeur qui lui seul d&eacute;cide mais nous avons toujours eu des r&eacute;ponses favorables &agrave; cette requ&ecirc;te pour des v&eacute;los de plus de 1000 &euro;', 2019, 'FAQ', 1, '2012-05-05 02:56:14', 'phil.frary@nthdimension.fr'),
(51, 'Est-il possible d&#39;essayer les v&eacute;los sur place ?', 'Les essais se font uniquement dans La Soucoupe pour des raison de s&eacute;curit&eacute; (vol). Une partie de cette tr&egrave;s grande salle est r&eacute;serv&eacute;e aux essais.<br />\nLes vendeurs de l&#39;association AVS sont l&agrave; pour vous conseiller.', 2019, 'FAQ', 1, '2012-05-05 02:56:28', 'phil.frary@nthdimension.fr'),
(52, 'Y a-t-il des v&eacute;los pour les enfants ?', 'Chaque ann&eacute;e, c&#39;est le coin qui bouge le plus car les enfants adorent essayer leurs nouveaux v&eacute;los. Nous en avons &agrave; tous les prix suivant leur &eacute;tat mais tous roulent tr&egrave;s bien.', 2019, 'FAQ', 1, '2012-05-05 02:56:42', 'phil.frary@nthdimension.fr'),
(53, 'Est-ce que c&rsquo;est &agrave; l&rsquo;abri ?', 'La Bourse aux v&eacute;los de l&#39;AVS est organis&eacute;e tous les ans et ce depuis novembre 2004 date de la 1ere &eacute;dition dans le gymnase (40x20) de St Marc sur Mer. Les v&eacute;los sont pr&eacute;sent&eacute;s sur des barri&egrave;res prot&eacute;g&eacute;es par de la mousse. Depuis l&#39;ann&eacute;e 2014, c&#39;est &agrave; La SOUCOUPE avenue L&eacute;o Lagrange St Nazaire. C&#39;est beaucoup plus grand (voir les photos sur ce site).', 2019, 'FAQ', 1, '2012-05-05 02:57:01', 'phil.frary@nthdimension.fr'),
(54, 'Je viens d&#39;apprendre l&#39;existence de votre bourse &agrave; v&eacute;los et je suis &agrave; la recherche d&#39;une paire de roues de v&eacute;lo de course.<br />\nEst-ce qu&#39;il y en aura &agrave; vendre d&#39;occasions ou bien votre club en revend-il ?', 'Chaque ann&eacute;e des paires de roues sont d&eacute;pos&eacute;es et elles trouvent acheteurs.<br />\nRDV &agrave; la 16eme &eacute;dition La Soucoupe de SAINT NAZAIRE LES 9 et 10 novembre 2019', 2019, 'FAQ', 1, '2013-04-13 08:19:53', 'chris.pierre2@sfr.fr'),
(55, 'Qui fixe le prix de vente des v&eacute;los pr&eacute;sent&eacute;s?', 'Apr&egrave;s avoir rempli la &quot;fiche d&eacute;p&ocirc;t&quot;, si le vendeur le souhaite, les &quot;estimeurs&quot; de l&#39;organisation sont &agrave; sa disposition pour fixer le &quot;bon&quot; prix.<br />\n&eacute;anmoins, c&#39;est le vendeur qui inscrit son prix de vente et il est le seul d&eacute;cideur.', 2019, 'FAQ', 1, '2013-10-29 18:22:07', 'phil.frary@nthdimension.fr'),
(56, 'J&#39;aimerais vendre mon v&eacute;lo &agrave; assistance &eacute;lectrique. Les VAE sont-ils les bienvenus lors de votre bourse aux v&eacute;los de St-Nazaire et en vendez-vous ?', 'L&#39;ann&eacute;e pass&eacute;e (2018), nous avions eu 4 v&eacute;los &eacute;lectriques &agrave; vendre, et 3 sont partis et donc ont trouv&eacute; preneur.<br />\nSoyez donc la bienvenue, beaucoup de personnes que je rencontre sont tr&egrave;s attir&eacute;e par ce genre de v&eacute;lo.<br />\nAttention &agrave; ne pas &ecirc;tre trop gourmande sur le prix!', 2019, 'FAQ', 1, '2013-10-29 18:41:24', 'phil.frary@nthdimension.fr'),
(57, 'bonjour, y a t&#39;il des remorques pour v&eacute;lo &agrave; vendre &agrave; la bourse aux v&eacute;los?', 'Bonjour<br />\nSi vous voulez parler de remorque qui s&rsquo;accrochent &agrave; des v&eacute;los: oui Benjamin, nous en avions plusieurs (une petite dizaine) en 2013. Elles sont toutes parties sauf une qui n&#39;&eacute;tait pas tr&egrave;s r&eacute;cente.<br />\nSi ce sont des remorques pour installer des v&eacute;los: non!<br />\nPar contre, nous avons eu &agrave; la vente des portes-v&eacute;los (4 v&eacute;los)<br />\nRdv &agrave; la Soucoupe les 14 et 15 octobre 2017.<br />\nMerci de votre confiance', 2019, 'FAQ', 1, '2014-08-24 09:16:09', 'benjamin_leray@hotmail.fr'),
(58, 'Comment puis je savoir si mon v&eacute;lo d&eacute;pos&eacute; est vendu?', 'Plusieurs solutions<br />\n1- Sur place &eacute;videmment en pr&eacute;sentant votre &quot;re&ccedil;u vendeur&quot;<br />\n2- Nouveau depuis 2014: en allant sur le site Internet de la Bourse aux v&eacute;los<br />\nCliquez sur l&#39;onglet: &quot;VENTE&quot;.<br />\nRentrez votre num&eacute;ro de v&eacute;lo dans la case. La r&eacute;ponse sera instantan&eacute;e.<br />\nSolution a privil&eacute;gier!!!<br />\n3- Par t&eacute;l&eacute;phone, au num&eacute;ro indiqu&eacute; sur votre &quot;re&ccedil;u vendeur&quot;', 2019, 'FAQ', 1, '2014-08-25 15:04:52', 'christian.pierre2@sfr.fr'),
(59, 'bonjour, pouvons nous vendre des roues carbones? merci', 'Bonjour,<br />\nSi vous parcourez le r&egrave;glement de La Bourse aux v&eacute;los de St Nazaire, on exclu les accessoires. N&eacute;anmoins chaque ann&eacute;e, des personnes nous confient pour la vente des accessoires genre porte-v&eacute;los, remorques, cadres et roues.<br />\nIl y a un march&eacute; pour du gros accessoire. (Condition de vente identiques aux v&eacute;los)<br />\nA bient&ocirc;t.', 2019, 'FAQ', 1, '2014-09-30 13:10:29', 'brissier.guillaume@orange.fr'),
(60, 'bjr ! melangez vous les vtt a petit prix avec ceux qui vale au moins 1300 e , comme le mien', 'Bonjour<br />\nLes VTT comme les autres v&eacute;los sont rang&eacute;s par genre et aussi par prix. Pour les beaux VTT, nous en avons toujours &agrave; chaque &eacute;dition et des beaucoup plus chers.<br />\nA bient&ocirc;t', 2019, 'FAQ', 1, '2015-11-03 11:36:50', 'matgin.falu@sfr.fr'),
(61, 'Suis je oblig&eacute; de revenir avant le dimanche soir 19h00 pour percevoir le montant de la vente si mon v&eacute;lo est affich&eacute; &quot;vendu&quot; sur le site?<br />\nJ&#39;habite Nantes. Merci!', 'Rappel de la proc&eacute;dure &laquo; de 30 km&raquo;<br />\nLe VENDEUR demande au moment du d&eacute;p&ocirc;t du v&eacute;lo l&rsquo;adresse o&ugrave; il pourra r&eacute;cup&eacute;rer le v&eacute;lo.<br />\nApr&egrave;s avoir v&eacute;rifi&eacute; par t&eacute;l&eacute;phone ou sur le site de la BAV que son v&eacute;lo a bien &eacute;t&eacute; vendu :<br />\nLe VENDEUR enverra par la Poste dans la semaine qui suit la BAV:<br />\n- le re&ccedil;u vendeur de couleur.<br />\n- une enveloppe timbr&eacute;e r&eacute;dig&eacute;e &agrave; son nom et son adresse.<br />\n- les 10 % par ch&egrave;que &agrave; l&rsquo;ordre de l&rsquo;AVS.<br />\nD&egrave;s r&eacute;ception, l&rsquo;AVS lui enverra le ch&egrave;que remis par l&rsquo;acheteur &agrave; l&rsquo;ordre du vendeur ou un ch&egrave;que de l&rsquo;AVS si le paiement s&rsquo;est fait en liquide', 2019, 'FAQ', 1, '2016-09-11 10:19:20', 'valerie.chausson@sfr.fr'),
(62, 'Avons nous la garantie des paiements, Ne risque t-il pas de recevoir un ch&egrave;que sans provisions', 'Bonjour Christophe<br />\nC&#39;est en effet la crainte des organisateurs que nous sommes. Nous demandons une pi&egrave;ce d&#39;identit&eacute; (2 pour les v&eacute;los de plus de 1000 &euro;) &agrave; l&#39;acheteur.<br />\nDepuis 14 ans le cas ne s&#39;est jamais produit.<br />\nMalheureusement, nous ne pouvons pas utiliser de terminaux de paiements car les achats se font &agrave; l&#39;ordre du vendeur.', 2019, 'FAQ', 1, '2016-09-20 10:54:34', 'cmoreil@free.fr'),
(63, 'Bonjour,<br />\nJe souhaiterais acqu&eacute;rir un nouveau v&eacute;lo de route car sur mon vieux v&eacute;lo de route j&#39;ai des douleurs aux &eacute;paules et en bas du dos. Pour ne pas me tromper sur l&#39;achat &agrave; la bourse aux v&eacute;los, il y a-t-il des personnes pouvant conseiller la bonne posture voire faire une &eacute;tude posturale ?<br />\nMerci', 'Bonjour Bertrand<br />\nNous avons la chance d&#39;avoir des professionnels de la vente de v&eacute;lo qui sont licenci&eacute;s dans le club organisateur. Ils sont pr&eacute;sents pour conseiller nos acheteurs. Je dirais que c&#39;est un peu un des points forts de la Bourse de l&#39;AVS.<br />\nA bientot', 2019, 'FAQ', 1, '2016-10-24 09:08:37', 'bertrand.maisonneuve@orange.fr'),
(64, 'Bonjour, pour cause de d&eacute;m&eacute;nagement je souhaite me s&eacute;parer d&#39;une centaine de livres concernant le cyclisme. Est-il possible de les vendre &agrave; cette occasion?<br />\nmerci pour votre r&eacute;ponse, cordialement.', 'Bonjour Philippe<br />\nNous ne vendons pas ni les accessoires ni les livres. Nous avons d&eacute;ja la vente de plus de 1000 v&eacute;los &agrave; g&eacute;rer et il faudtrait plus encore de b&eacute;n&eacute;voles pour que l&#39;on se diversifie. Nous sommes d&eacute;ja 90 &agrave; nous relayer pendant les 3 jours.<br />\nN&eacute;anmoins appeler moi car je connais et pourrais trouver des collectionneurs qui pourraient &ecirc;tre int&eacute;ress&eacute;s. (num&eacute;ro sur le site ou l&#39;affiche)<br />\nChristian', 2019, 'FAQ', 1, '2017-09-21 09:00:51', 'philippe.branchereau@bbox.fr'),
(65, 'Bonjour,<br />\nPourriez-vous m&#39;indiquer les heures d&#39;ouverture du samedi et dimanche.<br />\nD&#39;avance merci.', '<p>Bonjour<br />\n8h00 - 19h00 les 2 jours D&eacute;p&ocirc;ts et ventes<br />\nA bientot</p>\n', 2019, 'FAQ', 1, '2017-10-04 02:34:42', 'cocosn@orange.fr'),
(66, 'Bonsoir<br />\nJe souhaite mettre un beau v&eacute;lo en vente. Y a t&#39;il des mesures de protection des v&eacute;los.', 'Merci de poser cette question.<br />\n<strong><span style=\"background-color:#f39c12\">NOUVEAUTE: En 2019</span></strong>, nous ouvrons un show room pour les beaux v&eacute;los de plus de 500 &euro;.<br />\nCela se situera dans la mezzanine au dessus du hall d&#39;entr&eacute;e.<br />\nDans cet espace les v&eacute;los seront pr&eacute;sent&eacute;s debout bien espac&eacute;s. Ils seront bien mis en &eacute;vidence sur leurs supports pour faciliter les ventes.<br />\nComme indiqu&eacute; sur notre r&egrave;glement, nous mettons tout en oeuvre pour ne pas qu&#39;il y ait de probl&egrave;me.<br />\nVoir &eacute;galement la fiche pour les tr&egrave;s beaux velos.', 2019, 'FAQ', 1, '2018-11-10 16:42:00', 'Bourgemilie@sfr.fr'),
(67, 'Rencontrez le club v&eacute;lo Nazarien OCN', 'Pr&eacute;sence des membres du club v&eacute;lo OCN pendant la bourse aux v&eacute;los - venez les rencontrer sur place.<br />\n<img alt=\"\" height=\"463\" src=\"http://avs44.com/BAV/ckeditorUploads/logo_ocn_2018.png\" width=\"591\" /> <a href=\"Images/animations/flyer_ocn_2018.pdf\" target=\"_blank\">Visualiser la presentation</a>', 2018, 'ANIM', 1, '2019-03-04 12:46:32', NULL),
(68, 'VOL DE VELOS', '<p>Pr&egrave;s de 500 000 v&eacute;los ont &eacute;t&eacute; d&eacute;clar&eacute;s vol&eacute;s en France en 2016, soit 1 369 v&eacute;los par jour.</p>\n\n<p>Venez rencontrer des b&eacute;n&eacute;voles de l&#39;association&nbsp;Place au Velo&nbsp;pour mieux vous prot&eacute;ger contre le vol de v&eacute;los<img alt=\"\" height=\"395\" src=\"http://avs44.com/BAV/ckeditorUploads/logo_place_au_velo.png\" width=\"577\" /><br />\n<br />\n<a href=\"./Images/animations/flyer_vol_de_velo.pdf\" target=\"_blank\">&nbsp;Visualiser la presentation</a></p>\n', 2018, 'ANIM', 1, '2019-03-04 12:08:30', NULL),
(69, 'Gagnant Tombola', 'Heureuse gagnante en 2017 : Sylvie MORICE de La Baule qui part avec un VTT neuf marque TREK de chez &quot;Terre de Cycle&quot;, La Baule<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/gagnant_tombola_2017.jpg\" />', 2017, 'ANIM', 1, '2017-05-04 11:52:53', NULL),
(70, 'Herv&eacute; LEDUC<br />\nDimanche 15 octobre 15h00', 'Conf&eacute;rence diaporama par Herv&eacute; Leduc.&nbsp;<br />\nApr&egrave;s Sandrine Laporal, pr&eacute;sente &agrave; la BAV 2016, qui &eacute;tait venue suite &agrave; sa travers&eacute;e du Canada &agrave; v&eacute;lo, place &agrave; une autre conf&eacute;rence d&eacute;bat.<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/leduc_1.jpg\" />', 2017, 'ANIM', 1, '2017-03-04 12:53:45', NULL),
(71, '&quot;Un homme, un v&eacute;lo, une aventure!&quot;', 'En trois mots, c&#39;est ainsi que le nazairien Herv&eacute; Leduc a coutume de r&eacute;sumer le p&eacute;riple autour du monde qu&#39;il a accompli en v&eacute;lo.<br />\nIl vous parlera lors de cette conf&eacute;rence, de son p&eacute;riple retra&ccedil;ant les 54 650 km parcourus &agrave; travers 34 pays . Il a notamment les d&eacute;serts du Thar en Inde ou le Taklamakan en Chine.<br />\nA la fin, il pourra vous d&eacute;dicacer son livre de 250 pages.<br />\n&quot;A tous ceux que cela titille,je leur dis de prendre la route&quot; se plait &agrave; dire Herv&eacute;.<br />\n<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/leduc_2.jpg\" />', 2017, 'ANIM', 1, '2017-03-04 12:54:39', NULL),
(72, 'Gagnant Tombola', 'Heureuse gagnante en 2016 : Sandrine BONNET de ST NAZAIRE qui part avec un VTT neuf marque TREK de chez &quot;Terre de Cycle&quot;, La Baule<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/gagnant_tombola_2016.jpg\" />', 2016, 'ANIM', 1, '2016-03-04 12:59:11', NULL),
(73, 'Tombola', 'Pendant l&#39;&eacute;dition 2016, chaque acheteur, vendeur ou visiteur pourra s&#39;il le souhaite participer &agrave; la tombola gratuite de la Bourse aux V&eacute;los pour gagner un tr&egrave;s beau VTT 26 pouces NEUF de chez &quot;Terre de Cycle&quot; &agrave; La Baule.<br />\nTirage au sort le dimanche soir vers 17h30.<br />\n<br />\n<a href=\"Images/animations/tombola_flyer_2016.pdf\" target=\"_blank\"><img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/tombola_prize_2016.png\" /></a>', 2016, 'ANIM', 1, '2016-03-04 13:03:36', NULL),
(74, 'Rencontres', '<div><img alt=\"\" height=\"121\" src=\"http://avs44.com/BAV/ckeditorUploads/meeting_place.jpg\" style=\"float:right\" width=\"121\" /></div>\n<br />\nPr&eacute;sence des clubs v&eacute;los nazairiens durant toute la bourse<br />\nVenez rencontrer des repr&eacute;sentants des clubs qui sauront vous renseigner sur leur activit&eacute;s.<br />\nClubs pr&eacute;sents: OCN; CRI; AVS; SNBC.<br />\n<br />\nUne invit&eacute;e sp&eacute;ciale vous pr&eacute;sentera son aventure &agrave; grande &eacute;chelle<br />\n&nbsp;\n<div style=\"text-align:justify\"><img alt=\"\" height=\"87\" src=\"http://avs44.com/BAV/ckeditorUploads/cri.jpg\" width=\"87\" /><img alt=\"\" height=\"88\" src=\"http://avs44.com/BAV/ckeditorUploads/avs.jpg\" width=\"88\" /><img alt=\"\" height=\"75\" src=\"http://avs44.com/BAV/ckeditorUploads/snbc.jpg\" width=\"75\" /></div>\n', 2016, 'ANIM', 1, '2016-03-04 12:05:59', NULL),
(75, 'Sandrine LAPORAL', '<img alt=\"\" height=\"129\" src=\"http://avs44.com/BAV/ckeditorUploads/canada_2016.png\" style=\"float:right\" width=\"150\" /><br />\nLicenci&eacute;e &agrave; la FFCT, Sandrine LAPORAL a v&eacute;cu une exp&eacute;rience qui fera r&ecirc;ver plus d&rsquo;un(e) cyclotouriste. Venez nombreux<br />\nSandrine pr&eacute;sentera une conf&eacute;rence le dimanche &agrave; La Bourse aux V&eacute;los (horaires &agrave; d&eacute;finir).<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/sandrinelaporal_2016.png\" />', 2016, 'ANIM', 1, '2016-02-04 13:11:49', NULL),
(76, 'La concertation v&eacute;lo &agrave; St Nazaire', '<img alt=\"\" height=\"122\" src=\"http://avs44.com/BAV/ckeditorUploads/stnazaire_logo.jpg\" style=\"float:right\" width=\"236\" />Vous trouverez en plus cette ann&eacute;e un stand ville de St Nazaire pour vous informer dans le cadre de la concertation sur le plan &quot;v&eacute;lo&quot; dans la ville. Vous pourrez lors de votre passage dialoguer avec les responsables sur les d&eacute;placements doux.<br />\n<br />\nVoir sur le &nbsp;site de la <a href=\"http://www.mairie-saintnazaire.fr/404/404-saintnazaire.php\" target=\"_blank\">ville</a> la concertation.', 2016, 'ANIM', 1, '2016-01-05 12:51:30', NULL),
(77, 'Gagnant Tombola', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/gagnant_tombola_2015.jpg\" style=\"float:right\" />\nHeureux gagnant en 2015 : M. Thomas NAEL de ST NAZAIRE qui part avec un VTT neuf marque TREK de chez Bike Earth, St Nazaire', 2015, 'ANIM', 1, '2015-03-06 12:55:19', NULL),
(78, 'Tombola', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/tombola_prize_2015.jpg\" style=\"float:right\" />Pendant l&#39;&eacute;dition 2015, chaque acheteur, vendeur ou visiteur pourra s&#39;il le souhaite participer &agrave; la tombola gratuite de la Bourse aux V&eacute;los pour gagner un tr&egrave;s beau VTT 26 pouces NEUF MARQUE TREK de chez &quot;Bike Earth&quot; St Nazaire. Tirage au sort le dimanche soir vers 17h30.', 2015, 'ANIM', 1, '2015-03-05 12:56:25', NULL),
(79, 'Ch&egrave;que au m&eacute;c&eacute;nat chirurgie cardiaque', '<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/mecenat_lg.jpg\" />', 2014, 'ANIM', 1, '2014-03-05 12:58:49', NULL),
(80, 'Gagnant Tombola', 'Le VTT (valeur 529 &euro;) qui a &eacute;t&eacute; gagn&eacute; lors de la Bourse aux V&eacute;los 2014 a &eacute;t&eacute; remis &agrave; la gagnante devant le magasin Bike Earth en pr&eacute;sence des membres du bureau de l&#39;ATLANTIQUE VELO SPORT.<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/gagnant_tombola_2014-lg.jpg\" />', 2014, 'ANIM', 1, '2014-03-05 13:01:34', NULL),
(81, 'Paul Correc', '<img alt=\"\" height=\"566\" src=\"http://avs44.com/BAV/ckeditorUploads/paul_correcof_2_sm.jpg\" width=\"400\" /><br />\nPaul CORREC sera pr&eacute;sent samedi et dimanche apr&egrave;s-midi dans l&#39;enceinte de la soucoupe &agrave; l&#39;occasion de la Bourse aux V&eacute;los pour pr&eacute;senter son ouvrage consacr&eacute; &agrave; un si&egrave;cle de cyclisme &agrave; St Nazaire.<br />\nA cette occasion, vous pourrez achetez ce livre et le faire d&eacute;dicacer par l&#39;auteur. Cette ouvrage est publi&eacute; par l&#39;Association Pr&eacute;historique et Historique de la R&eacute;gion Nazairienne.', 2014, 'ANIM', 1, '2014-02-05 13:02:51', NULL),
(82, 'Gagnant Tombola', 'Heureux gagnant en 2013 : M. THOMAS de GUERANDE qui part avec un nouveau VTT 26&quot; de chez Bike Earth, St Nazaire<br />\n<img alt=\"\" height=\"266\" src=\"http://avs44.com/BAV/ckeditorUploads/gagnant_tombola_2013_2.jpg\" width=\"400\" />', 2013, 'ANIM', 1, '2013-02-04 13:04:23', NULL),
(83, 'Bruno LEZIN', 'Bruno LEZIN que l&#39;on ne pr&eacute;sente plus sur St Nazaire. Il a suivi de nombreux Tour de France. Il a &eacute;crit un livre sur le tour et il pr&eacute;sente de nombreux objets revues et visuels de la grande boucle ainsi que des maillots prestigieux ayant appartenus &agrave; des stars du v&eacute;lo.<br />\n<img alt=\"\" height=\"300\" src=\"http://avs44.com/BAV/ckeditorUploads/lezin.jpg\" width=\"400\" />', 2013, 'ANIM', 1, '2013-01-05 13:05:41', NULL),
(84, 'Daniel COUDE', 'Originaire de Tour, grand habitu&eacute; de la bourse aux v&eacute;los de St NAZAIRE, il est un grand collectionneur de v&eacute;los. Il nous en pr&eacute;sentera quelques uns et vous fera partager sa passion.<br />\n<img alt=\"\" height=\"300\" src=\"http://avs44.com/BAV/ckeditorUploads/coude.jpg\" width=\"400\" />', 2013, 'ANIM', 1, '2013-01-05 13:06:09', NULL),
(85, 'Jean THEIL', 'Passionn&eacute; de v&eacute;lo et de son histoire, habitant Pr&eacute;failles, il nous pr&eacute;sentera sur une quinzaine de grilles des tableaux qu&#39;il a confectionn&eacute;s lui m&ecirc;me et qui retracent l&#39;histoire de la petite reine.<br />\n<img alt=\"\" height=\"266\" src=\"http://avs44.com/BAV/ckeditorUploads/theil.jpg\" width=\"400\" />', 2013, 'ANIM', 1, '2013-01-05 13:06:34', NULL),
(86, 'Heureuse gagnante en 2012', 'Sylvie MARIN de SAINT NAZAIRE qui part avec un nouveau VTC 29&quot; de chez Intersport Trignac<br />\n<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/gagnant_tombola_2012-lg.jpg\" />', 2012, 'ANIM', 1, '2012-03-05 13:08:43', NULL),
(87, 'Gagnant Tombola', 'En 2011, J&eacute;rome ROBERT de St Nazaire a gagn&eacute; un VTC neuf<br />\n<br />\n<img alt=\"\" src=\"http://avs44.com/BAV/ckeditorUploads/gagnant_tombola_2011.jpg\" />', 2011, 'ANIM', 1, '2011-03-05 13:09:13', NULL),
(88, 'Tombola 2019', '<a href=\"http://avs44.com/BAV/downloads/reglement_tombola.pdf\" target=\"_blank\">R&eacute;glement de la Tombala</a>', 2019, 'ANIM', 0, '2019-05-03 11:50:19', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bav_client`
--

CREATE TABLE `bav_client` (
  `cli_id` bigint(20) UNSIGNED NOT NULL,
  `cli_id_modif` varchar(8) NOT NULL,
  `cli_nom` varchar(100) NOT NULL,
  `cli_emel` varchar(100) DEFAULT NULL,
  `cli_adresse` varchar(100) DEFAULT NULL,
  `cli_adresse1` varchar(100) DEFAULT NULL,
  `cli_code_postal` varchar(10) DEFAULT NULL,
  `cli_ville` varchar(100) DEFAULT NULL,
  `cli_telephone` varchar(15) DEFAULT NULL,
  `cli_telephone_bis` varchar(15) DEFAULT NULL,
  `cli_taux_com` decimal(10,2) NOT NULL,
  `cli_prix_depot` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `bav_client`
--

INSERT INTO `bav_client` (`cli_id`, `cli_id_modif`, `cli_nom`, `cli_emel`, `cli_adresse`, `cli_adresse1`, `cli_code_postal`, `cli_ville`, `cli_telephone`, `cli_telephone_bis`, `cli_taux_com`, `cli_prix_depot`) VALUES
(17, 'c407c04e', 'GarcÃ©s Marc', 'marc.garces@free.fr', '', '2, rue des judelles', '44117', 'Saint AndrÃ© des Eaux', '0681629671', '', '5.00', '0.00'),
(18, 'dd23bd52', 'Corduan Olivier', 'olivier.corduan@orange.fr', '', '', '44600', 'Saint Nazaire', '', '', '10.00', '3.00'),
(26, 'c6ad5e0c', 'test test', 'test@test.com', '', '', '', 'paris', '', '', '10.00', '3.00'),
(29, '81d54697', 'MARC GARCES', 'braillou@gmail.com', '2, rue des judelles', '', '44600', 'SAINT ANDRÃ‰ DES EAUX', '0681629671', '', '5.00', '0.00'),
(30, 'cdcbeea4', 'BALDIN MARCO', 'BALDINPRO@GMAIL.COM', '', '', '44117', 'Saint AndrÃ© des Eaux', '', '', '5.00', '0.00'),
(31, '14653d1c', 'Leray serge', 'smleray@wanadoo.fr', '6 chemin de la villes bouget', '', '44380', 'pornichet', '0631886384', '', '5.00', '0.00'),
(32, '75594a9a', 'Ronan GARCES', 'ronan.garces@gmail.com', '19 boulevard MendÃ¨s, RÃ©sidence vega appartement 136', 'RÃ©sidence vega appartement 136', '44700', 'Orvault', '0695460899', '', '10.00', '3.00'),
(33, '66b3fd9e', 'Briand Antoine', '', '', '', '', '', '', '', '10.00', '0.00'),
(34, 'f5ca0cbf', 'Bernard Hinault', '', '', '', '', '', '', '', '10.00', '3.00'),
(35, '465322f1', 'PIERRE Christian', 'christian.pierre2@sfr.fr', 'rue Celestin FREINET', '', '44600', 'sAINT nAZAIRE', '0646580661', '', '10.00', '0.00'),
(36, 'a1b501a4', 'rtet', '', '', '', '', '', '', '', '0.00', '0.00'),
(37, 'af3faae0', 'Marc GarcÃ¨s', 'marcgarces44@gmail.com', '10, rue des souris', '', '44600', 'Saint Nazaire', '', '', '5.00', '0.00'),
(38, '5e2a7ebc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00');

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
-- Contenu de la table `bav_faq`
--

INSERT INTO `bav_faq` (`faq_id`, `faq_name`, `faq_email`, `faq_question`, `faq_response`, `faq_date`, `faq_approved`) VALUES
(1, 'Joel BOUREZ', 'notsupplied@notsupplied.com', 'Est-ce qu&#039;il y a des cars qui desservent La Soucoupe de Saint Nazaire en partant de St Nazaire/La Gare SNCF ?', 'Effectivement, il y a de nombreux bus qui d&eacute;servent la gare et La Soucoupe ou est organis&eacute;e la bourse.<br />\nPrenez qu&rsquo;un aller simple car il se peut que vous repartiez avec le v&eacute;lo de vos r&ecirc;ves&hellip;!', '2010-07-26 11:42:59', 1),
(2, 'M.PLUMERAT', 'notsupplied@notsupplied.com', 'Est-ce qu&#39;il faut remplir un formulaire pour s&#39;inscrire &agrave; l&#39;avance ou peux t&#39;on simplement se pr&eacute;senter avec notre v&eacute;lo sans inscription pr&eacute;alable ?', 'Les deux solutions sont possibles. Dans l&#39;onglet &quot;T&eacute;l&eacute;chargements&quot; vous trouverez un exemplaire du formulaire que vous pouvez remplir &agrave; l&#39;avance pour vous faire gagner du temps sur place.<br />\nSinon, tous les formulaires sont mis &agrave; votre disposition sur place.<br />\n<strong><span style=\"background-color:#2ecc71\">**N&#39;oubliez pas votre pi&egrave;ce d&#39;identit&eacute;.**</span></strong>', '2010-07-26 11:47:47', 1),
(3, 'M.NABIIS', 'notsupplied@notsupplied.com', 'Est-ce que les v&eacute;los de course seront accept&eacute;s ?', 'Tous les v&eacute;los sont accept&eacute;s dont les v&eacute;los de course &agrave; condition qu&#39;ils soient en &eacute;tat de rouler.', '2010-07-26 11:50:21', 1),
(4, 'Mme CHOTARD', 'notsupplied@notsupplied.com', 'Je recherche un v&eacute;lo pour mon fils de 7 ans 1/2 qui mesure 1m29, entrejambe 58 cm, dois je prendre un 20 ou un 24 pouces sachant qu&#39;il grandisse vite &agrave; cet age l&agrave;.<br />\nC&#39;est un cadeau donc je ne peux l&#39;enmener avec moi.<br />\nJe voudrais trouver un v&eacute;lo en tr&egrave;s bonne &eacute;tat, peut on trouver &ccedil;a dans votre manifestation pour un prix raisonnable ?', 'Nous ne pouvons &agrave; cette heure conna&icirc;tre le choix que nous aurons cette ann&eacute;e mais les autres ann&eacute;es, il y avait ce que vous cherchez.<br />\nLe mieux, c&rsquo;est de nous rendre visite d&egrave;s le samedi matin fin de matin&eacute;e au moment o&ugrave; il y a plus de choix. Nos vendeurs b&eacute;n&eacute;voles vous conseilleront.', '2010-07-26 11:54:07', 1),
(33, 'DUPAIN RAYMOND', 'r.dupain@voila.fr', 'Je suis absent le samedi; est il possible de d&eacute;poser le v&eacute;lo que je veux vendre la veille au soir au gymnase? ou bien alors le dimanche matin?<br />\nEn vous remerciant pour votre r&eacute;ponse.', '<span style=\"background-color:#f39c12\">NOUVEAU depuis 2013&nbsp;: </span>Pour &eacute;viter l&rsquo;affluence du samedi matin nous commen&ccedil;ons les d&eacute;p&ocirc;ts (Uniquement les d&eacute;p&ocirc;ts) d&egrave;s le vendredi de 18h &agrave; 21h00 m&ecirc;me lieu La Soucoupe gard&eacute;e la nuit.', '2010-10-15 12:16:22', 1),
(36, 'drouard', 'cricri.doudou@free.fr', 'Faut&#39;il r&eacute;cup&eacute;rer imp&eacute;rativement le v&eacute;lo le dimanche soir ou possibilit&eacute; le lundi matin ?', 'Malheureusement, nous devons lib&eacute;rer la salle le dimanche soir donc nous <strong>n&#39;avons pas la possibilit&eacute; de stocker</strong> les v&eacute;los non-vendus.<br />\nIl est donc imp&eacute;ratif de r&eacute;cup&eacute;rer le v&eacute;lo le dimanche soir au plus tard.', '2010-10-25 12:39:46', 1),
(37, 'rivallin guy', 'guy.rivallin@orange.fr', 'Si je depose le velo samedi matin dois je le recuperer le soir pour le redeposer le dimanche', 'Non, il n&#39;est pas n&eacute;cessaire de r&eacute;cup&eacute;rer votre v&eacute;lo et red&eacute;poser.<br />\nNous assurons la s&eacute;curit&eacute; des v&eacute;los d&eacute;pos&eacute;s pendant les deux journ&eacute;es de la bourse aux v&eacute;los y compris la nuit.', '2010-11-04 12:30:51', 1),
(106, 'Phil', 'phil.frary@nthdimension.fr', 'Y a-t-il une garantie sur les v&eacute;los ?', 'Il y a une garantie seulement si le v&eacute;lo que vous ach&egrave;terez est encore sous garantie (cela arrive assez souvent).<br />\nC&#39;est le cas de v&eacute;los achet&eacute;s r&eacute;cemment ne correspondant pas au besoin du propri&egrave;taire qui d&eacute;cide tr&eacute;s vite de profiter de la bourse et ses 5000 &agrave; 6000 visiteurs pour le revendre.', '2012-05-05 06:55:15', 1),
(107, 'Phil', 'phil.frary@nthdimension.fr', 'Est-il possible d&#39;&eacute;changer si on se trompe ?', 'Nous n&#39;avons jamais eu le cas mais si l&#39; acheteur constate tr&egrave;s vite (pendant le week-end) un probl&eacute;me de fonctionnement nous reprenons le v&eacute;lo et nous le sortons de la vente.', '2012-05-05 06:55:33', 1),
(108, 'Phil', 'phil.frary@nthdimension.fr', 'Quels sont les moyens de paiement ?', 'Par ch&eacute;que (carte d&#39;identit&eacute; demand&eacute;e) ou en num&eacute;raires. Nous ne pouvons utiliser de TPE car les ch&eacute;ques de l&#39;acheteur sont &eacute;mis &agrave; l&#39;ordre du vendeur.', '2012-05-05 06:55:51', 1),
(109, 'Phil', 'phil.frary@nthdimension.fr', 'Peut-on payer en plusieurs fois ?', 'Si nous avons cette demande , nous contactons par t&eacute;l&eacute;phone le vendeur qui lui seul d&eacute;cide mais nous avons toujours eu des r&eacute;ponses favorables &agrave; cette requ&ecirc;te pour des v&eacute;los de plus de 1000 &euro;', '2012-05-05 06:56:14', 1),
(110, 'Phil', 'phil.frary@nthdimension.fr', 'Est-il possible d&quot;essayer les v&eacute;los sur place ?', 'Les essais se font uniquement dans La Soucoupe pour des raison de s&eacute;curit&eacute; (vol).<br />\nUne partie de cette tr&egrave;s grande salle est r&eacute;serv&eacute;e &agrave; une piste d&#39;essais.<br />\nLes vendeurs de l&#39;association AVS sont l&agrave; pour vous conseiller.', '2012-05-05 06:56:28', 1),
(111, 'Phil', 'phil.frary@nthdimension.fr', 'Y a-t-il des v&eacute;los pour les enfants ?', 'Chaque ann&eacute;e, c&#39;est le coin qui bouge le plus car les enfants adorent essayer leurs nouveaux v&eacute;los. Nous en avons &agrave; tous les prix suivant leur &eacute;tat mais tous roulent tr&eacute;s bien.', '2012-05-05 06:56:42', 1),
(112, 'Phil', 'phil.frary@nthdimension.fr', 'Est-ce que c&#39;est &agrave; l&#39;abri ?', 'La Bourse aux v&eacute;los de l&#39;AVS est organis&eacute;e tous les ans et ce depuis novembre 2004 date de la 1ere &eacute;dition dans le gymnase (40x20) de St Marc sur Mer. Les v&eacute;los sont pr&eacute;sent&eacute;s sur des barri&eacute;res prot&eacute;g&eacute;es par de la mousse.<br />\nDepuis l&#39;ann&eacute;e 2014, c&#39;est &agrave; La SOUCOUPE avenue L&eacute;o Lagrange St Nazaire.<br />\nC&#39;est beaucoup plus grand (voir les photos sur ce site).', '2012-05-05 06:57:01', 1),
(115, 'Christian Pierre', 'chris.pierre2@sfr.fr', 'Je viens d&#39;apprendre l&#39;existence de votre bourse &agrave; v&eacute;los et je suis &agrave; la recherche d&#39;une paire de roues de v&eacute;lo de course.<br />\nEst-ce qu&#39;il y en aura &agrave; vendre d&#39;occasions ou bien votre club en revend-il ?', 'Chaque ann&eacute;e des paires de roues sont d&eacute;pos&eacute;es et elles trouvent acheteurs.<br />\nRDV &agrave; la 16eme &eacute;dition La Soucoupe de SAINT NAZAIRE LES 9 et 10 novembre 2019', '2013-04-13 12:19:53', 1),
(238, 'Phil', 'phil.frary@nthdimension.fr', 'Qui fixe le prix de vente des v&eacute;los pr&eacute;sent&eacute;s?', 'Apr&egrave;s avoir rempli la &quot;fiche d&eacute;p&ocirc;t&quot;, si le vendeur le souhaite, les &quot;estimeurs&quot; de l&#39;organisation sont &agrave; sa disposition pour fixer le &quot;bon&quot; prix.<br />\n&eacute;anmoins, c&#39;est le vendeur qui inscrit son prix de vente et il est le seul d&eacute;cideur.', '2013-10-29 20:22:07', 1),
(239, 'Phil', 'phil.frary@nthdimension.fr', '<p>J&#39;aimerais vendre mon v&eacute;lo &agrave;&nbsp;assistance &eacute;lectrique.<br />\nLes VAE sont-ils les bienvenus lors de votre bourse aux v&eacute;los de St-Nazaire et en vendez-vous ?</p>\n', '<p>L&#39;ann&eacute;e pass&eacute;e (2018), nous avions eu 4 v&eacute;los &eacute;lectriques &agrave; vendre, et 3 sont partis et donc ont trouv&eacute; preneur.<br />\nSoyez donc la bienvenue, beaucoup de personnes que je rencontre sont tr&egrave;s attir&eacute;e par ce genre de v&eacute;lo.<br />\nAttention &agrave; ne pas &ecirc;tre trop gourmande sur le prix!</p>\n', '2013-10-29 20:41:24', 1),
(284, 'leray', 'benjamin_leray@hotmail.fr', '<p>bonjour, y a t&#39;il des remorques pour v&eacute;lo &agrave;&nbsp;vendre &agrave;&nbsp;la bourse aux v&eacute;los?</p>\n', '<p>Bonjour<br />\nSi vous voulez parler de remorque qui s&rsquo;accrochent &agrave; des v&eacute;los: oui Benjamin, nous en avions plusieurs (une petite dizaine) en 2013. Elles sont toutes parties sauf une qui n&#39;&eacute;tait pas tr&egrave;s r&eacute;cente.<br />\nSi ce sont des remorques pour installer des v&eacute;los: non!<br />\nPar contre, nous avons eu &agrave; la vente des portes-v&eacute;los (4 v&eacute;los)<br />\nRdv &agrave; la Soucoupe les 14 et 15 octobre 2017.<br />\nMerci de votre confiance</p>\n', '2014-08-24 13:16:09', 1),
(285, 'pierre', 'christian.pierre2@sfr.fr', '<p>Comment puis je savoir si mon v&eacute;lo d&eacute;pos&eacute;&nbsp;est vendu?</p>\n', '<p>Plusieurs solutions<br />\n1- Sur place &eacute;videmment en pr&eacute;sentant votre &quot;re&ccedil;u vendeur&quot;<br />\n2- Nouveau depuis 2014: en allant sur le site Internet de la Bourse aux v&eacute;los<br />\nCliquez sur l&#39;onglet: &quot;VENTE&quot;.<br />\nRentrez votre num&eacute;ro de v&eacute;lo dans la case. La r&eacute;ponse sera instantan&eacute;e.<br />\nSolution a privil&eacute;gier!!!<br />\n3- Par t&eacute;l&eacute;phone, au num&eacute;ro indiqu&eacute; sur votre &quot;re&ccedil;u vendeur&quot;</p>\n', '2014-08-25 19:04:52', 1),
(289, 'BRISSIER', 'brissier.guillaume@orange.fr', 'Bonjour, pouvons nous vendre des roues carbones?<br />\nmerci', 'Bonjour,<br />\nSi vous parcourez le r&egrave;glement de La Bourse aux v&eacute;los de St Nazaire, on exclu les accessoires. N&eacute;anmoins chaque ann&eacute;e, des personnes nous confient pour la vente des accessoires genre porte-v&eacute;los, remorques, cadres et roues.<br />\nIl y a un march&eacute; pour du gros accessoire. (Condition de vente identiques aux v&eacute;los)<br />\nA bient&ocirc;t.', '2014-09-30 17:10:29', 1),
(293, 'gineau', 'matgin.falu@sfr.fr', '<p>Bonjour.<br />\nMelangez vous les vtt &agrave;&nbsp;petit prix avec ceux qui valent au moins 1300 &euro;&nbsp;?&nbsp;</p>\n', '<p>Bonjour<br />\nLes VTT comme les autres v&eacute;los sont rang&eacute;s par genre et aussi par prix. Pour les beaux VTT, nous en avons toujours &agrave; chaque &eacute;dition et des beaucoup plus chers.<br />\nA bient&ocirc;t</p>\n', '2015-11-03 13:36:50', 1),
(298, 'Chausson V.', 'valerie.chausson@sfr.fr', '<p>Suis je oblig&eacute;&nbsp;de revenir avant le dimanche soir 19h00 pour percevoir le montant de la vente si mon v&eacute;lo est affich&eacute;&nbsp;&quot;vendu&quot; sur le site?<br />\nJ&#39;habite Nantes.<br />\nMerci!</p>\n', '<p>Rappel de la proc&eacute;dure &laquo; de 30 km&raquo;<br />\nLe VENDEUR demande au moment du d&eacute;p&ocirc;t du v&eacute;lo l&rsquo;adresse o&ugrave; il pourra r&eacute;cup&eacute;rer le v&eacute;lo.<br />\nApr&egrave;s avoir v&eacute;rifi&eacute; par t&eacute;l&eacute;phone ou sur le site de la BAV que son v&eacute;lo a bien &eacute;t&eacute; vendu :<br />\nLe VENDEUR enverra par la Poste dans la semaine qui suit la BAV:<br />\n- le re&ccedil;u vendeur de couleur.<br />\n- une enveloppe timbr&eacute;e r&eacute;dig&eacute;e &agrave; son nom et son adresse.<br />\n- les 10 % par ch&egrave;que &agrave; l&rsquo;ordre de l&rsquo;AVS.<br />\nD&egrave;s r&eacute;ception, l&rsquo;AVS lui enverra le ch&egrave;que remis par l&rsquo;acheteur &agrave; l&rsquo;ordre du vendeur ou un ch&egrave;que de l&rsquo;AVS si le paiement s&rsquo;est fait en liquide</p>\n', '2016-09-11 14:19:20', 1),
(299, 'christophe', 'cmoreil@free.fr', '<p>Avons nous la garantie des paiements, Ne risque t-il pas de recevoir un ch&egrave;que sans provisions</p>\n', '<p>Bonjour Christophe<br />\nC&#39;est en effet la crainte des organisateurs que nous sommes. Nous demandons une pi&egrave;ce d&#39;identit&eacute; (2 pour les v&eacute;los de plus de 1000 &euro;) &agrave; l&#39;acheteur.<br />\nDepuis 14 ans le cas ne s&#39;est jamais produit.<br />\nMalheureusement, nous ne pouvons pas utiliser de terminaux de paiements car les achats se font &agrave; l&#39;ordre du vendeur.</p>\n', '2016-09-20 14:54:34', 1),
(300, 'MAISONNEUVE', 'bertrand.maisonneuve@orange.fr', 'Bonjour, Je souhaiterais acqu&eacute;rir un nouveau v&eacute;lo de route car sur mon vieux v&eacute;lo de route j&#39;ai des douleurs aux &eacute;paules et en bas du dos.<br />\nPour ne pas me tromper sur l&#39;achat &agrave; la bourse aux v&eacute;los, il y a-t-il des personnes pouvant conseiller la bonne posture voire faire une &eacute;tude posturale ?<br />\nMerci', 'Bonjour Bertrand<br />\nNous avons la chance d&#39;avoir des professionnels de la vente de v&eacute;lo qui sont licenci&eacute;s dans le club organisateur. Ils sont pr&eacute;sents pour conseiller nos acheteurs. Je dirais que c&#39;est un peu un des points forts de la Bourse de l&#39;AVS.<br />\nA bientot', '2016-10-24 13:08:37', 1),
(302, 'Philippe Branchereau', 'philippe.branchereau@bbox.fr', 'Bonjour, pour cause de d&eacute;m&eacute;nagement je souhaite me s&eacute;parer d&#39;une centaine de livres concernant le cyclisme.<br />\nEst-il possible de les vendre &agrave; cette occasion?<br />\nmerci pour votre r&eacute;ponse, cordialement.', 'Bonjour Philippe<br />\nNous ne vendons pas ni les accessoires ni les livres. Nous avons d&eacute;ja la vente de plus de 1000 v&eacute;los &agrave; g&eacute;rer et il faudtrait plus encore de b&eacute;n&eacute;voles pour que l&#39;on se diversifie. Nous sommes d&eacute;ja 90 &agrave; nous relayer pendant les 3 jours.<br />\nN&eacute;anmoins appeler moi car je connais et pourrais trouver des collectionneurs qui pourraient &ecirc;tre int&eacute;ress&eacute;s. (num&eacute;ro sur le site ou l&#39;affiche)<br />\nChristian', '2017-09-21 13:00:51', 1),
(303, 'Bougerol', 'cocosn@orange.fr', 'Bonjour, Pourriez-vous m&#39;indiquer les heures d&#39;ouverture du samedi et dimanche.<br />\nD&#39;avance merci.', '<p>Bonjour<br />\n8h00 - 19h00 les 2 jours D&eacute;p&ocirc;ts et ventes<br />\nA bientot</p>\n', '2017-10-04 06:34:42', 1),
(304, 'BOURGET', 'Bourgemilie@sfr.fr', '<p>Bonsoir Je souhaite mettre un beau v&eacute;lo en vente. Y a t&#39;il des mesures de protection des v&eacute;los.</p>\n', '<p>Merci de poser cette question.<br />\n<strong><span style=\"background-color:#f39c12\">NOUVEAUTE: En 2019</span></strong>, nous ouvrons un show room pour les beaux v&eacute;los de plus de 500 &euro;.<br />\nCela se situera dans la mezzanine au dessus du hall d&#39;entr&eacute;e.<br />\nDans cet espace les v&eacute;los seront pr&eacute;sent&eacute;s debout bien espac&eacute;s. Ils seront bien mis en &eacute;vidence sur leurs supports pour faciliter les ventes.<br />\nComme indiqu&eacute; sur notre r&egrave;glement, nous mettons tout en oeuvre pour ne pas qu&#39;il y ait de probl&egrave;me.<br />\nVoir &eacute;galement la fiche pour les tr&egrave;s beaux velos.</p>\n', '2018-11-10 18:42:00', 1),
(320, 'MARC GARCES', 'marc.garces@free.Fr', '<p>Test mobile</p>\n', '<p>Ca marche.</p>\n', '2019-01-24 20:33:13', 0);

-- --------------------------------------------------------

--
-- Structure de la table `bav_objet`
--

CREATE TABLE `bav_objet` (
  `obj_id` bigint(20) NOT NULL,
  `obj_numero` int(11) NOT NULL,
  `obj_id_modif` varchar(5) NOT NULL,
  `obj_numero_bav` int(11) NOT NULL,
  `obj_type` enum('Autre','Route','Demi-Course','VTT','VTC','Ville','Tamden','BMX') DEFAULT 'Autre',
  `obj_public` enum('Autre','Homme','Femme','Mixte','Enfant','GarÃ§on','Fille') DEFAULT 'Autre',
  `obj_pratique` enum('Autre','Loisir','Sportif','CompÃ©tition') DEFAULT 'Autre',
  `obj_marque` varchar(50) DEFAULT NULL,
  `obj_modele` varchar(50) DEFAULT NULL,
  `obj_couleur` varchar(30) DEFAULT NULL,
  `obj_description` text,
  `obj_prix_depot` decimal(10,2) DEFAULT NULL,
  `obj_date_depot` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obj_prix_vente` decimal(10,2) DEFAULT '0.00',
  `obj_date_vente` datetime DEFAULT NULL,
  `obj_prix_modif` decimal(10,2) DEFAULT NULL,
  `obj_id_vendeur` int(11) NOT NULL,
  `obj_id_acheteur` int(11) DEFAULT NULL,
  `obj_date_retour` datetime DEFAULT NULL,
  `obj_etat` varchar(10) NOT NULL DEFAULT 'INIT',
  `obj_accessoire` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `bav_objet`
--

INSERT INTO `bav_objet` (`obj_id`, `obj_numero`, `obj_id_modif`, `obj_numero_bav`, `obj_type`, `obj_public`, `obj_pratique`, `obj_marque`, `obj_modele`, `obj_couleur`, `obj_description`, `obj_prix_depot`, `obj_date_depot`, `obj_prix_vente`, `obj_date_vente`, `obj_prix_modif`, `obj_id_vendeur`, `obj_id_acheteur`, `obj_date_retour`, `obj_etat`, `obj_accessoire`) VALUES
(139, 700, 'cab8b', 2019, 'VTT', 'GarÃ§on', 'CompÃ©tition', 'TREK', 'SUPERFLY 100FS', 'MarOn', 'Taille : 21.5 pouces - XL\nPrix d\'achat : 2700 â‚¬\nAnnÃ©e d\'achat :  09/2015', '950.00', '2019-01-03 00:01:46', '950.00', '2019-01-17 04:01:32', NULL, 17, 17, NULL, 'VENDU', ''),
(148, 705, 'c6a3a', 2019, 'Autre', 'Autre', 'Autre', 'BIANCHI', '', 'vert', 'Taille :\nPrix d\'achat : \nAnnÃ©e d\'achat : \n.....', '350.00', '2019-01-03 15:24:28', '0.00', '0000-00-00 00:00:00', '0.00', 29, 0, '0000-00-00 00:00:00', 'CONFIRME', ''),
(156, 713, '989e4', 2019, 'VTT', 'Homme', 'Sportif', 'DECATHLON', '', 'rockrider 500', 'Taille :\nPrix d\'achat : \nAnnÃ©e d\'achat : \n.....', '102.00', '2019-01-03 19:03:59', '102.00', '0000-00-00 00:00:00', '0.00', 29, 0, '0000-00-00 00:00:00', 'CONFIRME', 'une pompe, un casque, compteur.'),
(158, 714, 'fae4f', 2019, 'VTT', 'Homme', 'Loisir', 'Sunn', 'xircuit', 'Argent', 'Taille : 22\nPrix d\'achat : 5000frs\nAnnÃ©e d\'achat : 1997\n.', '40.00', '2019-01-03 21:01:54', '0.00', '0000-00-00 00:00:00', '0.00', 29, 0, '0000-00-00 00:00:00', 'CONFIRME', ''),
(159, 701, '36ac3', 2019, 'VTT', 'Homme', 'Sportif', 'trek', 'fuel ex 9', 'gris bleu', 'Taille :M\nPrix d\'achat : 4000\nAnnÃ©e d\'achat : 2017\n.....', '2000.00', '2019-01-04 16:02:57', '2000.00', '0000-00-00 00:00:00', '0.00', 30, 0, '0000-00-00 00:00:00', 'CONFIRME', 'COMPTEUR\nSACOCHE\nPEDALES\nCASQUE'),
(160, 702, 'ce0bf', 2019, 'Route', 'Homme', 'Sportif', 'GIANT', 'tcx', 'noir', 'Taille : M/L\nPrix d\'achat : 1000\nAnnÃ©e d\'achat :  2016 \n.....', '740.00', '2019-04-29 05:04:52', '740.00', NULL, NULL, 17, NULL, NULL, 'STOCK', ''),
(161, 5000, '122c5', 2019, 'VTT', 'Homme', '', 'GIANT', 'Giant NRS', 'Bleu', 'Taille :L\nPrix d\'achat : 4500\nAnnÃ©e d\'achat : 2005\n.....', '200.00', '2019-01-05 15:49:18', '0.00', NULL, NULL, 31, NULL, NULL, 'INIT', 'rien'),
(167, 5006, '4a0ea', 2019, 'VTT', 'Homme', 'Sportif', 'Giant', 'Giant NRS', 'Bleu', 'Taille :L\nPrix d\'achat : 4500\nAnnÃ©e d\'achat : 2005\n.....', '18.00', '2019-01-07 14:01:22', '0.00', NULL, NULL, 31, NULL, NULL, 'INIT', 'pompe tendeur pneu en latex'),
(170, 706, 'a8b58', 2019, 'Autre', 'Autre', 'Autre', 'FSFSDF', '', 'SFSD', 'Taille :\nPrix d\'achat : \nAnnÃ©e d\'achat : \n.....', '0.00', '2019-01-07 14:07:08', '0.00', '0000-00-00 00:00:00', '0.00', 29, 0, '0000-00-00 00:00:00', 'CONFIRME', ''),
(171, 704, '95c8b', 2019, 'Autre', 'Autre', 'Autre', 'sfsdf', '', 'sfsd', 'Taille :\nPrix d\'achat : \nAnnÃ©e d\'achat : \n.....', '150.00', '2019-01-21 06:01:16', '120.00', '0000-00-00 00:00:00', '0.00', 29, 0, '0000-00-00 00:00:00', 'STOCK', ''),
(174, 703, '78512', 2019, 'Route', 'Homme', '', 'SCOTT', 'Foil 40', 'Noir', 'Taille :56\nPrix d\'achat : 2500\nAnnÃ©e d\'achat : 2015\n.....', '1000.00', '2019-04-29 05:04:40', '1000.00', '0000-00-00 00:00:00', '0.00', 32, 0, '0000-00-00 00:00:00', 'STOCK', 'PÃ©dales look keo'),
(175, 707, '637d2', 2019, 'VTT', '', '', 'DECATHLON', '', 'REd', 'Taille :\nPrix d\'achat : \nAnnÃ©e d\'achat : \n.....', '0.00', '2019-01-08 17:24:35', '0.00', '0000-00-00 00:00:00', '0.00', 29, 0, '0000-00-00 00:00:00', 'CONFIRME', ''),
(176, 708, 'e7618', 2019, 'VTT', 'Homme', 'CompÃ©tition', 'TREK', 'SUPERFLY 100', 'Noir', 'VÃ©lo volÃ© au beau Sergio', '852.50', '2019-01-11 16:07:34', '852.30', '0000-00-00 00:00:00', '0.00', 29, 0, '0000-00-00 00:00:00', 'CONFIRME', 'Antivol'),
(177, 1, 'c471c', 2019, 'Autre', 'Autre', 'Autre', NULL, NULL, NULL, NULL, '120.00', '2019-01-15 11:21:53', '120.00', '2019-01-15 12:01:59', NULL, 30, NULL, '2019-01-15 12:01:03', 'PAYE', NULL),
(178, 150, '33b03', 2019, 'Autre', 'Autre', 'Autre', NULL, NULL, NULL, NULL, '150.00', '2019-01-15 19:58:12', '150.00', NULL, NULL, 30, NULL, NULL, 'STOCK', NULL),
(179, 100, '284c1', 2019, 'Autre', 'Autre', 'Autre', NULL, NULL, NULL, NULL, '120.00', '2019-01-17 13:58:41', '120.00', NULL, NULL, 33, NULL, NULL, 'STOCK', NULL),
(180, 101, '52fe8', 2019, 'Autre', 'Autre', 'Autre', NULL, NULL, NULL, NULL, '150.00', '2019-01-17 13:58:53', '150.00', '2019-01-17 03:01:08', NULL, 33, NULL, '2019-01-17 03:01:25', 'PAYE', NULL),
(181, 102, '06f7c', 2019, 'Autre', 'Autre', 'Autre', NULL, NULL, NULL, NULL, '150.00', '2019-01-17 13:58:59', '150.00', NULL, NULL, 33, NULL, NULL, 'STOCK', NULL),
(182, 50, 'aa78d', 2019, 'Autre', 'Autre', 'Autre', 'CANNONDALE', '', 'sfsd', '', '150.00', '2019-01-17 14:59:43', '150.00', '2019-01-17 04:01:53', NULL, 33, NULL, '2019-01-17 04:01:57', 'PAYE', ''),
(183, 51, 'c18aa', 2019, 'Autre', 'Autre', 'Autre', '', '', '', '', '250.00', '2019-01-17 14:59:47', '120.00', '2019-01-21 08:01:21', NULL, 33, 36, '2019-01-21 08:01:04', 'PAYE', ''),
(184, 52, '89aa8', 2019, 'Autre', 'Autre', 'Autre', NULL, NULL, NULL, NULL, '458.00', '2019-01-17 14:59:52', '458.00', '2019-01-17 04:01:31', NULL, 33, NULL, NULL, 'VENDU', NULL),
(185, 53, '2229d', 2019, 'Autre', 'Autre', 'Autre', NULL, NULL, NULL, NULL, '75.00', '2019-01-17 15:00:00', '75.00', NULL, NULL, 33, NULL, '2019-01-17 04:01:48', 'RENDU', NULL),
(186, 512, '24573', 2019, 'Route', 'Homme', 'CompÃ©tition', 'hinault', '', 'bleu', '', '1500.00', '2019-01-18 08:07:43', '1500.00', '2019-01-18 09:01:23', NULL, 34, NULL, NULL, 'VENDU', ''),
(187, 709, '6f2dd', 2019, 'Route', 'Homme', 'Sportif', 'DECATHLON', 'gg', 'rouge', 'Taille :d\nPrix d\'achat : \nAnnÃ©e d\'achat : \n.....', '120.00', '2019-01-21 06:01:29', '120.00', '0000-00-00 00:00:00', '0.00', 35, 0, '0000-00-00 00:00:00', 'STOCK', 'pompe\nsacoche\ncompteur'),
(188, 125, '88847', 2019, 'Autre', 'Autre', 'Autre', '', '', '', '', '120.00', '2019-01-21 19:24:48', '120.00', '2019-01-21 08:01:03', NULL, 17, 17, NULL, 'VENDU', ''),
(189, 126, '85678', 2019, 'Autre', 'Autre', 'Autre', NULL, NULL, NULL, NULL, '5872.00', '2019-01-21 19:24:54', '120.00', '2019-01-21 08:01:34', NULL, 17, NULL, '2019-01-21 08:01:51', 'PAYE', NULL),
(190, 21, 'c3484', 2019, 'Autre', 'Autre', 'Autre', '', '', '', '', '120.00', '2019-01-21 19:26:31', '120.00', '2019-01-21 08:01:23', NULL, 35, 18, NULL, 'VENDU', ''),
(191, 712, 'df20c', 2019, 'VTT', 'Homme', 'Sportif', 'giant', 'NRS AIR', 'bleu', 'Taille :L\nPrix d\'achat : 4000â‚¬\nAnnÃ©e d\'achat :2005\n.....', '500.00', '2019-04-29 05:04:05', '500.00', NULL, NULL, 31, NULL, NULL, 'STOCK', 'lumiÃ¨re'),
(192, 710, '2881e', 2019, 'Route', 'Homme', 'CompÃ©tition', 'RIDLEY', 'noir', 'noir', 'Taille : 54\nPrix d\'achat : 4500 â‚¬\nAnnÃ©e d\'achat : 2015', '2400.00', '2019-05-13 02:05:01', '2400.00', '2019-05-13 04:05:26', '0.00', 37, 18, '0000-00-00 00:00:00', 'VENDU', ''),
(193, 711, '02920', 2019, 'VTT', 'Homme', 'Sportif', 'DECATHLON', 'rockrider 9', 'bleu', '', '0.00', '2019-04-29 16:55:03', '0.00', '0000-00-00 00:00:00', '0.00', 37, 0, '0000-00-00 00:00:00', 'CONFIRME', ''),
(194, 10, '0f0b0', 2019, 'Autre', 'Autre', 'Autre', 'COMMENCAL', '', 'noir', '', '120.00', '2019-04-29 17:15:22', '100.00', NULL, NULL, 31, NULL, NULL, 'STOCK', NULL),
(195, 715, '3d32d', 2019, 'VTT', 'Femme', 'Loisir', 'GIANT', 'Giant NRS', 'ROUGE', 'Taille : M\nPrix d\'achat : 250\nAnnÃ©e d\'achat : 2012', '100.00', '2019-04-29 06:04:37', '85.00', '2019-04-29 08:04:49', '0.00', 35, 31, '2019-04-29 08:04:54', 'PAYE', '');

-- --------------------------------------------------------

--
-- Structure de la table `bav_parametre`
--

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
  `par_table_date_debut` date NOT NULL,
  `par_table_date_fin` date NOT NULL,
  `par_table_id_mac` varchar(600) DEFAULT NULL,
  `par_admin_id_mac` varchar(600) DEFAULT NULL,
  `par_titre` varchar(100) DEFAULT NULL,
  `par_nb_modif` int(11) NOT NULL DEFAULT '0',
  `par_date_1` date NOT NULL,
  `par_date_2` date NOT NULL,
  `par_date_3` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `bav_parametre`
--

INSERT INTO `bav_parametre` (`par_numero_bav`, `par_taux_1`, `par_taux_2`, `par_taux_3`, `par_prix_depot_1`, `par_prix_depot_2`, `par_prix_depot_3`, `par_client_date_debut`, `par_client_date_fin`, `par_table_date_debut`, `par_table_date_fin`, `par_table_id_mac`, `par_admin_id_mac`, `par_titre`, `par_nb_modif`, `par_date_1`, `par_date_2`, `par_date_3`) VALUES
('2019', '10.00', '5.00', '0.00', '3.00', '1.00', '0.00', '2019-10-01', '2019-11-10', '2018-11-09', '2019-11-10', 'localhost', 'f', 'La 16eme bourse aux 1000 velos', 0, '2019-11-08', '2019-11-09', '2019-11-10'),
('2020', '10.00', '5.00', '0.00', '3.00', '2.00', '1.00', '2020-01-01', '2020-01-01', '2020-01-01', '2020-01-01', 'localhost, 127:0:0:1, ::1', 'localhost, 127:0:0:1, ::1', 'la bav 2020', 0, '0000-00-00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `bav_users`
--

CREATE TABLE `bav_users` (
  `uid` int(3) UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `username` varchar(15) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bav_users`
--

INSERT INTO `bav_users` (`uid`, `name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', 'fcc2704ec6043daf93f0f4b113844369');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bav_actu`
--
ALTER TABLE `bav_actu`
  ADD UNIQUE KEY `act_id` (`act_id`);

--
-- Index pour la table `bav_client`
--
ALTER TABLE `bav_client`
  ADD PRIMARY KEY (`cli_id`),
  ADD UNIQUE KEY `cli_id` (`cli_id`),
  ADD KEY `cli_nom` (`cli_nom`),
  ADD KEY `cli_id_2` (`cli_emel`) USING BTREE;

--
-- Index pour la table `bav_faq`
--
ALTER TABLE `bav_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Index pour la table `bav_objet`
--
ALTER TABLE `bav_objet`
  ADD PRIMARY KEY (`obj_id`),
  ADD UNIQUE KEY `obj_id` (`obj_id`),
  ADD UNIQUE KEY `obj_id_2` (`obj_id_modif`),
  ADD UNIQUE KEY `obj_numero` (`obj_numero`,`obj_numero_bav`),
  ADD KEY `obj_marque` (`obj_marque`);

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
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bav_actu`
--
ALTER TABLE `bav_actu`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT pour la table `bav_client`
--
ALTER TABLE `bav_client`
  MODIFY `cli_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT pour la table `bav_faq`
--
ALTER TABLE `bav_faq`
  MODIFY `faq_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;
--
-- AUTO_INCREMENT pour la table `bav_objet`
--
ALTER TABLE `bav_objet`
  MODIFY `obj_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;
--
-- AUTO_INCREMENT pour la table `bav_users`
--
ALTER TABLE `bav_users`
  MODIFY `uid` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
