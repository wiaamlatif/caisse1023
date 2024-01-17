<?php
//Liste des articles vendus depuis la derniere MAZ du manager
//detail un article -> NrTickets,nomUser,quantite, date, time 

require_once '../include/database.php'; 

//lignes_ticket 1:id_ligne_ticket  2:id_ticket  3:id_product
//              4:price            5:quantity   6:total_ligne

//products :`id_product`, `id_category`, `name_product`,
// `description`, `price`, `discount`, `imgSrc`, `created_at` 

$sqlstm = $pdo -> prepare('SELECT lignes_ticket.id_product, products.imgSrc,products.name_product,SUM(lignes_ticket.quantity), lignes_ticket.price, SUM(lignes_ticket.total_ligne)  FROM lignes_ticket
                           INNER JOIN products ON lignes_ticket.id_product = products.id_product
                           GROUP BY lignes_ticket.id_product
                           ORDER BY lignes_ticket.id_product
                           ASC ;
                           ');

$sqlstm -> execute();

$produits = $sqlstm -> fetchAll(PDO::FETCH_ASSOC);   

//echo "<pre>";
//var_dump($produits);
//echo "</pre>";

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
<?php include '../include/navAdmin.php';?>

<?php 

    // Initialise Variables    
    $classAlert="alert alert-danger py-2 mx-2 w-60";
    
    if(isset($_SESSION['user']['xz'])){

      $xz=$_SESSION['user']['xz'];                 
      $xzUact=$_SESSION['user']['xzUact'];             

      $message=$xz." / Historique Z manager";

    } else {
      header("Location:".$_SERVER['HTTP_REFERER'].""); 
    }
            
    //var_dump($_SESSION);
    /*
      echo "<pre>";
      var_dump($_SESSION);
      echo "</pre>";
      die();
    */
?>

  <div class="container py-2">
    <div class="d-flex flex-column justify-content-center mb3 my-2">
      
      <div class="d-flex flex-column align-content-center mx-2">

        <div class="<?=$classAlert?>" role="alert">
          <h6><?=$message?></h6>
        </div>

        <table class="table table-striped table-hover">
          <thead>
            <tr><!-- table row--->
              <th>Id_Zmanager</th><!-- table head--->
              <th>Nr_Zmanager</th>          
              <th>Total Zmanager</th>     
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php   

                $totalItem=0;
                $totalTicket=0;        
                foreach ($produits as $row){ 
                                   
                  $totalTicket+=$totalItem;           
            ?>              
              <tr>
                  <td><?=$row['id_product']?></td>

                  <td>            
                  <img class="img img-fluid" src="../uploads/products/<?=$row['imgSrc']?>" width="70px" alt="">
                  </td>           

                  <td><?=$row['name_product']?></td>
                                              
                  <td style="text-align:center;"><?=$row['SUM(lignes_ticket.quantity)']?></td>

                  <td><?=$row['price']?></td>

                  <td><?=$row['SUM(lignes_ticket.total_ligne)']?></td>
                  
                  <td>
                    <div class="d-flex py-2">
                      <form action="itemsVendus.php" method="post">             
                        <input type="hidden" name="imgSrc" value="<?=$row['imgSrc']?>">
                        <input type="hidden" name="idProduct" value="<?=$row['id_product']?>">
                        <input type="hidden" name="nameProduct" value="<?=$row['name_product']?>">          
                        <input type="submit" value="Detail" name="detailArticle" class="btn btn-success btn-sm mx-1">
                      </form>
                    </div>  
                  </td>

              </tr>  
            <?php     
                }                             
            ?>          
          </tbody> 
          <tfoot>
            <tr>
              <th colspan="5" style="text-align:right;" ><strong>Total</strong></th>
              <th id="thtotalTicket"><strong><?=$totalTicket?></strong></th>
            </tr>    
            <tr>
              <th colspan="5" style="text-align:right;" >
                <form action="#" method="post">
                  <input type="hidden" name="nr_ticket" value="<?=$lastNumTicket?>">
                  <input type="hidden" name="total_ticket" value="<?=$totalTicket?>">
                  <input type="submit" name="valider" class="btn btn-success" value="Valider Z">
                  <input type="submit" name="vider"   class="btn btn-danger" value="Annuler" onclick="return confirm('Confirmer vider panier?')">
                </form>            
              </th>          
            </tr>    
          </tfoot> 
        </table>        

<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>



