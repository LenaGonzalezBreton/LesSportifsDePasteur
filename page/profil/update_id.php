<?php
if (isset($_GET["modif"])) {
    if ($_GET["modif"] == "1") {
        if (isset($_POST["login"]) == false || empty($_POST["login"])) {

            $_SESSION["error"] = "Le login est obligatoire";
            echo "<script>window.location.href='index.php?route=modifprofil&id=" . $_GET["id"] . "'</script>";
        } else {
            $mysqlConnection = new PDO(
                'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',

                USER,

                PASSWORD,

                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
            );

            // ordre de mission
            $requete = $mysqlConnection->prepare('update user set login = :login where id_user =:id');
            //execution de la requete
            $requete->execute(["id" => $_GET["id"], "login" => $_POST["login"]]);
            $mysqlConnection = null;
            $requete = null;
            $_SESSION["success"] = "login modifié avec succès";

            echo "<script>window.location.href='index.php?route=welcome&id=" . $_GET["id"] . "'</script>";
        }
    } else

        if ($_GET["modif"] == "2") {

            if (isset($_POST["mail"]) == false || empty($_POST["mail"])) {

                $_SESSION["error"] = "Le mail est obligatoire";
                echo "<script>window.location.href='index.php?route=modifprofil&id=" . $_GET["id"] . "'</script>";
            } else {
                $mysqlConnection = new PDO(
                    'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',

                    USER,

                    PASSWORD,

                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
                );

                // ordre de mission
                $requete = $mysqlConnection->prepare('update user set email = :mail where id_user =:id');
                //execution de la requete
                $requete->execute(["id" => $_GET["id"], "mail" => $_POST["mail"]]);
                $mysqlConnection = null;
                $requete = null;
                $_SESSION["success"] = "mail modifié avec succès";

                echo "<script>window.location.href='index.php?route=welcome&id=" . $_GET["id"] . "'</script>";
            }
        } else if ($_GET["modif"] == "3") {

            if (empty($_POST["old_pwd"])) {
                $_SESSION["error"] = "Le mot de passe actuel est obligatoire";
                echo "<script>window.location.href='index.php?route=modifprofil&id=" . $_GET["id"] . "'</script>";
            } else if (strlen($_POST["new_pwd"]) < 8) {
                $_SESSION["error"] = "Le nouveau mot de passe doit contenir au moins 8 caractères";
                echo "<script>window.location.href='index.php?route=modifprofil&id=" . $_GET["id"] . "'</script>";
            } else if ($_POST["new_pwd"] !== $_POST["confirm_pwd"]) {
                $_SESSION["error"] = "Les deux mots de passe ne correspondent pas";
                echo "<script>window.location.href='index.php?route=modifprofil&id=" . $_GET["id"] . "'</script>";
            } else {
                $mysqlConnection = new PDO(
                    'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',
                    USER,
                    PASSWORD,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );

                // Vérification de l'ancien mot de passe
                $requete = $mysqlConnection->prepare('SELECT pwd FROM user WHERE id_user = :id');
                $requete->execute(["id" => $_GET["id"]]);
                $resultat = $requete->fetch(PDO::FETCH_ASSOC);

                if (!password_verify($_POST["old_pwd"], $resultat["pwd"])) {
                    $_SESSION["error"] = "Le mot de passe actuel est incorrect";
                    echo "<script>window.location.href='index.php?route=modifprofil&id=" . $_GET["id"] . "'</script>";
                } else {

                    // Mise à jour du mot de passe
                    $password = $_POST["new_pwd"];
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $requete = $mysqlConnection->prepare('UPDATE user SET pwd = :new_pwd WHERE id_user = :id');
                    $requete->execute(["id" => $_GET["id"], "new_pwd" => $passwordHash]);
                    $mysqlConnection = null;
                    $requete = null;
                    $_SESSION["success"] = "Mot de passe modifié avec succès";
                    echo "<script>window.location.href='index.php?route=welcome&id=" . $_GET["id"] . "'</script>";
                }
            }
        } else if ($_GET["modif"] == "4") {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                //     // Vérifie si un fichier a été téléchargé
                //    // if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
                //         // Ouvre une connexion à la base de données
                //         $mysqlConnection = new PDO(
                //             'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',
                //             USER,
                //             PASSWORD,
                //             [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
                //         );

                //         // Récupère le contenu de l'image et le convertit en base64
                //         var_dump($_FILES["photo"]);
                //         $imgData = $_FILES["photo"];
                //         $base64Img = base64_encode($imgData);



                //    // }

                $mysqlConnection = new PDO(
                    'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',
                    USER,
                    PASSWORD,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
                );


                if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
                    // Récupération du nom et de l'extension du fichier
                    $fileName = $_FILES['photo']['name'];
                    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

                    // Vérification de l'extension du fichier
                    if ($fileExt == 'jpg' || $fileExt == 'jpeg' || $fileExt == 'png' || $fileExt == 'gif') {
                        // Récupération du contenu du fichier
                        $fileContent = file_get_contents($_FILES['photo']['tmp_name']);
                        
                        // Création d'une image à partir du contenu du fichier
                        $image = imagecreatefromstring($fileContent);
                    
                        // Calcul des dimensions de l'image
                        $width = imagesx($image);
                        $height = imagesy($image);
                    
                        // Récupération de la plus petite dimension pour couper l'image
                        $size = min($width, $height);
                    
                        // Création d'une nouvelle image carrée
                        $croppedImage = imagecrop($image, [
                            'x' => ($width - $size) / 2,
                            'y' => ($height - $size) / 2,
                            'width' => $size,
                            'height' => $size
                        ]);
                    
                        // Conversion de l'image en base64
                        ob_start();
                        imagepng($croppedImage);
                        $croppedContent = ob_get_clean();
                        $base64Image = base64_encode($croppedContent);
                        
                        // Prépare et exécute la requête SQL pour stocker la chaîne de base64 dans la base de données
                        $requete = $mysqlConnection->prepare("UPDATE user SET photos = :photo WHERE id_user = :id");
                        $requete->execute(["id" => $_GET["id"], "photo" => "data:image/png;base64, " . $base64Image]);
                    
                        $_SESSION["success"] = "Image stockée dans la base de données avec succès.";
                        echo "<script>window.location.href='index.php?route=welcome&id=" . $_GET["id"] . "'</script>";
                    
                    
                    } else {
                        echo 'Le fichier doit être une image de type jpg, jpeg, png ou gif.';
                    }
                }


            }
        }
}
?>