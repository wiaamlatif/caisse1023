<?php
session_start();

if(!isset($_SESSION['user'])){
  header('location:../index.php');
} 

if(isset($_POST['xzPeriode'])){

 $_SESSION['user']['xzPeriode']=$_POST['xzPeriode'];

 header("Location:".$_SERVER['HTTP_REFERER']."");
}

if(isset($_POST['xzUact'])){

  $_SESSION['user']['xzUact']=$_POST['xzUact'];

  header("Location:".$_SERVER['HTTP_REFERER']."");
}

if(isset($_POST['xz'])){

  $_SESSION['user']['xz']=$_POST['xz'];

  header("Location:".$_SERVER['HTTP_REFERER']."");
}

if(isset($_POST['okGetEtat'])){

  $_SESSION['user']['okGetEtat']=$_POST['okGetEtat'];

  header("Location:routeXZ.php");
}

if(isset($_POST['reset'])){
  unset($_SESSION['user']['xzPeriode']);    
  unset($_SESSION['user']['xzUact']);
  unset($_SESSION['user']['xz']);
  header("Location:".$_SERVER['HTTP_REFERER']."");
} 








