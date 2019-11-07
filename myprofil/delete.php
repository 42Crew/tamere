<?php
    session_start();
    $imagetodel = $_POST['id'];
    unlink($imagetodel);
    include_once '../config/database.php';
    try {
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query= $bdd->prepare("SELECT * FROM montages WHERE montage=:montage AND flag=:flag");
        $query->execute(array(':montage' => $_POST['id'], ':flag' => $_SESSION['flag']));
    
        $val = $query->fetch();
        if ($val == null) {
            $query->closeCursor();
            echo ("-1");
        }

        $query= $bdd->prepare("DELETE FROM montages WHERE montage=:montage AND flag=:flag");
        $query->execute(array(':montage' => $_POST['id'], ':flag' => $_SESSION['flag']));
        $query->closeCursor();
        echo ("0");

        $query= $bdd->prepare("DELETE FROM comments WHERE idmontage=:id");
        $query->execute(array(':id' => $val['id']));
        $query->closeCursor();
        echo ("0");
        } catch (PDOException $e) {
        echo ($e->getMessage());
    }
    
    header("Location: ./miniatures.php")
?>