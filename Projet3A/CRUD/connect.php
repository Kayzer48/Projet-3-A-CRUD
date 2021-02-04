<?php
try{
    //Connexion à la base de données
    $db=new PDO('mysql:host=localhost;dbname=ecommerce', 'root', '');
    $db->exec('SET NAMES "UTF8"');
} catch(PDOException $e){
    echo 'Erreur:'. $e-> getMessage();
    die();
}
?>
