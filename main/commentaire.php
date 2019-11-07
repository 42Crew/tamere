<?php 

    include_once '../config/database.php';
    
    try {
        $bdd= new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query= $bdd->prepare("INSERT INTO comments  (idmontage, commentaire, flag) VALUES (:idmontage, :commentaire, :flag)");
        $query->execute(array(':idmontage' => $_POST['id'], ':commentaire' => $_POST['comment'], ':flag' => $_POST['flag']));
        echo (0);
    } catch (PDOException $e) {
        echo ($e->getMessage());
    }

    header("Location: ./galerie.php")
    
?>