<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  
</head>
<body>
  <?php include '../include/navFront.php';?>

    <div class="container py-2">

    <h4>Liste des Categories</h4>
  <?php
    require_once '../include/database.php';
    $sqlstm = $pdo -> query('SELECT * FROM categories')
    -> fetchall(PDO::FETCH_ASSOC);     
  ?>
  <ul class="list-group list-group-flush w-25" >
    <?php foreach($sqlstm as $row): ?>
      
    <a href="categorie.php?idc=<?=$row['id_category']?>" class="btn btn-light"style="">
    <li class="list-group-item"><?= $row['name_category']?></li>
    </a>

    <?php endforeach ?>   
  </ul>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

<?php
   /* echo "=======(page:categorie.php)=======<br>";
    echo "<pre>==(panier)=======<br>";
    var_dump($panier);
    echo "</pre>"; 
    echo "<br>"; */   
  ?>      

