<?php
$id = $_GET['id'];
require_once '../include/database.php';  
$sqlstm = $pdo -> prepare('DELETE FROM categories
                            WHERE id_category=?;');
$sqlstm -> execute([$id]);

//Redirection
header('location:liste.php');





