<?php
$id = $_GET['id'];
require_once '../include/database.php';  
$sqlstm = $pdo -> prepare('DELETE FROM products
                           WHERE products.id_product  =?;');
$sqlstm -> execute([$id]);

//Redirection
header('location:liste.php');





