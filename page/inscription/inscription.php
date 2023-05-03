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
    $requete = $mysqlConnection->prepare('SELECT * FROM seance s ');
    //execution de la requete
    $requete->execute();

    $seances = $requete->fetchAll();
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
        <th scope="col">S'inscrire</th>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($seances as $ligne){
            ?>
            <tr>
                <th scope="row"><?= $ligne["dte_seance"] ?></th>
                <td><?= $ligne["heure_debut"] ?></td>
                <td><?= $ligne["heure_fin"] ?></td>
                <td>
                    <a href="index.php?route=inscrire&id=<?= $ligne["id_seance"] ?>"><button class="btn btn-info">S'inscrire</button></a>
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