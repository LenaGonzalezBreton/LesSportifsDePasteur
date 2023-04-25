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

    $requete = $mysqlConnection->prepare('SELECT nom_sports FROM sport');
    $requete->execute();
    $sports = $requete->fetch();

    $requete2 = $mysqlConnection->prepare('SELECT * FROM user WHERE id_user=:id');
    $requete2->execute(['id' => $_GET["id"]]);
    $user = $requete2->fetch();
    $_SESSION["id"] = $user["id_user"];
}

    foreach ($sports as $ligne) {
        if ($_POST["sports"] == $sports["nom_sports"]) {
            $_SESSION["doublon"] = "Sport existe déjà";
            echo "<script>window.location.href='index.php?route=addSport&id=" . $_SESSION["id"] . "'</script>";
        } else {
            $requete3 = $mysqlConnection->prepare('INSERT INTO sport (nom_sports) values(:sports)');
            $requete3->execute(["sports" => $_POST["sports"]]);
            $insertSport = $requete3->fetch();
            $_SESSION["success"] = "Sport créé avec succès";
            echo "<script>window.location.href='index.php?route=welcome&id=" . $_SESSION["id"] . "'</script>";
        }
    }
?>