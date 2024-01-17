<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste Categories</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
</head>
<body>
    <?php include '../include/navAdmin.php';?>

    <div class="container py-2">

    <h4>Liste des categories</h4>

    <a href="addCategory.php" class="btn btn-primary">Ajouter Categorie</a>

    <table class="table table-striped table-hover">
      <thead>
        <tr><!-- table row--->
          <th>Id</th><!-- table head--->
          <th>Code</th>
          <th>Name</th>
          <th>Icone</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>

      <?php 
          require_once '../include/database.php';      
          $sqlstm = $pdo -> query('SELECT * FROM categories')      
          -> fetchAll(PDO::FETCH_ASSOC);      
          foreach ($sqlstm as $row) {  
      ?>              
        <tr>
           <td><?=$row['id_category']?></td>
           <td><?=$row['code_category']?></td>
           <td><?=$row['name_category']?></td>
           <td><i class="<?=$row['icone']?>"></i></td>
           <td><?=$row['date']?></td>
           <td>
             <a href="modif.php?id=<?=$row['id_category']?>" class="btn btn-primary btn-sm">Modifier</a>
             <?php              
               if($row['code_category']==count($sqlstm)){
             ?>
             <a href="suprim.php?id=<?=$row['id_category']?>" class="btn btn-danger btn-sm"
                onclick="return confirm('Confirmez SVP la suppression de <?=$row['name_category']?>')"  >Suprimer</a>             
             <?php
               }
             ?>   

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