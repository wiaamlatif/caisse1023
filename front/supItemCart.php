<?php
session_start();

if(!isset($_SESSION['user'])){
  header("location:../index.php");
}

$idUser = $_SESSION['user']['id'];

if(isset($_POST['suprimer'])){

  $idProduct = $_POST['idProduct']; 

  unset($_SESSION['cart'][$idUser][$idProduct]);
 
}

header( "location:".$_SERVER['HTTP_REFERER']);









