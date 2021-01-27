 
<?php
//on démarre une session, le fait d'utiliser session_start permet d'utiliser la super globale $session
session_start();
//Est-ce que l'id_produit existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty ($_GET['id'])){
    require_once('connect.php');


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
    $_SESSION['erreur']="URL invalide";
    header('Location: index.php');
    die();
}
// On utilise DELETE FROM...WHERE
    //avec la fonction strip_tags qui enlèvent toutes les balises de notre id
    $id= strip_tags($_GET['id']);
    
    $sql= 'DELETE FROM `produits` WHERE `id_produit`=:id_produit;';

// On prépare la requête
$query=$db->prepare($sql);

// On "accroche' les paramètres (id)
$query->bindValue(':id_produit',$id,PDO::PARAM_INT);

//On exécute la requête
$query-> execute();

//On récupère le test (produit)
$test = $query-> fetch();
$_SESSION['messageSuprSuccess'] = "Produit supprimé !"; 
                    header('Location: index.php');
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Le Marché du coin CRUD</title>
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
            <?php
              if(!empty($_SESSION["erreur"])){
                echo  '<div class="alert alert-danger" role="alert">
                      '.$_SESSION['erreur'].'
                      </div>';
              $_SESSION['erreur']="";
              }
              
            ?>
            <?php
              if(!empty($_SESSION["messageAdd"])){
                echo  '<div class="alert alert-success" role="alert">
                      '.$_SESSION['messageAdd'].'
                      </div>';
              $_SESSION['messageAdd']="";
              }
              
            ?>
             <?php
              if(!empty($_SESSION["messageModiSuccess"])){
                echo  '<div class="alert alert-success" role="alert">
                      '.$_SESSION['messageModiSuccess'].'
                      </div>';
              $_SESSION['messageModiSuccess']="";
              }
              
            ?>
             <?php
              if(!empty($_SESSION["messageSuprSuccess"])){
                echo  '<div class="alert alert-success" role="alert">
                      '.$_SESSION['messageSuprSuccess'].'
                      </div>';
              $_SESSION['messageSuprSuccess']="";
              }
              
            ?>
       
            <h1 class="text-center">Le Marché du coin</h1>
            </br>   
                   <div container>
                   <div class="row">
                   <div class="col text-start"> 
                    <a href="ajouteProduit.php" class="btn btn-primary">Ajouter un produit</a>                    
                  </div>
                   <div class="col text-end"> 
                    <a href="close.php" class="btn text-light btn-warning">Déconnexion</a>
                  </div>
                  
                </div>
            </br>
            <table class="table table-striped table-dark"> 
                        <thead class="text-center"> 
                            <th>id_produit</th>
                            <th>nom_produit</th>
                            <th>description_produit</th>
                            <th>image_produit</th>
                            <th>prix_produits</th>
                            <th></th> 
                            <th>Editer</th>
                            <th>Supprimer</th>
                        </thead>
                        <tbody>

                                <tr class="text-center">
                                    <td><h2><?= $test['id_produit'] ?></h2> </td>
                                    <td><h2><?= $test['nom_produit'] ?></h2></td>
                                    <td><h2><?= $test['description_produit'] ?></h2></td>
                                    <td><img src="<?= $test['image_produit'] ?>" alt="<?= $test['nom_produit'] ?>" title="<?= $test['nom_produit'] ?>"class="img-thumbnail"></td>
                                    <td><h2><?= $test['prix_produit'] ?>€</h2></td>
                                    <td><a href="index.php" class="btn btn-light">Retour</a></td>
                                    <td><a href="majProduit.php?id=<?=$test['id_produit']?>"class="btn btn-success">Editer</a></td>
                                    <td><a href="suprProduit.php?id=<?=$test['id_produit']?>"class="btn btn-danger" Onclick="return confirm('Voulez-vous vraiment supprimer ce produit');">Supprimer</a></td>
                                </tr>    
                                                                           
                        </tbody>
                </table>
            </section>
        </div>
    </div>
  </body>

</html>