<?php
session_start();

require_once '../include/database.php';
$idProduct = $_GET['id'];

$sqlstm = $pdo -> prepare('SELECT * FROM products
                           WHERE id_product=?');
$sqlstm -> execute([$idProduct]); 
$produit= $sqlstm -> fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorie |<?=$produit['name_product']?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  
</head>
<body>
    <?php include '../include/navFront.php';?>

    <?php
       $discount=$produit['discount'];
       $prix =$produit['price'];
       $total = $prix-$prix*$discount/100;
    ?>

    <div class="container py-2">
      <div class="container">
        <div class="row">

          <div class="col-md-6">
            <h4><?=$produit['name_product']?></h4>
            <img class="img img-fluid w-50"src="../uploads/products/<?=$produit['imgSrc']?>" alt="">
          </div>

          <div class="col-md-6">

            <div class="d-flex align-items-center">
              <h1 class="w-50"><?=$produit['name_product']?></h1>
              <?php if(!empty($produit['discount'])){  ?>
                <span class="badge bg-success">-<?=$discount?>%</span>
              <?php } ?>
            </div>

            <hr>
            <p><?=$produit['description']?></p>
            <hr>

            <div class="d-flex">

            <?php if(!empty($produit['discount'])){  ?>

              <h5 class="mx-1">
                <span class="badge bg-danger">
                <del><?=$prix?></del> MAD
                </span>                   
              </h5>   

              <h5 class="mx-1">
                <span class="badge bg-success">
                  <?=$total?> MAD
                </span>                   
              </h5>   

              <?php } else {  ?>

              <h5 class="mx-1">
                <span class="badge bg-danger">
                <?=$prix?> MAD
                </span>                   
              </h5>         
              
              <?php }  ?>
              
            </div>

            <hr>
            <?php include '../include/front/counter.php' ?>
            <hr>

          </div>  

        </div>
      </div>
    </div>

<script src="../assets/js/script.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>









