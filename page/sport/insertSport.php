<?php
if (isset($_POST["sports"])==false || empty($_POST["sports"])){

    $_SESSION["error"]="Le nom du sport est obligatoire";
    echo"<script>window.location.href='index.php?route=addSport'</script>";
}
else
{
    $mysqlConnection = new PDO(
        'mysql:host='.SERVER.';dbname='.DBNAME.';charset=utf8',
        USER,
        PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    ); 

$requete = $mysqlConnection->prepare('INSERT INTO sport (nom_sports) values(:sports)');
$requete->execute(["sports"=>$_POST["sports"]]);
$sport=$requete->fetch();
$mysqlConnection = null;
$requete = null;
$_SESSION["success"]="Sport crée avec succès";
echo"<script>window.location.href='index.php?route=welcome&id='</script>";
}
