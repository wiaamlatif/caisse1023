<?php
session_start();

//*___________(counter.php)_____________ */

/* echo "=======(page:cart.php)=======<br>";
echo "<pre>==(_SESSION)=======<br>";
var_dump($_SESSION);
echo "</pre>"; */

if(!isset($_SESSION['user'])){
  header("location:../index.php");
} else {
  $idc=$_SESSION['idCategory'];
  $idUser = $_SESSION['user']['id_user'];

  if(!isset($_SESSION['cart'])){$_SESSION['cart'][$idUser]=[];}      

}

if(isset($_POST['ajouter'])){

  $idProduct = $_POST['idProduct']; 
  $qty = $_POST['qtyInput']; 
  
  $_SESSION['cart'][$idUser][$idProduct]=$qty;

  if($qty==0){      
    unset($_SESSION['cart'][$idUser][$idProduct]);
  }
  
}

header( "location:categorie.php?idc=$idc");
//header( "location:".$_SERVER['HTTP_REFERER']);


//echo "<pre>=====count===========<br>";
//var_dump($_SESSION['cart'][$idUser]);
//echo "</pre>";








