<!--*page permettant d’ajouter un produit-->
<?php
session_start();
require_once('connect.php');
     if(isset($_POST)){
            if (isset($_POST['nom_produit']) && !empty($_POST['nom_produit'])//Si nom_produit est false il doit renvoyer à l'expression empty nom_produit, cependant il ne le reconnaît pas  
                && isset($_POST['description_produit']) && !empty ($_POST['description_produit'])
                && isset($_POST['image_produit']) && !empty ($_POST['image_produit'])
                && isset($_POST['prix_produit']) && !empty ($_POST['prix_produit'])){
                    
                    //nettoyons les id
                    $nom_produit= strip_tags($_POST['nom_produit']);
                    $description_produit= strip_tags($_POST['description_produit']);
                    $image_produit= strip_tags($_POST['image_produit']);
                    $prix_produit= strip_tags($_POST['prix_produit']);   
                    
                    $sql="INSERT INTO `produits`(`nom_produit`,`description_produit`, `image_produit`, `prix_produit`)
                    VALUES (:nom_produit, :description_produit, :image_produit, :prix_produit);";
                    //Préparationd de la requête sql
                    $query= $db->prepare($sql);
                   
                    //ON lie les id des colonnes avec les futures valeurs récupérés dans le formulaire
                    $query->bindValue(':nom_produit',$nom_produit, PDO::PARAM_STR);
                    $query->bindValue(':description_produit',$description_produit, PDO::PARAM_STR);
                    $query->bindValue(':image_produit',$image_produit, PDO::PARAM_STR);
                    $query->bindValue(':prix_produit',$prix_produit, PDO::PARAM_INT);
                    
                    // Le script s'exécute
                    $query->execute(); 
                    $_SESSION['messageAdd'] = "Produit ajouté !";
                    header('Location: index.php');
                }
         }
require_once('close.php');
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter un produit</title>
    <meta name="description" content="This is an example of a meta description.">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" type="text/css" href="theme.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </head>
  <body>
  <h1 class="text-center">Le Marché du coin</h1>
        </hr>
  </br>
  
</br>      
  <form method="post">
    <label for="nom_produit"class=" h4 text-center">Produit:</label>
    <input type="text" name="nom_produit" id="nom_produit" textarea class="form-control">
    </br>
    <label for="description_produit" class=" h4 text-center">Description:</label>
    <input type="text" name="description_produit" id="description_produit" textarea class="form-control form-control-lg" >
    </br>
    <label for="image_produit" class=" h4 text-center">Image:</label>
    <input type="text" name="image_produit" id="image_produit" textarea class="form-control">
    </br>
    <label for="prix_produit" class=" h4 text-center">Prix:</label>
    <input type="text" name="prix_produit" id="prix_produit" textarea class="form-control">
    </br>
    <div container>
                   <div class="row">
                   <div class="col text-center"> 
    <button class="btn btn-success btn-lg">Valider</button>
    <a href="index.php" class="btn btn-dark btn-lg">Annuler</a>
    </div>
    </div>
    </div>
    
</form>
</br>
  </body>
  </html>