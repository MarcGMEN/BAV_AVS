<?php /* *****************************************
 * exemple d'utilisation de pi_barcode.php
 * par pitoo.com
 * ***************************************** */
include('pi_barcode.php');
  
// instanciation
$bc = new pi_barcode();
  
// Le code a générer
if (isset($_GET['code'])) {
   	 $code=$_GET['code'];
   }
   if (!isset($code)) {
     //          123456789012
   	$code     = '000000000000'; // barcode, of course ;)
   }
$bc->setCode($code);

// Type de code : EAN, UPC, C39...
$bc->setType('EAN');
// taille de l'image (hauteur, largeur, zone calme)
//    Hauteur mini=15px
//    Largeur de l'image (ne peut être inférieure a
//        l'espace nécessaire au code barres
//    Zones Calmes (mini=10px) à gauche et à droite
//        des barres
$bc->setSize(80, 150, 10);
  
// Texte sous les barres :
//    'AUTO' : affiche la valeur du codes barres
//    '' : n'affiche pas de texte sous le code
//    'texte a afficher' : affiche un texte libre
//        sous les barres
$bc->setText('AUTO');
  
// Si elle est appelée, cette méthode désactive
// l'impression du Type de code (EAN, C128...)
$bc->hideCodeType();
  
// Couleurs des Barres, et du Fond au
// format '#rrggbb'
$bc->setColors('#000000', '#FFFFFF');
// Type de fichier : GIF ou PNG (par défaut)
$bc->setFiletype('PNG');
  
// envoie l'image dans un fichier
$bc->writeBarcodeFile('barcode.png');
// ou envoie l'image au navigateur
$bc->showBarcodeImage();
  
/* ***************************************** */
?>