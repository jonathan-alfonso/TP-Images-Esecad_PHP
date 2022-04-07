<?php
$image = new Image();
$images = $image->getImages(IMAGE_DIR_PATH);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8mb4">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <title>PHP Avancé n°1</title>
    </head>
    <body>
        <h1><?php echo WEB_TITLE ?></h1>

        <ul>
            <?php foreach ($images as $image): ?>
                <li>
                    <p><img src="<?php echo IMAGE_DIR_URL. $image['filename'] ?>"></p>
                    <p class="img-title"><?php echo $image['title'] ?></p>
                    <p class="img-descr"><?php echo $image['description'] ?></p>
                </li>
            <?php endforeach ?>
        </ul>
    </body>
</html>
