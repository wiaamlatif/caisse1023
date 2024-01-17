<?php
    require_once '../include/database.php';

    $sqlstm = $pdo -> prepare('SELECT * FROM categories
                           WHERE id_category=?');
    $idCategory = $_GET['idc'];
    $sqlstm -> execute([$idCategory]); 
    $categorie= $sqlstm -> fetch(PDO::FETCH_ASSOC);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorie | <?=$categorie['name_category'];?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  
</head>
<body>
  <?php include '../include/navFront.php';?>
  <?php $_SESSION['idCategory']=$idCategory; ?>      
        
<?php
$sqlstm = $pdo -> prepare('SELECT * FROM products
                           WHERE id_category=?');
$sqlstm -> execute([$idCategory]); 
$produits= $sqlstm -> fetchAll(PDO::FETCH_ASSOC);
?>  
      
    <div class="container py-2">

    <button onclick="myFunction()" >test</button>

    <h4><?=$categorie['name_category'];?></h4>
    
    <div class="container">
      <div class="row">

        <?php
          foreach($produits as $produit){
        ?>
        <div class="card mb-3 col-md-3 m-1">
          <img src="../uploads/products/<?=$produit['imgSrc']?>" class="card-img-top w-50 mx-auto" alt="...">
            <div class="card-body">
              <a href="produit.php?id=<?=$produit['id_product']?>" class="btn stretched-link">Afficher detail</a>
              <h5 class="card-title"><?=$produit['name_product']?></h5>
              <p class="card-text"><?=$produit['description']?></p>
              <p class="card-text"><small class="text-muted"> <?=$produit['price']?> MAD</small></p>
              <p class="card-text"> <?= date_format(date_create($produit['created_at']),format:'Y/m/d' )  ?></p>
            </div>
            <div class="card-footer" style="z-index:10">
              <?php $idProduct=$produit['id_product']; ?> 

              <?php include '../include/front/counter.php';?>            

            </div>

        </div>

        <?php
          }
        ?>

      </div>
    </div>

    </div>

<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>









