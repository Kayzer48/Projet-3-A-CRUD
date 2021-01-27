 
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
