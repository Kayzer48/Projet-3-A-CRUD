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
    header('Location: index.php');
}


}else{
    $_SESSION['message']="URL invalide";
    header('Location: index.php');
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
                    
                    header('Location: index.php');
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
  <h1>Modifier un produit</h1>
  <!-- <form method="post">
    <div class="form-group">
      <label for="nom_produit">Produit</label>
      <input type="text" name="nom_produit" id="nom_produit" textarea class="form-control-plaintext " value="">
    </div>
    <div class="form-group">
      <label for="description_produit">Description</label>
      <input type="text" name="description_produit" id="description_produit" textarea class="form-control-plaintext  form-control-lg" value="<?=$test['description_produit']?>">
    </div>
    <div class="form-group">
      <label for="image_produit">Image</label>
      <input type="text" name="image_produit" id="image_produit" textarea class="form-control-plaintext " value="<?=$test['image_produit']?>">
    </div>
    <div class="form-group">
      <label for="prix_produit">Prix</label>
      <input type="text" name="prix_produit" id="prix_produit" textarea class="form-control-plaintext " value="<?=$test['prix_produit']?>">
    </div>
    <input type="hidden" value="/<?=$test['id_produit']?>">
    <button>Enregistrer</button>
</form> -->
<form>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <textarea class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"value="<?=$test['nom_produit']?>">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Example select</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Example multiple select</label>
    <select multiple class="form-control" id="exampleFormControlSelect2">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
</form>
  </body>
  </html>