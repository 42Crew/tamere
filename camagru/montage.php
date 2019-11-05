<?php
    session_start();

    function getnumber()
    {
        $numero = 0;
        $files = glob('./images/montages/*.png', GLOB_BRACE);
        foreach($files as $file) {
            $nom = str_replace('./images/montages/' . $_SESSION['username'], '', $file);
            $nom = str_replace('.png', '', $nom);
            if ($nom >= $numero)
                $numero = $nom + 1;
        }
        return ($numero);
    }
    $img = $_POST['url'];
    $img = str_replace('data:image/png;base64', '', $img);
    $img = str_replace(' ','+', $img);
    $destination = imagecreatefromstring(base64_decode($img));
    $filename =  $_SESSION['username'] . getnumber() . '.png';

    $i = 0;
    while ($_POST['filtre' . $i])
    {
        $source = imagecreatefrompng($_POST['filtre' . $i]);
        $largeur_source = imagesx($source);
        $hauteur_source = imagesy($source);
        imagecopyresized($destination, $source, 0, 0, 0, 0, $_POST['width'],$_POST['height'], $largeur_source, $hauteur_source);
        $i++;
    }
    imagepng($destination, "./images/montages/" . $filename); 
    header("Location:index.php")
?>