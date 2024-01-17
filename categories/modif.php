<?php
    if(isset($_POST['back'])){
      //Redirection
      header('location:liste.php');
    }
?>
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
    <?php 
     include '../include/nav.php';           
     require_once '../include/database.php';      
     $id = $_GET['id'];
     $sqlstm = $pdo -> prepare('SELECT * FROM categories
                                WHERE id_category=?');
     
     $sqlstm -> execute([$id]) ;

     $category=$sqlstm->fetch(PDO::FETCH_ASSOC);

     if(isset($_POST['modifCategory'])){
        $name_category =$_POST['name_category'] ;
        $icone = $_POST['icone'];
        if(!empty($name_category)){
        $sqlstm = $pdo -> prepare('UPDATE categories
                                   SET name_category=?,
                                               icone=?
                                   WHERE id_category=?
                                   ');

        $sqlstm -> execute([$name_category,$icone,$id]) ;

        //Redirection
        header('location:liste.php');

       } else {
        echo "
        <div class='alert alert-danger' role='alert'>
          Le nom de la categorie est obligatoire !
        </div>";      
       }
     }

    ?>

    <div class="container py-2">

    <h4>Modif Categorie</h4>

      <form method="post">

        <label class="form-label fw-bolder"> Code <?=$category['code_category']?> </label>
        <input type="text" class="form-control" name="name_category" value="<?=$category['name_category']?>">

        <label class="form-label">Icone</label>
        <input type="text" class="form-control" name="icone" value="<?=$category['icone']?>">                

        <input type="submit" value="Modif Category" class="btn btn-primary my-2" name="modifCategory">
        <input type="submit" value="Back" class="btn btn-danger my-2" name="back">

      </form>

    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>