<?php
if (isset($_POST["seance"])==false || empty($_POST["seance"]) || isset($_POST["sports"])==false || empty($_POST["sports"])){

    $_SESSION["error"]="Le sport et la séance sont obligatoires";
    echo"<script>window.location.href='index.php?route=addSeance'</script>";
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
$requete = $mysqlConnection->prepare('INSERT INTO seance(libelle_seance,fk_id_sport, dte_seance, heure_debut, heure_fin) values(:seance,:fk_id_sports,:dte,:hDebut,:hFin)');
//execution de la requete
$requete->execute( ["seance"=>$_POST["seance"],"fk_id_sports"=>$_POST["sports"], "dte"=>$_POST["dte"],"hDebut"=>$_POST["hDebut"], "hFin"=>$_POST["hFin"]]);
$mysqlConnection = null;
$requete = null;
$_SESSION["success"]="Séance crée avec succès";
echo"<script>window.location.href='index.php?route=welcome&id='</script>";
}
