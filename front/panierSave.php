<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panier</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/front/categorie.css">
  
</head>
<body>

  <?php include '../include/navFront.php'; ?>
  <!---------Lines Cart-------------->
  <?php
  
  $idUser = $_SESSION['user']['id'];
  $panier =$_SESSION['cart'][$idUser]; 
  $contItem=count($panier);

  if(!empty($panier)){
      
    require_once '../include/database.php';      

    $prd=array_keys($panier);
    $prdPanier=implode(",",$prd);
                    
    $sqlstm = $pdo -> prepare('SELECT * FROM products 
                               WHERE id_product IN (' . $prdPanier . ') ');
    $sqlstm -> execute();
    $prdPanier = $sqlstm -> fetchAll(PDO::FETCH_ASSOC);
     
    $cmd=[];       
    $totalCmd=0; 
    foreach ($prdPanier as $row) { 

      $idProduct=$row['id_product'];
      $totalItem=$row['price']*$panier[$idProduct];
      $totalCmd+= $totalItem  ;

      $cmd[] = [
       "id_product" => $idProduct,
            "price" => $row['price'],
         "quantity" => $panier[$idProduct],
      "total_ligne" => $totalItem
               ];
    }

    $sqlValue="";
    for ($i=0; $i < $contItem ; $i++) {       
        $sqlBind[$i][0]="id_product$i";
        $sqlBind[$i][1]="price$i";
        $sqlBind[$i][2]="quantity$i";
        $sqlBind[$i][3]="total_ligne$i";

      $sqlValue.="(:id_cmd, :id_product$i, :price$i, :quantity$i, :total_ligne$i),";     
                            
    }

    $sqlValue=substr($sqlValue, 0, -1);

  } 

?>

  <!------End Lines Cart------------->
        
    <div class="container py-2">  

    <?php   

          if(isset($_POST['valider'])&(!empty($panier))){
            
            $sqlStatement = $pdo ->prepare("INSERT INTO commandes (id_client, total_cmd) VALUES (?, ?)");
            $sqlStatement -> execute([$idUser,$totalCmd]);

            $idCommande = $pdo -> lastInsertId();

            $id_cmd =$idCommande;

            $sqlStatement = $pdo->prepare("INSERT INTO lignes_cmd (id_cmd, id_product, price, quantity, total_ligne)
            VALUES $sqlValue " ) ;

            for ($i=0; $i < $contItem ; $i++) {       
              $sqlStatement->bindParam(':id_cmd', $id_cmd);              
              $sqlStatement->bindParam(':'.$sqlBind[$i][0], $cmd[$i]['id_product']);
              $sqlStatement->bindParam(':'.$sqlBind[$i][1], $cmd[$i]['price']);
              $sqlStatement->bindParam(':'.$sqlBind[$i][2], $cmd[$i]['quantity']);
              $sqlStatement->bindParam(':'.$sqlBind[$i][3], $cmd[$i]['total_ligne']);           
            }
            
            $sqlStatement->execute();
            
            //echo "<pre>=====debugDumpParams===========<br>";
            //print_r($sqlStatement -> debugDumpParams());
            //echo "</pre>";  

            $_SESSION['cart'][$idUser]=[];
            $panier=[];            
            header( "location:panier.php");          
          }        
          ?>
                
      <h4>Panier (<?=$contItem?>)</h4>  
      <div class="container">
        <div class="row">
        <?php
        if(empty($panier)){
        ?>
           <div class='alert alert-warning' role='alert'>
            Votre panier est vide !
           </div>
        <?php       
        }else{
        ?>

    <table class="table table-striped table-hover">
      <thead>
        <tr><!-- table row--->
          <th width="10%">Id</th><!-- table head--->       
          <th width="20%">imgSrc</th>          
          <th width="20%">Product</th>          
          <th width="10%" style="text-align:center;">Quantite</th> 
          <th width="10%">Prix</th> 
          <th width="30%">Total</th>          
        </tr>
      </thead>
      <tbody>
      <?php   

          $totalCmd=0;        
          foreach ($prdPanier as $row) { 
            $idProduct=$row['id_product'];
            $totalItem=$row['price']*$panier[$row['id_product']];
            $totalCmd+= $totalItem  ;
      ?>              
        <tr>
           <td><?=$idProduct?></td>

           <td>            
            <img class="img img-fluid" src="../uploads/products/<?=$row['imgSrc']?>" width="70px" alt="">
           </td>           

           <td><?=$row['name_product']?></td>
                     
           <td><?php include '../include/front/counter.php'; ?></td>             
           
           <td id="tdPrice"><?=$row['price']?></td>

           <td id="tdItem"><?= $totalItem ?>MAD</td>

        </tr>  
      <?php     
          }                             
      ?>          
      </tbody> 
      <tfoot>
        <tr>
          <th colspan="5" style="text-align:right;" ><strong>Total</strong></th>
          <th><strong><?=$totalCmd?>MAD</strong></th>
        </tr>    
        <tr>
          <th colspan="5" style="text-align:right;" >
            <form action="actionPanier.php" method="post">
              <input type="submit" name="valider" class="btn btn-success" value="Valider">
              <input type="submit" name="vider"   class="btn btn-danger" value="Vider" onclick="return confirm('Confirmer vider panier?')">
            </form>            
          </th>          
        </tr>    
      </tfoot> 

    </table>        
                      
        <?php
             }
        ?>  
                                 
        </div><!---row--->
      </div><!-----container--->
    </div><!-----container py-2 --->

<script src="../assets/js/front/categorie.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>


<?php
             /*
              echo "<pre>==== paniers===========<br>";
              var_dump(($panier));
              echo "</pre>";  

              echo "<pre>=====Keys paniers===========<br>";
              var_dump(array_keys($panier));
              echo "</pre>";  

              echo "<pre>=====debugDumpParams===========<br>";
              var_dump($sqlStatement -> debugDumpParams());
              echo "</pre>";  

                echo "<pre>";
                print_r($sqlBind[1]);
                echo "</pre>";

              */

//header( "location:categorie.php?id=$idCategory");              

// include '../include/front/counter.php'
?>








