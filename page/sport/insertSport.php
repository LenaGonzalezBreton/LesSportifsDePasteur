<?php
if (isset($_POST["sports"]) == false || empty($_POST["sports"])) {

    $_SESSION["error"] = "Le nom du sport est obligatoire";
    echo "<script>window.location.href='index.php?route=addSport'</script>";
} else {
    $mysqlConnection = new PDO(
        'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',
        USER,
        PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );

    $requete = $mysqlConnection->prepare('SELECT * FROM sport WHERE nom_sports=:sport');
    $requete->execute(['sport' => $_POST["sports"]]);
    $sports = $requete->fetch();
}

        if ($sports) {
            $_SESSION["doublon"] = "Sport existe déjà";
            echo "<script>window.location.href='index.php?route=addSport&id=" . $_GET["id"] . "'</script>";
        } else {
            $requete3 = $mysqlConnection->prepare('INSERT INTO sport (nom_sports) values(:sports)');
            $requete3->execute(["sports" => $_POST["sports"]]);
            $insertSport = $requete3->fetch();
            $_SESSION["success"] = "Sport créé avec succès";
            echo "<script>window.location.href='index.php?route=welcome&id=" . $_GET["id"] . "'</script>";
        }
?>