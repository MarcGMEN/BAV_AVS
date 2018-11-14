<?
$page_srcIndex = "location:../index.php?1=1"; 
$page_src = $page_srcIndex;
if (isset($_POST['lAction'])) {
  $page_src .= "&page=".$_POST['lAction'].".php";
}
$date = date("Y-m-d H:i:s");
$message="";
error_reporting(E_ALL);
/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "fiche") {
  if (isset($_POST['numeroFiche']) && trim($_POST['numeroFiche']) !=  "") {
    $page_src .= "&numeroFiche=".$_POST['numeroFiche'];
  }
  else {
    $page_src = $page_srcIndex."&message=Saisisez un numero de fiche";
  }
}

header($page_src);