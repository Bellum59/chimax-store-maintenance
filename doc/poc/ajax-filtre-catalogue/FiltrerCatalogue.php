<?php
require "../ProduitDao.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json; charset=utf-8');

$produits = ProduitDao::listerProduits($_GET['order']);
echo json_encode($produits);
