<!--page d'accueil-->
<?php
//on inclut le fichier connect.php qui nous permet de nous connecter à la base de données
require_once('connect.php');
$sql='SELECT * FROM `produits`';
//on prépare la requête
$query=$db->prepare($sql);

//on exécute la requête
$query->execute();

//on stocke le résultat dans un tableau associatif
$result=$query->fetchALL(PDO::FETCH_ASSOC);
//var_dump($result);
require_once('close.php');
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Liste des étudiants</title>
    <meta name="description" content="This is an example of a meta description.">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" type="text/css" href="theme.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <section class="col-12">
                <table class="table table-striped"> 
                     <h1>Le Marché du coin</h1>
                        <thead class="text-center"> 
                            <th>id_produit</th>
                            <th>nom_produit</th>
                            <th>description_produit</th>
                            <th>image_produit</th>
                            <th>prix_produits</th>
                            <th>Détails</th> 
                            <th>Editer</th>
                            <th>Supprimer</th>
                        </thead>
                        <tbody>
                            <?php   
                            //On boucle sur la variable result et on stocke le résultat dans test pour chaque ligne de tableau et on affiche le résultat
                            foreach($result as $test){
                            ?>
                                <tr class="text-center">
                                    <td><?= $test['id_produit'] ?> </td>
                                    <td><?= $test['nom_produit'] ?></td>
                                    <td><?= $test['description_produit'] ?></td>
                                    <td><img src="<?= $test['image_produit'] ?>" alt="<?= $test['nom_produit'] ?>" title="<?= $test['nom_produit'] ?>"class="img-thumbnail"></td>
                                    <td><?= $test['prix_produit'] ?></td>
                                    <td><a href="detailsProduit.php?id=<?=$test['id_produit']?>"class="btn btn-dark">Voir</a></td>
                                    <td><a href="majProduit.php?id=<?=$test['id_produit']?>"class="btn btn-success">Editer</a></td>
                                    <td><a href="sprProduit.php?id=<?=$test['id_produit']?>"class="btn btn-danger">Supprimer</a></td>
                                </tr>    
                            <?php 
                              }    
                            ?>                                                     
                         </tbody>
                 </table> 
                 <a href="close.php" class="btn btn-primary ">Déconnexion</a>
            </section>
        </div>
    </div>
  </body>
</html>