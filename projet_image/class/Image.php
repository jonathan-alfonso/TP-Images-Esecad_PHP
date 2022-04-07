<?php
class Image
{
    public function __construct()
    {
        
    }

    public function getImages($image_dir)
    {
        // Iterator
        $i = 0;
        if ($handle = opendir($image_dir))
        {
            while (($entry = readdir($handle)) !== false)
            {
                if ($entry != '.' && $entry != '..')
                {
                    $i++;
                    $images[$i]['filename'] = $entry;
                    // Utilisation de $this pour appeler la méthode getImageData
                    $image_data = $this->getImageData($entry);
                    $images[$i]['title'] = $image_data['title'];
                    $images[$i]['description'] = $image_data['description'];
                }
            }
        }

        closedir($handle);
        return $images;
    }

    public function insertImage($title, $descr, $filename)
    {
        $mysqli = new mysqli('localhost', 'root', '', 'projet_image');

        // Vérification der la connexion à la base
        if ($mysqli->connect_errno) {
            echo 'Echec de la connexion' . $mysqli->connect_error;
            exit();
        }

        if (!$mysqli->query('INSERT INTO image (title, description, filename) VALUES ("' . $title . '", "' . $descr . '", "' . $filename . '")'))
        {
            echo 'Une erreur est survenue lors de l\'insertion des données dans la base. Message d\'erreur : ' . $mysqli->error;
            return false;
        }
        else
        {
            return true;
            $mysqli->close();
        }
    }

    public function getImageData($filename)
    {
        $mysqli = new mysqli('localhost', 'root', '', 'projet_image');
            
        if ($mysqli->connect_errno)
        {
            printf("Echec de la connexion : %s\n", $mysqli->connect_error);
            exit();
        }

        $result = $mysqli->query('SELECT id, title, description, filename FROM image WHERE filename = "'. $filename .'"');

        if (!$result)
        {
            echo 'Une erreur est survenue lors de la récupération des données dans la base. Message d\'erreur : '. $mysqli->error;
            return false;
        }
        else
        {
            $row = $result->fetch_array();
            $image_data['id'] = $row['id'];
            $image_data['title'] = $row['title'];
            $image_data['description'] = $row['description'];
            $image_data['filename'] = $row['filename'];
            return $image_data;
        }
        $mysqli->close();
    }

    public function updateImageData ($title, $descr, $filename)
    {
        $mysqli = new mysqli('localhost', 'root', '', 'projet_image');

        if ($mysqli->connect_errno)
        {
            echo 'Echec de la connexion '. $mysqli->connect_error;
            exit();
        }

        if (!$mysqli->query('UPDATE image SET title = "'. $title .'", description = "'. $descr .'" WHERE filename = "'. $filename .'"'))
        {
            echo 'Une erreur est survenue lors de la mise à jour des données dans la base. Message d\'erreur : '. $mysqli->error;
            return false;
        }
        else
        {
            return true;
            $mysqli->close();
        }
    }
}