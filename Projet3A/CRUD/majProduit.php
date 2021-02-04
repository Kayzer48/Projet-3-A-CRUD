<!--page de mise à jour d’un produit-->
<?php
session_start();
require_once('connect.php');
//on démarre une session, le fait d'utiliser session_start permet d'utiliser la super globale $session

//Est-ce que l'id_produit existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty ($_GET['id'])){
    


    // on nettoie l'id envoyé (on le fait, dans le cas d'éventuels méchants utilisateurs qui veulent injecter du code...)
    //avec la fonction strip_tags qui enlèvent toutes les balises de notre id
    $id= strip_tags($_GET['id']);
    
    $sql= 'SELECT*FROM `produits` WHERE `id_produit`=:id_produit;';

// On prépare la requête
$query=$db->prepare($sql);

// On "accroche' les paramètres (id)
$query->bindValue(':id_produit',$id,PDO::PARAM_INT);

//On exécute la requête
$query-> execute();

//On récupère le test (produit)
$test = $query-> fetch();

//On vérifie si le test (produit) existe
if (!$test){
    $_SESSION['erreur']="Cet id n'existe pas";
    header('Location: principale.php');
}


}else{
    $_SESSION['message']="URL invalide";
    header('Location: principale.php');
}



     if(isset($_POST)){
        if(isset($_GET['id']) && !empty($_GET['id'])
                && isset($_POST['nom_produit']) && !empty($_POST['nom_produit'])//Si nom_produit est false il doit renvoyer à l'expression empty nom_produit, cependant il ne le reconnaît pas  
                && isset($_POST['description_produit']) && !empty ($_POST['description_produit'])
                && isset($_POST['image_produit']) && !empty ($_POST['image_produit'])
                && isset($_POST['prix_produit']) && !empty ($_POST['prix_produit'])){
                    
                    //nettoyons les id
                    $id = strip_tags($_GET['id']);
                    $nom_produit= strip_tags($_POST['nom_produit']);
                    $description_produit= strip_tags($_POST['description_produit']);
                    $image_produit= strip_tags($_POST['image_produit']);
                    $prix_produit= strip_tags($_POST['prix_produit']);   
                    
                    $sql="UPDATE `produits` SET `nom_produit`=:nom_produit,`description_produit`=:description_produit, `image_produit`=:image_produit, `prix_produit`=:prix_produit 
                    WHERE `id_produit`=:id_produit;";

                    //Préparationd de la requête sql
                    $query= $db->prepare($sql);
                   
                    //ON lie les id des colonnes avec les futures valeurs récupérés dans le formulaire
                    $query->bindValue(':id_produit',$id, PDO::PARAM_INT);
                    $query->bindValue(':nom_produit',$nom_produit, PDO::PARAM_STR);
                    $query->bindValue(':description_produit',$description_produit, PDO::PARAM_STR);
                    $query->bindValue(':image_produit',$image_produit, PDO::PARAM_STR);
                    $query->bindValue(':prix_produit',$prix_produit, PDO::PARAM_INT);
                    
                    // Le script s'exécute
                    $query->execute(); 
                    $_SESSION['messageModiSuccess'] = "Produit modifié !";
                    
                    header('Location: principale.php');
                }
         }
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
  <h1 class="text-center">Le Marché du coin</h1>
  </br>
   <table class="table table-striped table-dark "> 
                        <thead class="text-center"> 
                            <th>id_produit</th>
                            <th>nom_produit</th>
                            <th>description_produit</th>
                            <th>image_produit</th>
                            <th>prix_produits</th>      
                            <th></th> 
                        </thead>
                        <tbody>
                         
                                <tr class="text-center">
                                    <td><?= $test['id_produit'] ?> </td>
                                    <td><?= $test['nom_produit'] ?></td>
                                    <td><?= $test['description_produit'] ?></td>
                                    <td><img src="<?= $test['image_produit'] ?>" alt="<?= $test['nom_produit'] ?>" title="<?= $test['nom_produit'] ?>"class="img-thumbnail"></td>
                                    <td><?= $test['prix_produit'] ?>€</td>
                                    
                                   
                                    <td><a href="principale.php" class="btn btn-light">Retour</a></td>
                                    
                                </tr>    
                                                                           
                        </tbody>
                </table>

                    
                <h2 class="text-center">Modifier un produit</h2>  
            </br>           
  <form method="post">
    <label for="nom_produit"class=" h4 text-center">Produit:</label>
    <input type="text" name="nom_produit" id="nom_produit" textarea class="form-control" value="<?=$test['nom_produit']?>"></textarea>
    </br>
    <label for="description_produit" class=" h4 text-center">Description:</label>
    <textarea class="form-control form-control-lg" rows="10" name="description_produit" id="description_produit" placeholder="Description du produit" value="<?=$test['description_produit']?>"></textarea>
    </br>
    <label for="image_produit" class=" h4 text-center">Image:</label>
    </br>
    <input type="text" name="image_produit" id="image_produit" textarea class="form-control" value="<?=$test['image_produit']?>">
    <!--input type="file" class="form-control-file"...-->
    </br>
    </br>
    <label for="prix_produit" class=" h4 text-center">Prix:</label>
    <input type="text" name="prix_produit" id="prix_produit" textarea class="form-control" value="<?=$test['prix_produit']?>">
    <input type="hidden" value="<?=$test['id_produit']?>">
    </br>
    <div container>
                   <div class="row">
                   <div class="col text-center"> 
    <button class="btn btn-success btn-lg">Valider</button>
    </div>
    </div>
    </div>
</form>
</br>

  </body>
  </html>