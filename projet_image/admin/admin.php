<?php
require('../config.php');
require('../class/Image.php');

$image = new Image();
$images = $image->getImages(IMAGE_DIR_PATH);

var_dump($images);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8mb4">
        <link rel="stylesheet" type="text/css" href="css/styles_admin.css">
        <title>PHP Avancé n°1</title>
    </head>
    <body>
        <h1><?php echo WEB_TITLE ?></h1>

        <ul>
            <?php foreach ($images as $image): ?>
                <li>
                    <img src="<?php echo IMAGE_DIR_URL. $image['filename'] ?>">

                    <form method="post" action="process_image.php">
                        <p>Titre : <input type="text" name="title" value="<?php echo $image['title'] ?>"></p>
                        <input type="hidden" name="filename" value="<?php echo $image['filename'] ?>">
                        <p>
                            Description : <br>
                            <textarea name="descr" class="formDescr" cols="30" rows="3"><?php echo $image['description'] ?></textarea>
                        </p>
                        <?php if (!empty($image['title'])): ?>
                            <input type="hidden" name="update" value="1">
                        <?php endif ?>
                        <p><input type="submit" name="formImageSubmit" class="formImageSubmit" value="validez"></p>
                    </form>
                </li>
            <?php endforeach ?>
        </ul>
    </body>
</html>

<h1><?php echo WEB_TITLE ?></h1>

