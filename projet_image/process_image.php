<?php
require('config.php');
require('class/Image.php');

// Les valeurs sont-elles postées ?
if (!isset($_POST['formImageSubmit']))
{
    $error_msg = 'Aucune donnée n\'est fournie.
    <a href="' . WEB_DIR_URL . 'admin.php">retour</a>';
}

if (isset($_POST['formImageSubmit']))
{
    // Si une des valeurs est vide
    if ( (empty($_POST['title'])) OR (empty($_POST['descr'])) OR (empty($_POST['filename'])) )
    {
        $error_msg = 'Une des informations est manquante.
        <a href="' . WEB_DIR_URL . 'admin.php">retour</a>';
    }
    else
    {
        $title = trim ($_POST['title']);
        $descr = trim ($_POST['descr']);
        $filename = trim ($_POST['filename']);

        $image = new Image();
        if (isset($_POST['update']))
        {
            $insertImage = $image->updateImageData($title, $descr, $filename);
        }
        else {
            $insertImage = $image->insertImage($title, $descr, $filename);
        }

        if ($insertImage === true)
        {
            header('location:' . WEB_DIR_URL .'admin.php?insertImage=ok');
        }
        else
        {
            $error_msg = '<br><a href="'. WEB_DIR_URL .'admin.php">retour</a>';
        }
    }
}