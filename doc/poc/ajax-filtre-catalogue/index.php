<?php
//include '../connexion.php';
include'Donnee/ProduitDao.php';
// require_once 'Donnee/CategorieDao';

$produits = ProduitDao::listerProduits("nom_asc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="Donnee/Modele/Produit.js"></script>
    <script src="ajax.js" defer></script>
</head>
<body>

<select id="form-select">
    <option value="nom_asc">Alphabetique (A-Z)</option>
    <option value="nom_desc">Alphabetique (Z-A)</option>
    <option value="prix_asc">Prix ($ - $$$)</option>
    <option value="prix_desc">Prix ($$$ - $)</option>
</select>
<button id="btn-appliquer" type="submit">Apliquer Filtre</button>



<div id="produits">
<?php foreach ($produits as $produit) { ?>
    <div id="produit">
        <p><?= $produit->nom ?></p>
        <p><?= $produit->prix ?>$</p>
    </div>
<?php } ?>
</div>

</body>
</html>

