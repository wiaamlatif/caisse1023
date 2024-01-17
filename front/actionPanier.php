 <?php
 session_start();

 //*_______(panier.php)_____________________________________ */
 //*_______(<100>form input valider input vider /form)_______*/
 //*_____("mysql:host=localhost;dbname=ci_db","root","")_____*/
 //*_______(SELECT * FROM products)__________________________*/
 //*_______(INSERT INTO tickets)_____________________________*/
 //*_______(INSERT INTO lignes_ticket)_______________________*/


 $idUser = $_SESSION['user']['id_user'];
 $panier = $_SESSION['cart'][$idUser]; 
 $contItem=count($panier);

  if(isset($_POST['vider'])){    
    $panier = [];
    $_SESSION['cart'][$idUser]=$panier; 
    $contItem=0;

    header( "location:panier.php");
  } 

  
  //sqlValue
  if(!empty($panier)&isset($_POST['valider'])){
  
    require_once '../include/database.php';      

    $prd=array_keys($panier);
    $prdPanier=implode(",",$prd);

 //  products :
 // `1:id_product`, `2:id_category`, `3:name_product`,
 // `4:description`, `5:price`, `6:discount`, `7:imgSrc`,
 // `8:created_at`
                
    $sqlstm = $pdo -> prepare('SELECT * FROM products 
                               WHERE id_product IN ('.$prdPanier.') ');

    $sqlstm -> execute();
    $prdPanier = $sqlstm -> fetchAll(PDO::FETCH_ASSOC);

    //echo "<pre>";
    //var_dump($panier);
    //echo "</pre>";die();
         
    $itemsPanier=[];       
    $totalPanier=0; 
    foreach ($prdPanier as $row) { 

      $idProduct=$row['id_product'];
      $qantity = $panier[$idProduct];      
      $totalItem=$row['price']*$qantity;
      $totalPanier+= $totalItem  ;

      $itemsPanier[] = [
       "id_product" => $idProduct,
            "price" => $row['price'],
         "quantity" => $panier[$idProduct],
      "total_ligne" => $totalItem
               ];
    }

    $fieldsLineTicket = ['id_product','price','quantity','total_ligne']; 

    $sqlValue="";
    for ($i=0; $i < $contItem ; $i++) {       
        $sqlBind[$i][0]="id_product$i";
        $sqlBind[$i][1]="price$i";
        $sqlBind[$i][2]="quantity$i";
        $sqlBind[$i][3]="total_ligne$i";

      $sqlValue.="(:id_ticket, :id_product$i, :price$i, :quantity$i, :total_ligne$i),";     
                            
    }

    $sqlValue=substr($sqlValue, 0, -1);
    
//tickets 1:id_ticket     2:id_user 3:id_z  4:nr_ticket
//        5:total_ticket  6:date_ticket     7:valider

    $nr_ticket = $_POST['nr_ticket'];  

    $total_ticket=$_POST['total_ticket'];

    $sqlStatement = $pdo ->prepare("INSERT INTO tickets (id_user,nr_ticket,total_ticket) VALUES (?,?,?)");
    $sqlStatement -> execute([$idUser,$nr_ticket,$total_ticket]);

    $idTicket = $pdo -> lastInsertId();

    $id_ticket  =$idTicket;

//lignes_ticket 1:id_ligne_ticket  2:id_ticket  3:id_product
//              4:price            5:quantity   6:total_ligne
   
    $sqlStatement = $pdo->prepare("INSERT INTO lignes_ticket (id_ticket,id_product,price,quantity,total_ligne)
    VALUES $sqlValue " ) ;

    for ($i=0; $i < $contItem ; $i++) {       

      $sqlStatement->bindParam(':id_ticket', $id_ticket);  
      
      for ($j=0; $j < count($fieldsLineTicket) ; $j++) { 
        $sqlStatement->bindParam(':'.$sqlBind[$i][$j], $itemsPanier[$i][$fieldsLineTicket[$j]]);       
      }

    }
    
    //echo $sqlValue;
    //echo "<br>";
    //display_panier($sqlBind,$itemsPanier,$fieldsLineTicket,$contItem);
    
    $sqlStatement->execute();

    //echo "<pre>=====debugDumpParams===========<br>";
    //print_r($sqlStatement -> debugDumpParams());
    //echo "</pre>";  

    //Vider panier 
    $_SESSION['cart'][$idUser]=[];
    $panier=[];  
    $contItem=0;
    
    header( "location:panier.php");          

  }//if(!empty($panier)&isset($_POST['valider']))


  function display_panier($sqlBind,$itemsPanier,$fieldsLineTicket,$contItem){    
    
    for ($i=0; $i < $contItem ; $i++) { 
      echo "<br>";
      echo "--------------( i )".$i."<br>";
      for ($j=0; $j < count($fieldsLineTicket) ; $j++) {      
        echo ':'.$sqlBind[$i][$j]."-----".$itemsPanier[$i][$fieldsLineTicket[$j]]."<br>";        
      }     
    }

  }

/*
    echo "<pre>";
    var_dump($prdPanier);
    echo "</pre>";die();
*/


 



