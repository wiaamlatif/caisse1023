<?php
session_start();

if(!isset($_SESSION['user'])){
  header('location:../index.php');
}

$idUser=$_SESSION['user']['id_user'];

if(isset($_SESSION['cart'][$idUser])){
    $panier=$_SESSION['cart'][$idUser];
}else{$panier=[];}

$countItems = count($panier);

?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Caisse Coffee (Front)</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav fw-bolder">

                <li class='nav-item'>
                <a class='nav-link active' aria-current='page' href='../front/index.php'>Liste des Categories</a>
                </li>

                <li class='nav-item'>
                <a class='nav-link active' aria-current='page' href='#'>Back-end</a>
                </li>

                <li class='nav-item'>
                <a class='nav-link <?php if($currentPage=="/include/deconnexion.php"){echo "active";};?>' href='../include/deconnexion.php'>Deconnexion</a>
                </li>                

      </ul>      
    </div>
    <a class="btn"  href="panier.php"><i class="fa-solid fa-cart-shopping"></i>Panier(<?=$countItems?>)</a>
  </div>
</nav>





