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
        }
}
?>