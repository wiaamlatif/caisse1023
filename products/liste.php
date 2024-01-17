<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste Produits</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
</head>
<body>
    <?php include '../include/navAdmin.php';?>

    <div class="container py-2">

    <h4>Liste des produits</h4>

    <a href="addProduct.php" class="btn btn-primary">Ajouter Produit</a>

    <table class="table table-striped table-hover">
      <thead>
        <tr><!-- table row--->
          <th width="10%">Id</th><!-- table head--->
          <th width="10%">Category</th>
          <th width="10%">Product</th>
          <th width="10%">description</th>
          <th width="10%">price</th>
          <th width="10%">discount</th>
          <th width="10%">imgSrc</th>
          <th width="10%">Date</th>
          <th width="10%">Action</th>
        </tr>
      </thead>

      <tbody>

      <?php 
          require_once '../include/database.php';      
          $sqlstm = $pdo -> query('SELECT * FROM products
                                   INNER JOIN categories ON products.id_category = categories.id_category;')      
          -> fetchAll(PDO::FETCH_ASSOC);      
          foreach ($sqlstm as $row) {  
      ?>              
        <tr>
           <td><?=$row['id_product']?></td>
           <td><?=$row['name_category']?></td>
           <td><?=$row['name_product']?></td>
           <td><?=$row['description']?></td>
           <td><?=$row['price']?></td>
           <td><?=$row['discount']?></td>
           <td>            
            <img class="img img-fluid" src="../uploads/products/<?=$row['imgSrc']?>" width="70px" alt="">
          </td>
           <td><?= date_format(date_create($row['created_at']),format:'d/m/y' )?></td>
           <td>
            <div class="d-flex py-2">
              <a href="modif.php?id=<?=$row['id_product'] ?>" class="btn btn-primary btn-sm mx-1">Modifier</a>
              <a href="suprim.php?id=<?=$row['id_product']?>" class="btn btn-danger btn-sm"
              onclick="return confirm('Confirmez la suppression de<?=$row['name_product']?>?')">Suprimer</a>          
            </div>
           </td>
        </tr>  
      <?php     
          }                             
      ?>          

      </tbody>        
    </table>



    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

