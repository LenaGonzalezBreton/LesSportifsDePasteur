<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if (isset($_SESSION["login"])){

    $mysqlConnection = new PDO(
        'mysql:host='.SERVER.';dbname='.DBNAME.';charset=utf8',
        USER,
        PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );

    // ordre de mission
    $requete = $mysqlConnection->prepare('SELECT * FROM sport_seance ss INNER JOIN seance s on ss.fk_id_seance=s.id_seance INNER JOIN sport sp on ss.fk_id_sport=sp.id_sports');
    //execution de la requete
    $requete->execute();

    $ateliers = $requete->fetchAll();
    $mysqlConnection = null;
    $requete = null;

    ?>
    <div class="row">
    <div class="col">
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Date de la séance</th>
        <th scope="col">Heure de début</th>
        <th scope="col">Heure de fin</th>
        <th scope="col">Sports</th>
        <th scope="col">S'inscrire</th>
            </tr>
    </thead>
    <tbody>
    <?php
        foreach ($ateliers as $ligne){
            ?>
            <tr>
                <th scope="row"><?= $ligne["id_atelier"] ?></th>
                <td><?= $ligne["titre"]?></td>
                <td><?= $ligne["libelle"]?></td>
                <td>
                    <a href="index.php?route=delete-atelier&id=<?= $ligne["id_atelier"] ?>"><button class="btn btn-danger">Supprimer</button></a>
                    <a href="index.php?route=edit-atelier&id=<?= $ligne["id_atelier"] ?>"><button class="btn btn-info">Modifier</button></a>
                </td>

            </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
    <?php
    $requete=null;
    $mysqlConnection=null;
    ?>
  
    </div>
  </div>
   
        
    <?php

}
else
{
 
    $_SESSION["error"]="il faut être connecté pour avoir acces";
    header("location:index.php");
}
?>
</body>
</html>