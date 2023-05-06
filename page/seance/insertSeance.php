<?php

if (isset($_POST["seance"])==false || empty($_POST["seance"]) || isset($_POST["sports"])==false || empty($_POST["sports"])){

    $_SESSION["error"]="Le sport et la séance sont obligatoires";
    echo"<script>window.location.href='index.php?route=addSeance&id=".$_GET["id"]."'</script>";
}
else
{
    $mysqlConnection = new PDO(
        'mysql:host='.SERVER.';dbname='.DBNAME.';charset=utf8',
        USER,
        PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    ); 

// ordre de mission
$requete = $mysqlConnection->prepare('INSERT INTO seance(libelle_seance, dte_seance, heure_debut, heure_fin) values(:seance,:dte,:hDebut,:hFin)');
//execution de la requete
$requete->execute( ["seance"=>$_POST["seance"], "dte"=>$_POST["dte"],"hDebut"=>$_POST["hDebut"], "hFin"=>$_POST["hFin"]]);

$lastId = $mysqlConnection->lastInsertId();
$intLastId=(int)$lastId;

foreach($_POST["sports"] as $ligne){
    $requete3=$mysqlConnection->prepare('INSERT INTO sport_seance(fk_id_seance, fk_id_sport) VALUES (:id_seance, :id_sport)');
    $requete3->execute(["id_seance"=>$intLastId, "id_sport"=>$ligne]);
    $requete3 = null;
}

$_SESSION["success"]="Séance crée avec succès";
echo"<script>window.location.href='index.php?route=welcome&id=".$_GET["id"]."'</script>";
}
