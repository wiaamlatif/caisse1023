<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
</head>
<body>
   
    <?php
         include '../include/navAdmin.php';
         require_once '../include/database.php';      

         $name_product="";
         if(isset($_POST['AddProduct'])){
               
          $name_product = $_POST['name_product'];
           $id_category = $_POST['id_category'] ;
           $description = $_POST['description'];
                 $price = $_POST['price'];
              $discount = $_POST['discount'];

          //echo "<pre>";
          //var_dump($_FILES);
          //echo "</pre>"; 
                                        
          if(!empty($name_product) && !empty($id_category)){
          
          echo "<pre>";
          var_dump($_FILES['imgSrc']);
          echo "</pre>"; 

          if(empty($_FILES['imgSrc']['name'])){
           $myImage='default_product.png';
          } else {
            $myImage=uniqid().$_FILES['imgSrc']['name'];           
            move_uploaded_file($_FILES['imgSrc']['tmp_name'],'../uploads/products/'.$myImage);
          }
                                                
          $sqlstm = $pdo -> prepare('INSERT INTO products (name_product,id_category,description,price,discount,imgSrc) 
                                     VALUES (?,?,?,?,?,?)');
             
          $sqlstm -> execute([$name_product,$id_category,$description,$price,$discount,$myImage]);

          //Redirection
          header('location:liste.php');
             
          } else {
             echo "
                    <div class='alert alert-danger' role='alert'>
                      Le nom du produit, la categorie sont obligatoires !
                    </div>
                  ";
          }          

         }
    ?>      

    <div class="container py-2 w-50">

    <h4>Products</h4>

      <form method="post" enctype="multipart/form-data">

        <label class="form-label">Name product</label>
        <input type="text" class="form-control" name="name_product">

        <label class="form-label" >Category:</label>
        <select class="form-control" name="id_category" id="id_category">
            <option value="">Choisir une Categorie ...</option>
          <?php 
              $sqlstm = $pdo -> query('SELECT * FROM categories')      
              -> fetchAll(PDO::FETCH_ASSOC);      
              foreach ($sqlstm as $row) {  
          ?>              
            <option value='<?=$row['id_category']?>'><?=$row['name_category']?></option>;
          <?php     
              }                             
          ?>          
        </select>
        
        <label class="form-label">Description</label>
        <input type="text" class="form-control" name="description">

        <label class="form-label">Price</label>
        <input type="text" class="form-control" name="price">

        <label class="form-label">Discount</label>
        <input type="number" class="form-control" name="discount" min="0" max="100">

        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="imgSrc">

        <input type="submit" value="AddProduct" class="btn btn-primary my-2" name="AddProduct">

      </form>

    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>