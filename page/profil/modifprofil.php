<?php
if (isset($_SESSION["login"])){
  $mysqlConnection = new PDO(
    'mysql:host=db4free.net:3306;dbname=unicorp_bd;charset=utf8',

    'unicorp', 

    'nzjRLN0!RirP',

    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
);

  // ordre de mission
  $requete = $mysqlConnection->prepare('SELECT * FROM user where id_user =:id');
  //execution de la requete
  $requete->execute(["id"=>$_GET["id"]]);

  $user = $requete->fetch();
  $mysqlConnection = null;
  $requete = null;
    ?>
     <div class="row">
        <div class="col center">
          <form action="index.php?route=update_id&id=<?= $_GET["id"]?>&modif=1" method="post">
            <div class="form-group">
              <label for="login">login</label>
              <input type="text" class="form-control" id="login" name="login" value=""/>
            </div>         
            <button type="submit" class="btn btn-primary">Modifer login</button>
          </form>
          <form action="index.php?route=update_id&id=<?= $_GET["id"]?>&modif=2" method="post">
            <div class="form-group">
              <label for="mail">mail</label>
              <input type="text" class="form-control" id="mail" name="mail" value=""/>
            </div>         
            <button type="submit" class="btn btn-primary">Modifer mail</button>
          </form>

        </div>
      </div>

    <?php
}
else
{
    $_SESSION["error"]="il faut être connecté pour avoir acces";
    echo"<script>window.location.href='index.php?route=login'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="index.css" rel="stylesheet"/>
</head>
<body>
    <center><div id="color" class="p2"><button class="mon-bouton">Changer photo de profil</button>
                                       <button class="bouton">Changer addresse Mail</button>
                                       <button class="tbouton">Changer mot de passe</button>
    </div></center>
</body>
    

</html>